FROM public.ecr.aws/r8b7l1i7/php-8.2-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

# Instala as dependências necessárias, incluindo libjpeg-dev para suporte a JPEG
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    unzip \
    git \
    curl \
    vim \
    telnet \
    supervisor \
    nano \
    libmagickwand-dev --no-install-recommends

# Instala a extensão Imagick
RUN pecl install imagick \
    && docker-php-ext-enable imagick

# Instala a extensão Redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Instala a extensão GD com suporte a JPEG e PNG
RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd

# Instala outras extensões PHP necessárias
RUN docker-php-ext-install bcmath mysqli pdo pdo_mysql zip opcache \
    && docker-php-ext-enable pdo_mysql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configura o Apache
RUN a2enmod rewrite

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação
ADD . .

# Copia a configuração do Apache
COPY ./000-default.conf /etc/apache2/sites-available/

# Define permissões
RUN chmod o+w /var/www/html/storage/ -R

# Instala as dependências PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Configuração do Supervisor para o queue worker
RUN echo "\
[program:email-queue]\n\
process_name=%(program_name)s_%(process_num)02d\n\
command=php /var/www/html/artisan queue:work sqs --sleep=3 --tries=3 --max-time=3600\n\
autostart=true\n\
autorestart=true\n\
stopasgroup=true\n\
killasgroup=true\n\
user=www-data\n\
numprocs=4\n\
redirect_stderr=true\n\
stdout_logfile=/var/www/html/storage/logs/supervisord.log\n\
" > /etc/supervisor/conf.d/queue-worker.conf

# Copia o script de inicialização
COPY start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start

# Expor a porta HTTP
EXPOSE 80

# Inicia os serviços
CMD ["/usr/local/bin/start"]
