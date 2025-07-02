# PHP Order Service

## Description
Order service that creates orders based on products fetched from the Node.js product service.

## Environment Variables

Create a `.env` file in the project root:
```ini
NODE_PRODUCT_SERVICE_URL=http://localhost:3000
```

## Setup
```bash
composer install
php -S localhost:8000 -t public
```
Run php application on port 8000.
