# 🎮 Mobile Legends Blogspot

<p align="center">
  <b>A game-themed full-stack blog web application built with Laravel 12 and Tailwind CSS v4.</b><br>
  Developed as part of the ACD AI-Powered Web Development Workshop 2026.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12(LTS)-red?style=for-the-badge">
  <img src="https://img.shields.io/badge/Tailwind-v4(LTS)-blue?style=for-the-badge">
  <img src="https://img.shields.io/badge/PHP-8.2.12-purple?style=for-the-badge">
  <img src="https://img.shields.io/badge/Node.js-22.20.0-green?style=for-the-badge">
</p>

---

## 👥 Team

| Name                  | Role                             |
| --------------------- | -------------------------------- |
| Christian Paul Manota | Initial Developer / Workshop Facilitator |
| Christian Paul Manota | Developer / Workshop Facilitator |
| Christian Paul Manota | Security Auditor / Workshop Facilitator |


---

## 🧰 Tech Stack & Required Versions

> ⚠️ IMPORTANT: Use EXACT versions listed below to avoid compatibility issues.

| Software     | Version            | Download                      |
| ------------ | ------------------ | ----------------------------- |
| XAMPP        | PHP bundled         | https://www.apachefriends.org |
| PHP          | 8.2.12              | Bundled inside XAMPP          |
| Composer     | 2.9.5                | https://getcomposer.org       |
| Laravel      | 12 (latest)        | Installed via Composer        |
| Tailwind CSS | v4 (latest)        | Installed via npm             |
| Node.js      | v22.20.0           | https://nodejs.org            |
| NPM          | 10.9.3             | Bundled with Node.js          |
| MySQL        | Bundled with XAMPP | https://www.apachefriends.org |

---

## ⚙️ Local Setup Instructions for Collaborators

> 📌 Follow these steps EXACTLY and in ORDER to get the project running on your machine.

---

### 🪜 Step 1 — Install Required Software

Install the following before cloning the project:

* XAMPP (with PHP 8.2.12) → https://www.apachefriends.org
* Composer → https://getcomposer.org
* Node.js v22 LTS → https://nodejs.org
* Git → https://git-scm.com

Verify your installations by running these commands:

```bash
php -v
composer --version
node -v
npm -v
```

---

### 🟢 Step 2 — Start XAMPP

Open XAMPP Control Panel and start both:

* ✅ Apache
* ✅ MySQL

---

### 📥 Step 3 — Clone the Repository

```bash
git clone https://github.com/krianmanota23/blogspot-mobilelegends.git
cd blogspot-mobilelegends
```

---

### 📦 Step 4 — Install PHP Dependencies

```bash
composer install
```

---

### 📦 Step 5 — Install Node Dependencies

```bash
npm install
```

---

### 🧾 Step 6 — Create Environment File

```bash
cp .env.example .env
```

Then open the .env file and update these values:

```env
APP_NAME="Mobile Legends Blogspot"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ml_blogspot
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=database
```

---

### 🔑 Step 7 — Generate Application Key

```bash
php artisan key:generate
```

---

### 🗄️ Step 8 — Create the Database

1. Open your browser and go to: http://localhost/phpmyadmin
2. Click "New" on the left sidebar
3. Name the database: ml_blogspot
4. Click "Create"

---

### 🧱 Step 9 — Run Database Migrations

```bash
php artisan migrate
```

You should see these tables created:

* ✅ posts
* ✅ sessions
* ✅ cache
* ✅ jobs

---

### 🔗 Step 10 — Create Storage Link for Image Uploads

```bash
php artisan storage:link
```

---

### 🚀 Step 11 — Run the Development Servers

Open TWO terminal windows and run one command in each:

**Terminal 1:**

```bash
php artisan serve
```

**Terminal 2:**

```bash
npm run dev
```

---

### 🌐 Step 12 — Open the App

Visit: http://localhost:8000

---

## 🔐 Admin Access

| Field    | Value                       |
| -------- | --------------------------- |
| URL      | http://localhost:8000/login |
| Username | mladmin                     |
| Password | mobilelegends2026           |

> ⚠️ These are static credentials hardcoded in AuthController.php
> Change them before any public deployment.

---

## 🗄️ Database Schema

### posts table

| Column         | Type                 | Description                          |
| -------------- | -------------------- | ------------------------------------ |
| id             | bigint               | Primary key                          |
| title          | string               | Post headline                        |
| slug           | string (unique)      | URL-friendly title                   |
| excerpt        | text (nullable)      | Short preview shown on homepage      |
| content        | longtext             | Full blog post body                  |
| featured_image | string (nullable)    | Path to uploaded image               |
| category       | string               | Hero Guide, Patch Notes, Event, etc. |
| status         | enum                 | published or draft                   |
| author         | string               | Static admin name                    |
| published_at   | timestamp (nullable) | When post went live                  |
| created_at     | timestamp            | Auto-generated by Laravel            |
| updated_at     | timestamp            | Auto-generated by Laravel            |

