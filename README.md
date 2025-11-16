#  Booking System API – Laravel 12

A **RESTful API** for managing bookings, events, and categories, built with **Laravel 12**.  
Supports user registration, authentication, role-based access, and event reservations with **seat availability validation**.

---

##  Features

### User Management
- Register, login, logout
- Role-based access: Admin / User
- Personal Access Tokens (Sanctum)

### Categories
- List, show, create, update, delete
- Toggle active/inactive status
- Admin-only management for create/update/delete

### Events
- List, show, create, update, delete
- Toggle active/inactive status
- Belongs to categories
- Admin-only management for create/update/delete

### Bookings
- Users can book events
- Prevent double-booking
- Seat availability check before booking
- Update booking status: pending, confirmed, cancelled
- Toggle active/inactive status
- Admin-only access for listing and managing bookings

### API Resources
- Clean and structured responses via Laravel Resources
- Includes related data: Event with Category, Booking with Event & User

### Validation & Security
- Request validation for all operations
- Middleware to enforce admin-only routes
- Sanctum authentication

---

##  Modules

| Module     | Endpoints                                                                                                               | Access       |
| ---------- | ----------------------------------------------------------------------------------------------------------------------- | ------------ |
| Auth       | POST `/register`, POST `/login`, POST `/logout`, GET `/user`                                                            | Public/Auth  |
| Categories | GET `/categories`, GET `/categories/{id}`, POST `/categories`, POST `/categories/{id}`, PATCH `/categories/{id}/toggle` | Public/Admin |
| Events     | GET `/events`, GET `/events/{id}`, POST `/events`, POST `/events/{id}`, PATCH `/events/{id}/toggle`                     | Public/Admin |
| Bookings   | GET `/bookings`, GET `/bookings/{id}`, POST `/bookings`, PUT `/bookings/{id}`, PATCH `/bookings/{id}/toggle`            | Admin/User   |

---

##  Installation

1. **Clone the repository**

```bash
git clone <repo-url>
cd booking-system-api
```

2. **Install dependencies** using Composer

```bash
composer install    
```

3. **Run migrations and seeders**

```bash
php artisan migrate:fresh --seed
```

4. **Start the server**

```bash
php artisan serve
``` 
##  Authentication

- Uses **Laravel Sanctum** for API token authentication.
- Routes are protected with `auth:sanctum` middleware.
- Admin-only routes are additionally protected with `is-admin` middleware.
---




