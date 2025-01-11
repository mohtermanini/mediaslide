# API Setup and Testing Documentation

## Prerequisites and Setup Instructions

### Ensure the following software is installed:

-   **PHP** (>= 8.2)
-   **Composer**
-   **MySQL**
-   **Postman** (for API testing)

### Clone the Repository

```bash
git clone https://github.com/mohtermanini/mediaslide.git
cd mediaslide
```

### Install Dependencies

```bash
composer install
```

### Set Up Environment Variables

```bash
copy .env.example .env
```

### Update the .env file with your database credentials

#### Example:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### Generate the Application Key
 ```bash
php artisan key:generate
```

### Run Database Migrations and Seeders

```bash
php artisan migrate --seed
```

### Start the Development Server

```bash
php artisan serve
```

## Postman Instructions:

1. Import the provided Postman collection (`Mediaslide_Postman_Collection.json`) located in the root directory of the project.
2. Use the endpoints in the collection to test the API.
3. Hit the login API to obtain an authentication token.
4. The token will be automatically included in subsequent requests for protected routes.
