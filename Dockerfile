# Estágio 1: Instala as dependências com o Composer
# Usamos uma imagem oficial do Composer para esta tarefa, mantendo a imagem final leve.
FROM composer:2.7 as vendor

WORKDIR /app

# Copiamos apenas os arquivos necessários para o Composer para aproveitar o cache do Docker.
COPY database/ database/
COPY composer.json composer.lock ./

# Instala as dependências. Para desenvolvimento, instalamos também as de dev.
# Para um ambiente de produção, você usaria a flag --no-dev
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader


# Estágio 2: Imagem final da aplicação
# Usamos uma imagem leve baseada em Alpine para um ambiente otimizado.
FROM php:8.2-fpm-alpine

# Define o diretório de trabalho, o mesmo que você montou no docker-compose.yml
WORKDIR /var/www

# Instala dependências do sistema e extensões PHP comuns para Laravel.
# Isso inclui extensões para banco de dados, manipulação de imagens, zip, etc.
RUN apk --update add \
        libzip-dev \
        zip \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        oniguruma-dev \
        libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        bcmath \
        exif \
        gd \
        mbstring \
        opcache \
        pcntl \
        pdo_mysql \
        zip \
        sockets \
    # Limpa o cache do apk para reduzir o tamanho da imagem
    && rm -rf /var/cache/apk/*

# Copia o código da aplicação e as dependências já instaladas.
# Em desenvolvimento, o volume que você configurou no docker-compose irá sobrepor estes arquivos.
COPY . .
COPY --from=vendor /app/vendor/ ./vendor/

# Define as permissões corretas para os diretórios do Laravel,
# garantindo que o Nginx e o PHP-FPM possam escrever nos logs e cache.
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# O comando padrão para iniciar o container com o PHP-FPM.
CMD ["php-fpm"]