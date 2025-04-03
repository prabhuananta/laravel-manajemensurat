# Repository Setup Tutorial

Follow these steps to set up the repository:

## Steps

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/dedekanandaa/laravel-manajemensurat.git
```

Navigate to the project directory:

```bash
cd laravel-manajemensurat
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

Install frontend dependencies (optional):

```bash
npm install
```

### 3. Configure Environment

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Set Up Database

Run migrations to set up the database schema:

```bash
php artisan migrate
```

Run seeder to set default data to the database

```bash
php artisan db:seed
```

After running the seeder, you will have an admin user pre-configured with the following credentials:

-   **Email**: `admin@gmail.com`
-   **Password**: `admin`

You can use these credentials to log in and explore the application.

### 5. Set File Permissions

Ensure the `storage` and `public` directories are linked:

```bash
php artisan storage:link
```

### 6. Start Development Server

Run the following commands using separate console to start the server:

```bash
php artisan serve
```

```bash
npm run dev
```

Visit `http://127.0.0.1:8000` in your browser.
