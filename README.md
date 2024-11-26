<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




Requirements
PHP: 8.1 or above
Composer
Docker (for containerized setup)
MySQL: 8.0 or above
Node.js (optional, for additional package builds)


Setup Instructions

Clone Repository
bash
Copy code
git clone https://github.com/flerickdanthi/laravel-article-news.git
cd news-aggregator-api
Environment Setup
Duplicate .env.example and rename it to .env:

bash
Copy code
cp .env.example .env
Update the following in .env:

env
Copy code
APP_NAME=NewsAggregatorAPI
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_aggregator
DB_USERNAME=root
DB_PASSWORD=your_password
Add API keys for external news APIs:

env
Copy code
NEWS_API_KEY=your_news_api_key
GUARDIAN_API_KEY=your_guardian_api_key
NYT_API_KEY=your_nyt_api_key
Install Dependencies
bash
Copy code
composer install
npm install && npm run dev
Database Configuration
Ensure your MySQL database server is running.
Create a database named news_aggregator.
Run Migrations and Seeders
bash
Copy code
php artisan migrate
php artisan db:seed
Docker Setup
To run the application in a containerized environment:

Ensure Docker and Docker Compose are installed.
Build and start the containers:
bash
Copy code
docker-compose up -d
The application will be available at http://localhost.


Authentication

Sanctum Installation

Sanctum is already installed and configured in the project.
Tokens are issued upon successful login for authenticated routes.
Authentication Endpoints
Register: POST /api/register
Login: POST /api/login
Logout: POST /api/logout
Password Reset: POST /api/password/reset
Cron Job Setup
To regularly fetch articles from external APIs:

Register the Laravel scheduler in your server's crontab:

bash
Copy code
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
The scheduler runs the command to fetch and update articles:

bash
Copy code
php artisan news:fetch
Clear Cache Commands
To clear Laravel cache, use the following commands:

bash
Copy code
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear


RUN cron job:

php artisan fetch:articles


POST: api/register

payload:

{
    "name": "Flerick",
    "email": "flerick@apple.com",
    "password": "secretpassword",
    "password_confirmation": "secretpassword"
}

Response:
{
    "message": "User registered successfully",
    "user": {
        "name": "Flerick",
        "email": "flerick@apple.com,
        "updated_at": "2024-11-26T13:59:40.000000Z",
        "created_at": "2024-11-26T13:59:40.000000Z",
        "id": 10
    },
    "token": "15|F4zQKDsQmfXl9TnMt9Qf5pPIgxMdBX1D655R2d4oee3ce12c"
}

POST:/api/login

payload:
{
    "name": "Flerick",
    "email": "flerick@apple.com",
    "password": "secretpassword",
    "password_confirmation": "secretpassword"
}

Responce:

{
    "message": "Login successful",
    "user": {
        "id": 12,
        "name": "John Doe9",
        "email": "johndoe@hetqeedfd5srd6llddDo.com",
        "email_verified_at": null,
        "created_at": "2024-11-26T14:03:14.000000Z",
        "updated_at": "2024-11-26T14:03:14.000000Z"
    },
    "token": "19|P2lU4Y6GX5fyW29oxwsHZmYkYAZlAqIfxw14DrEff79c17fe"
}


POST:/api/loout

Need to pass token in header


{
    "message": "Logged out successfully"
}


Filter

GET: api/articles?page=2&source=Unknown

{
    "current_page": 2,
    "data": [
        {
            "id": 11,
            "title": "Australia news live: NSW government to refund $5.5m in Covid fines; overdoses prompt warning over fake oxycodone",
            "content": "",
            "author": null,
            "category": null,
            "source": "Unknown",
            "published_at": "2024-11-26 11:52:09",
            "created_at": "2024-11-26T06:22:09.000000Z",
            "updated_at": "2024-11-26T06:22:09.000000Z"
        },
        {
            "id": 15,
            "title": "Afternoon Update: Trump’s tariffs plan; social media ban scramble continues; and an ‘almost respectable’ word of the year",
            "content": "",
            "author": null,
            "category": null,
            "source": "Unknown",
            "published_at": "2024-11-26 11:52:09",
            "created_at": "2024-11-26T06:22:09.000000Z",
            "updated_at": "2024-11-26T06:22:09.000000Z"
        },
        {
            "id": 16,
            "title": "‘Crisis’ of domestic violence in NT needs immediate action, advocates say after landmark report released",
            "content": "",
            "author": null,
            "category": "abc",
            "source": "Unknown",
            "published_at": "2024-11-26 11:52:09",
            "created_at": "2024-11-26T06:22:09.000000Z",
            "updated_at": "2024-11-26T06:22:09.000000Z"
        },
        {
            "id": 19,
            "title": "‘We need a cultural revolution’: femicide victim’s family seek change in Italy ",
            "content": "",
            "author": null,
            "category": null,
            "source": "Unknown",
            "published_at": "2024-11-26 11:52:09",
            "created_at": "2024-11-26T06:22:09.000000Z",
            "updated_at": "2024-11-26T06:22:09.000000Z"
        },
        {
            "id": 20,
            "title": "‘Strictly terrified me!’ Chris McCausland on self-belief, shame and becoming the star of the show",
            "content": "",
            "author": null,
            "category": null,
            "source": "Unknown",
            "published_at": "2024-11-26 11:52:09",
            "created_at": "2024-11-26T06:22:09.000000Z",
            "updated_at": "2024-11-26T06:22:09.000000Z"
        }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/articles?page=3",
    "path": "http://127.0.0.1:8000/api/articles",
    "per_page": 10,
    "prev_page_url": "http://127.0.0.1:8000/api/articles?page=1",
    "to": 20,
    "total": 38
}


GET:/api/articles/ 1

Responce:
{
    "id": 1,
    "title": "Far-right candidate takes shock lead in Romania presidential election",
    "content": "Calin Georgescu, a critic of the EU and Nato, looks set to face the pro-Europe prime minister in the second round.",
    "author": null,
    "category": null,
    "source": "Unknown",
    "published_at": "2024-11-26 11:52:09",
    "created_at": "2024-11-26T06:22:09.000000Z",
    "updated_at": "2024-11-26T06:22:09.000000Z"
}

GET:

/api/articless/fetch


{"message":"Articles fetched successfully"}

POST:

api/preferences

Payload
{
    "category": "abc",
    "sources": "test",
    "author": "test"
}

Responce:
{
    "id": 4,
    "user_id": 4,
    "category": "abc",
    "sources": "test2",
    "author": "test5",
    "created_at": "2024-11-26T08:21:15.000000Z",
    "updated_at": "2024-11-26T14:25:46.000000Z"
}

GET:
api/preferences

{
    "id": 4,
    "user_id": 4,
    "category": "abc",
    "sources": "test2",
    "author": "test5",
    "created_at": "2024-11-26T08:21:15.000000Z",
    "updated_at": "2024-11-26T14:25:46.000000Z"
}