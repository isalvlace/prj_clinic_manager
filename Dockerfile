FROM php:8.2-apache

# 1. Instala dependências do sistema e extensões PHP
# Adicionamos 'libssl-dev' que o FTP costuma usar para conexões seguras
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && docker-php-ext-install mysqli pdo pdo_mysql ftp \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Habilita o módulo rewrite do Apache
RUN a2enmod rewrite

# 3. Configura o Apache (Unificamos as configurações aqui)
RUN echo '<FilesMatch \.php$>\n\
    SetHandler application/x-httpd-php\n\
</FilesMatch>\n\
\n\
<Directory /var/www/html/> \n\
    Options Indexes FollowSymLinks \n\
    AllowOverride All \n\
    Require all granted \n\
    DirectoryIndex index.php \n\
</Directory>\n\
\n\
AddType text/css .css\n\
AddType application/javascript .js\n\
EnableSendfile Off' > /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php.conf

# 4. Copia arquivos e define permissões
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html