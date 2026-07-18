FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql gd iconv

# Set up the web root
COPY . /var/www/html/

# Set proper permissions for data directory
RUN chown -R www-data:www-data /var/www/html/data/ \
    && chmod -R 755 /var/www/html/data/ \
    && a2enmod rewrite

# Enable Apache rewrite module for FluxCP
RUN echo '<Directory /var/www/html/>\n\tAllowOverride All\n\tRequire all granted\n</Directory>' > /etc/apache2/conf-available/fluxcp.conf \
    && a2enconf fluxcp

EXPOSE 80
