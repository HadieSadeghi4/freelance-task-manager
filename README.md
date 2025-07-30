# Freelance Task Manager API

A role-based Laravel REST API for managing freelance tasks with three main user roles: **Admin**, **Client**, and **Freelancer**.
---

## ✨ Features

- Role-based access control with Admin, Client, and Freelancer roles  
- Authentication with Laravel Sanctum (token-based)  
- Task management: clients can create, update, delete tasks  
- Proposal system: freelancers can send proposals for tasks  
- Admin panel APIs for user and task management  
- Simple, clean RESTful API design  
- Seeders for initial data setup  

---

## 🔧 Tech Stack

- Laravel v12.2.0
- Sanctum (for Authentication)
- MySQL
- Postman (for API testing)

---

## 🚀 Installation

```bash
git clone https://github.com/HadieSadeghi4/freelance-task-manager.git
cd freelance-task-manager
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> Configure your `.env` file with your DB credentials before running the commands.

---

## 🧑‍💼 Roles & Permissions

| Role       | Description                                   | Key Abilities |
|------------|-----------------------------------------------|---------------|
| **Admin**  | System owner with full access                 | Manage users, change roles, view all tasks |
| **Client** | Task creator who posts jobs                   | Create/update/delete tasks, review proposals, assign tasks |
| **Freelancer** | Task seeker who sends proposals          | Browse tasks, submit proposals, deliver completed work |

---

## 📬 Authentication

- `POST /api/register` – Register new user
- `POST /api/login` – Login user & get token

---

## 🗂️ API Endpoints (Postman structure)

### 🔐 Auth
- `POST /api/register`
- `POST /api/login`

### 🛠️ Admin
- `GET /api/admin/users`
- `PATCH /api/admin/users/{id}/role`
- `DELETE /api/admin/users/{id}`
- `GET /api/admin/tasks`

### 👤 Client
- `POST /api/client/tasks`
- `GET /api/client/tasks`
- `PUT /api/client/tasks/{id}`
- `GET /api/client/tasks/{task}/proposals`
- `POST /api/client/proposals/{id}/accept`
- `POST /api/client/proposals/{id}/reject`

### 🎯 Freelancer
- `GET /api/freelancer/tasks`
- `POST /api/freelancer/tasks/{id}/proposals`
- `GET /api/freelancer/tasks/{id}/submit`

---

## 🧪 Postman

You can import the Postman collection to test all APIs easily.

---
## 📌 Usage

- Register users with different roles  
- Clients create and manage tasks  
- Freelancers browse tasks and send proposals  
- Admin manages users and oversees tasks  

---

## 🔍 Project Status

- Stable API with core features implemented  
- Planned improvements: notifications, advanced filtering, frontend integration  
---

## ✅ License

MIT
