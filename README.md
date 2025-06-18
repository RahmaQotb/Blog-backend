# 🧠 Blog API (Laravel)

A clean and modular blog API built using Laravel 10 with support for authentication, multilingual posts, media uploads, and nested comments.

---

## ✅ Setup Instructions

1. **Clone the Repository**
   ```bash
   git clone https://github.com/RahmaQotb/Blog-Api.git
   cd Blog-Api
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
   - Update `.env`:
     ```
     DB_DATABASE=your_database
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Install JWT Auth**
   ```bash
   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
   php artisan jwt:secret
   ```

7. **Install Spatie MediaLibrary**
   ```bash
   php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"
   php artisan migrate
   ```

8. **Set File Permissions**
   ```bash
   php artisan storage:link
   ```

9. **Serve the Project**
   ```bash
   php artisan serve
   ```

---

## 🧩 Summary of Implementation

### 🔐 Authentication
- JWT-based using `tymon/jwt-auth`.
- Endpoints: `register`, `login`, `logout`, `refresh`.
- Encapsulated logic via Service & Repository layers.

### 📝 Posts Module
- Full CRUD support.
- Multilingual fields (`title`, `content`) with `spatie/laravel-translatable`.
- Images handled via `spatie/laravel-medialibrary` with multiple uploads per post.
- Posts accessed using slugs (e.g. `/api/posts/my-title-slug`).
- File structure follows clean architecture (Controller → Service → Repository).

### 💬 Comments & Replies
- Add comments to posts.
- Nested replies via self-referencing `parent_id`.
- List replies of any comment.
- Update/delete comments and replies.
- Each comment includes author name.

### 🌍 Localization
- Supports multilingual posts.
- Language detected from `Accept-Language` header (e.g., `ar`, `en`).

### 📦 Technologies
- Laravel 10
- JWT Auth
- Spatie Translatable & MediaLibrary
- PHP 8+
- MySQL

---

## 📮 API Usage via Postman

### Required Headers
- `Authorization: Bearer <token>`
- `Accept-Language: ar` or `en`

### Postman Collections
Include requests for:
- Auth (`register`, `login`, `logout`, `refresh`)
- Posts (`store`, `update`, `delete`, `index`)
- Comments & Replies (`store`, `index`, `update`, `delete`)
