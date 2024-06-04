# Ecommerce Laravel API

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

## About

Ecommerce Laravel API is a powerful backend solution for building ecommerce applications with Laravel. It provides a robust set of features to manage products, categories, orders, and user authentication.

## Features

- **Product Management**: Create, read, update, and delete products with ease.
- **Category Management**: Organize products into categories for better navigation.
- **Order Management**: Handle orders, including order creation, retrieval, and status updates.
- **Authentication**: Secure your API with JWT authentication using Laravel Sanctum.
- **Location Management**: Manage user locations for efficient order delivery.
- **Brand Management**: Keep track of brands associated with your products.

## Authentication

This API uses JWT authentication provided by Laravel Sanctum. Users can register, log in, and log out to access protected routes.

## Installation

1. Clone the repository: `git clone https://github.com/Omar7tech/Ecommerce-laravel-api.git`
2. Install dependencies: `composer install`
3. Set up your environment variables: `cp .env.example .env`
4. Generate the application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`

## Routes

Here are some example routes along with their expected responses:

### GET /api/products

**Description:** Retrieve a list of all products.

**Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Product 1",
            "price": 50.00,
            "category": {
                "id": 1,
                "name": "Category A"
            },
            "brand": {
                "id": 1,
                "name": "Brand X"
            },
            "created_at": "2024-06-01T12:00:00.000000Z",
            "updated_at": "2024-06-01T12:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "Product 2",
            "price": 75.00,
            "category": {
                "id": 1,
                "name": "Category A"
            },
            "brand": {
                "id": 2,
                "name": "Brand Y"
            },
            "created_at": "2024-06-02T12:00:00.000000Z",
            "updated_at": "2024-06-02T12:00:00.000000Z"
        }
    ]
}
