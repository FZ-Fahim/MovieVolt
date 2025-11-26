# Laravel Vercel App

This is a Laravel application configured for deployment on Vercel.

## Project Structure

- **app/**: Contains the core application logic including controllers, middleware, and service providers.
- **bootstrap/**: Contains files for bootstrapping the application.
- **config/**: Configuration files for the application.
- **database/**: Contains migrations and factories for database management.
- **public/**: The entry point for the application and public assets.
- **resources/**: Contains views and language files for localization.
- **routes/**: Defines the web routes for the application.
- **storage/**: Used for storing application files, logs, and cache.
- **tests/**: Contains feature tests for the application.

## Deployment on Vercel

To deploy this Laravel application on Vercel, ensure the following configurations in the `vercel.json` file:

```json
{
  "version": 2,
  "builds": [
    {
      "src": "public/index.php",
      "use": "@vercel/php"
    }
  ],
  "routes": [
    {
      "src": "/(.*)",
      "dest": "public/index.php"
    }
  ]
}
```

Make sure to set the environment variables in the Vercel dashboard according to your `.env` file.

## Getting Started

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Set up your `.env` file based on the `.env.example`.
4. Run migrations with `php artisan migrate`.
5. Start the local development server with `php artisan serve`.

## License

This project is licensed under the MIT License.