# Use the base image richarvey/nginx-php-fpm:3.1.6
FROM richarvey/nginx-php-fpm:3.1.6

# Install Node.js and npm
RUN apk --no-cache add nodejs npm


# Copy all application files to the container
COPY . .

# Set environment variables
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel configuration
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Run the start script
CMD ["/start.sh"]