### sessions table

| Column        | Type   | Description                   |
| ------------- | ------ | ----------------------------- |
| id            | string | Unique session ID             |
| ip_address    | string | Visitor IP address            |
| user_agent    | text   | Browser information           |
| payload       | text   | Encrypted session data        |
| last_activity | int    | Unix timestamp of last action |

---

## 📁 Project Structure

```bash
blogspot/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── PostController.php    ← CRUD for posts
│   │   │   └── AuthController.php    ← Static login/logout
│   │   └── Middleware/
│   │       └── AdminMiddleware.php   ← Protects admin routes
│   └── Models/
│       └── Post.php                  ← Post model with fillable
├── database/
│   └── migrations/                   ← posts + sessions tables
├── resources/
│   ├── css/
│   │   └── app.css                   ← Tailwind CSS v4 entry
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php         ← Master layout
│       ├── auth/
│       │   └── login.blade.php       ← Admin login page
│       ├── posts/
│       │   ├── index.blade.php       ← Public homepage
│       │   └── show.blade.php        ← Single post detail
│       └── admin/
│           └── posts/
│               ├── index.blade.php   ← Admin dashboard
│               ├── create.blade.php  ← Create post form
│               └── edit.blade.php    ← Edit post form
├── routes/
│   └── web.php                       ← All application routes
├── storage/
│   └── app/public/images/            ← Uploaded post images
├── .env                              ← Environment config (not in git)
├── .env.example                      ← Template for collaborators
├── vite.config.js                    ← Vite + Tailwind v4 config
└── README.md                         ← This file
```

---

## 🌐 Application Routes

| Method | URL                    | Description                    | Access     |
| ------ | ---------------------- | ------------------------------ | ---------- |
| GET    | /                      | Homepage — all published posts | Public     |
| GET    | /post/{slug}           | Single post detail             | Public     |
| GET    | /login                 | Admin login page               | Public     |
| POST   | /login                 | Submit login form              | Public     |
| POST   | /logout                | Logout admin                   | Admin      |
| GET    | /admin/posts           | Admin dashboard                | Admin only |
| GET    | /admin/posts/create    | Create post form               | Admin only |
| POST   | /admin/posts           | Save new post                  | Admin only |
| GET    | /admin/posts/{id}/edit | Edit post form                 | Admin only |
| PUT    | /admin/posts/{id}      | Update post                    | Admin only |
| DELETE | /admin/posts/{id}      | Delete post                    | Admin only |

---

## 🔒 Security Notes

* All admin routes are protected by AdminMiddleware
* Static login credentials are hardcoded in AuthController.php
* All forms include @csrf protection
* File uploads validate type (jpg, jpeg, png, gif) and size (max 2MB)
* All Blade output uses {{ }} — never {!! !!}
* Session driver is set to database

---

## 🎨 UI Theme

| Role               | Color          | Hex     |
| ------------------ | -------------- | ------- |
| Primary background | Dark navy      | #0A0E1A |
| Card background    | Dark blue-gray | #111827 |
| Accent / highlight | ML Gold        | #C89B3C |
| Hero text          | Bright white   | #F5F5F5 |
| Muted text         | Light gray     | #9CA3AF |
| Danger / Delete    | Red            | #DC2626 |
| Success / Save     | Teal           | #0D9488 |

---

## 📋 Common Commands Reference

```bash
# Start development servers (run both in separate terminals)
php artisan serve
npm run dev

# Database
php artisan migrate
php artisan migrate:rollback
php artisan migrate:status

# Create new files
php artisan make:model ModelName
php artisan make:controller ControllerName --resource
php artisan make:migration create_table_name

# Storage
php artisan storage:link

# View all routes
php artisan route:list

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 🏫 Workshop Information

| Detail       | Info                                         |
| ------------ | -------------------------------------------- |
| Event        | ACD AI-Powered Web Development Workshop 2026 |
| Institution  | Assumption College of Davao — BSIT Program   |
| Dates        | May 4–6, 2026                                |
| Schedule     | 1:00 PM – 5:00 PM daily                      |
| Facilitators | Christian Paul Manota, Jay ar, Sean          |

---

<p align="center">
  <i>Built with inspiration for the ACD BSIT AI Workshop 2026</i>
</p>
