# 🕊️ Resting Heritage

**Resting Heritage** is a cultural-historical mapping application that helps visitors discover the resting places of
notable individuals in cemeteries, plan walking routes, and learn about their lives through interactive digital means.

> _“Where memory lives and history rests.”_

---

## 📌 Project Goals

- 📍 Locate famous graves in cemeteries
- 🗺️ Display cemetery maps with routes to graves
- 🧭 Allow walking path planning with pgRouting
- 🧑‍🏫 Provide educational and biographical content
- 🌐 Support both local and international visitors

---

## 🧰 Tech Stack

| Layer     | Technology                       |
|-----------|----------------------------------|
| Backend   | PHP, Laravel                     |
| Frontend  | Vue.js, Vite, TailwindCSS        |
| Database  | PostgreSQL + PostGIS + pgRouting |
| Mapping   | Leaflet.js                       |
| Dev Tools | PHPStorm, Composer, NPM          |

---

## 📂 Project Structure (Monorepo)

resting-heritage/<br>
├── app/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # Laravel backend (models, controllers)<br>
├── resources/<br>
│ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ├── js/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # Vue frontend components<br>
│ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; └── views/ &nbsp;&nbsp; # Blade templates<br>
├── routes/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # Web + API routes<br>
├── database/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # Migrations, seeders<br>
├── public/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # Public assets<br>
├── .env.example &nbsp;&nbsp;&nbsp;&nbsp; # Environment template<br>
├── composer.json &nbsp;&nbsp; # Laravel deps<br>
├── package.json &nbsp;&nbsp;&nbsp;&nbsp; # Frontend deps<br>
├── vite.config.js &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # Vite config for Vue<br>
└── README.md &nbsp;&nbsp;&nbsp; # You are here<br>


---

## 🚀 Installation

### 1. Clone repository

```bash
git clone https://github.com/ZoltaniSzabolcs/resting-heritage.git
cd resting-heritage
```

### 2. Setup backend

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Edit .env to match your PostgreSQL/PostGIS/pgRouting database:

```ini
DB_CONNECTION = pgsql
DB_HOST = 127.0.0.1
DB_PORT = 5432
DB_DATABASE = resting_heritage
DB_USERNAME = youruser
DB_PASSWORD = yourpassword
```

Enable PostGIS in your DB (in psql):

```postgresql
CREATE EXTENSION IF NOT EXISTS postgis;
CREATE EXTENSION IF NOT EXISTS pgrouting;
```

Run migrations:

```bash
php artisan migrate
```

### 3. Setup frontend

```bash
npm install
npm run dev
```

## 🌐 Usage

```bash
php artisan serve
```

- php artisan serve → Launch Laravel on http://127.0.0.1:8000

- Vue.js components mount in Blade views (resources/views)
