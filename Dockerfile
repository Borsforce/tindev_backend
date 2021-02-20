FROM shyim/shopware-platform-nginx:php74

RUN install-php-extensions pdo_pgsql
