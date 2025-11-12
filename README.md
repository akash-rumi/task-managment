# Task Management System

A Laravel-based task management application with Docker containerization.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

- **Docker** (version 20.10 or higher)
- **Docker Compose** (version 1.29 or higher)
- **Git**

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/akash-rumi/task-managment.git
cd task-managment
```

### 2. Project Structure

Ensure your project has the following structure:

```
task-managment/
├── docker/
│   ├── docker-compose.yml
│   ├── php/
│   ├── nginx/
│   │   └── default.conf
│   └── mysql/
│       ├── init/
│       ├── logs/
│       └── data/
├── src/                    # Laravel application files
├── database/
└── setup.sh
```

### 3. Run the Setup Script

Make the setup script executable and run it:

```bash
chmod +x setup.sh
./setup.sh
```

The setup script will automatically:
- Stop and remove any existing Docker containers
- Start Docker Compose services
- Copy `.env.example` to `.env`
- Install Composer dependencies
- Generate application key
- Run database migrations with seeders
- Set proper file permissions

### 4. Access the Application

Once the setup is complete, you can access:

- **Application**: [http://localhost](http://localhost)
- **phpMyAdmin**: [http://localhost:8080](http://localhost:8080)
  - Username: `akash`
  - Password: `root`

## Docker Services

The application uses the following Docker services:

| Service | Container Name | Port | Description |
|---------|---------------|------|-------------|
| PHP | php | - | PHP-FPM for Laravel |
| Nginx | webserver | 80 | Web server |
| MySQL | db | 3306 | Database server |
| phpMyAdmin | phpmyadmin | 8080 | Database management tool |

## Database Configuration

The default database credentials are:

- **Database**: `laravel`
- **Username**: `akash`
- **Password**: `root`
- **Host**: `db` (within Docker network)
- **Port**: `3306`

## Manual Setup (Alternative)

If you prefer to set up manually without the setup script:

```bash
# Navigate to docker directory
cd docker

# Start Docker Compose
docker-compose -p srtsch up -d

# Go back to root directory
cd ..

# Laravel setup
docker exec php cp .env.example .env
docker exec php composer install
docker exec php php artisan key:generate
docker exec php php artisan migrate:fresh --seed

# Set permissions
sudo chmod -R 777 src
```

## Common Commands

### Start the application
```bash
cd docker
docker-compose -p srtsch up -d
```

### Stop the application
```bash
cd docker
docker-compose -p srtsch down
```

### View logs
```bash
docker-compose -p srtsch logs -f
```

### Access PHP container
```bash
docker exec -it php bash
```

### Run Artisan commands
```bash
docker exec php php artisan [command]
```

### Clear cache
```bash
docker exec php php artisan cache:clear
docker exec php php artisan config:clear
docker exec php php artisan view:clear
```

## Troubleshooting

### Permission Issues
If you encounter permission issues:
```bash
sudo chmod -R 777 src/storage
sudo chmod -R 777 src/bootstrap/cache
```

### Database Connection Issues
- Ensure the MySQL container is running: `docker ps`
- Check database logs: `docker logs db`
- Verify credentials in `src/.env` match the docker-compose configuration

### Port Conflicts
If ports 80, 3306, or 8080 are already in use, modify the ports in `docker/docker-compose.yml`:
```yaml
ports:
  - "8000:80"  # Change host port (left side)
```

### Rebuilding Containers
If you need to rebuild the containers:
```bash
cd docker
docker-compose -p srtsch down -v
docker-compose -p srtsch build --no-cache
docker-compose -p srtsch up -d
```

## Development

### Adding Dependencies
```bash
docker exec php composer require [package-name]
```

### Running Migrations
```bash
docker exec php php artisan migrate
```

### Creating Seeders
```bash
docker exec php php artisan make:seeder [SeederName]
docker exec php php artisan db:seed --class=[SeederName]
```

## Timezone

The application is configured for **Asia/Dhaka** timezone. To change it, update the `TZ` environment variable in the docker-compose.yml file.

## Support

For issues and questions, please open an issue on the [GitHub repository](https://github.com/akash-rumi/task-managment/issues).
