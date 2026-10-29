FROM php:8.2-apache

# Instala as extensões PDO e PDO_MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copia os arquivos do projeto para o servidor Apache
COPY . /var/www/html/

# Cria a pasta de uploads e libera permissão de escrita para salvar as capas dos filmes
RUN mkdir -p /var/www/html/uploads && chmod -R 777 /var/www/html/uploads

EXPOSE 80