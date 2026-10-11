# 📖 Quran Academy - Back-End Management System

An advanced, enterprise-grade back-end infrastructure for the Quran Academy platform. Built adhering to standard software architecture principles to manage Authentication (RBAC), Scheduling, Academic Performance Tracking, Communications, and Billing Systems.

## 🛠️ Tech Stack

*   **Framework:** Laravel v13.11.0
*   **Language:** PHP v8.4 (Fully optimized)
*   **Database:** PostgreSQL (v18.6)
*   **Caching & Queue System:** Redis (Production-ready)
*   **Containerization:** Docker & Laravel Sail (Pre-configured)

---

## 🗂️ Database Architecture & Eloquent Models (ERD)

The database schema and relations have been engineered **exactly according to the approved ERD specification**, generating a total of **24 database tables** (16 standalone application tables and 8 native core system tables) structured as follows:

1.  **Identity & RBAC (Access Control):** `users`, `teacher_profiles`, `student_profiles`, `guardian_profiles`.
2.  **Scheduling & Time Management:** `teacher_availabilities`, `quran_sessions` *(Renamed to avoid naming collision with Laravel core tables)*.
3.  **Academic & Quality Control:** `courses`, `student_courses`, `academic_plans`, `session_notes`, `attendance_records`, `progress_records`.
4.  **Subscriptions & Billing Management:** `plans`, `subscriptions`, `payments`.
5.  **System Communication:** `notifications`.
6.  **Laravel System Cores:** `cache`, `cache_locks`, `failed_jobs`, `job_batches`, `jobs`, `migrations`, `password_reset_tokens`, `sessions`.

> 💡 **Architectural Note:** All Eloquent Models and dynamic relational mappings (`hasMany`, `belongsTo`, `hasOne`) are thoroughly defined within the `app/Models` directory, strictly following PSR clean-coding conventions.

---

## 🚀 Developer Setup Guide

Follow these sequential steps to safely spin up the environment locally:

### 1. Clone the Repository & Install Dependencies
```bash
git clone <YOUR_REPOSITORY_URL>
cd quran-academy
composer install
```

### 2. Configure Environment Variables (.env)
Generate your local configuration file from the template:
```bash
cp .env.example .env
```
Open the `.env` file and set up your PostgreSQL credentials and Redis parameters.

### 3. Run the Isolated Environment via Docker (Laravel Sail)
The project is decoupled from local machine servers using **Laravel Sail**. Ensure **Docker Desktop** is up and running, then execute:
```bash
./vendor/bin/sail up -d
```

### 4. Database Initialization & Schema Building (24 Tables)
To build the complete structural layout instantly within your database instance:
```bash
# If using the initialized Docker infrastructure (Laravel Sail):
./vendor/bin/sail artisan migrate:fresh

# If using a local native web server (XAMPP / PHP CLI):
php artisan migrate:fresh
```

---
**The project structure, base business logic, and schema constraints are successfully provisioned 100%.** ✨
