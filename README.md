# Stylo - Fashion E-commerce Web Application

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Livewire](https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge&logo=livewire)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)

**Stylo** is a modern Fashion E-commerce Monolith built with **Laravel 12**, **Blade**, **Livewire**, and **Tailwind CSS**. The project follows a strict "Earthy Luxury" design aesthetic and clean architectural patterns.

---

##  Design System: "Earthy Luxury"

We use a custom Tailwind configuration to enforce the design system.

### Colors
| Name | Class | Hex | Usage |
| :--- | :--- | :--- | :--- |
| **Bone White** | `bg-bone` | `#FAF9F6` | Main Background |
| **Espresso** | `bg-primary` / `text-primary` | `#2C2A29` | Primary Text, Buttons, Footer |
| **Sand** | `bg-secondary` / `border-secondary` | `#E8E6E1` | Borders, Secondary Backgrounds |
| **Muted Gold** | `text-accent` / `bg-accent` | `#C5A880` | Accents, Hover States, Badges |

### Fonts
*   **Headings:** `font-serif` (Playfair Display)
*   **Body:** `font-sans` (Inter)

### UI Components
*   **Buttons:** Sharp edges (`rounded-none`).
*   **Inputs:** Sharp edges, minimal borders.

---

##  Tech Stack & Rules

*   **Backend:** Laravel 12 (PHP 8.2+)
*   **Frontend:** Blade Templates + Tailwind CSS v4
*   **Interactivity:** Laravel Livewire (Search, Filter, Dynamic Forms)
*   **Database:** MySQL 8.0
*   **Authentication:** Laravel Socialite (Google Auth) + Custom Auth

**Strict Rules:**
*    NO Bootstrap
*    NO React/Vue (except Livewire)
*    NO jQuery
*    Use Resource Controllers & FormRequests

---

##  Folder Structure

``napp/
  Http/
    Controllers/
      Admin/          # Admin-facing controllers (CRUD)
      Front/          # Customer-facing controllers
      Auth/           # Authentication logic
    Requests/         # Form Validation classes
resources/
  views/
    admin/            # Admin templates
    front/            # Customer templates
    layouts/          # Master layouts (admin.blade.php, app.blade.php)
    components/       # Reusable Blade components
` 

---

##  Commit Convention

We follow the **Conventional Commits** specification. Please use the following prefixes:

*   `feat:` New feature (e.g., `feat: add product crud`)
*   `fix:` Bug fix (e.g., `fix: resolve login redirect issue`)
*   `docs:` Documentation changes (e.g., `docs: update readme`)
*   `style:` Formatting, missing semi-colons, etc; no code change
*   `refactor:` Refactoring production code
*   `test:` Adding tests, refactoring test; no production code change
*   `chore:` Updating build tasks, package manager configs, etc.
*   `perf:` Code change that improves performance

---

##  Setup Instructions

1.  **Clone the repository**
    `ash
    git clone https://github.com/Narapati24/Stylo.git
    cd Stylo
    ` 

2.  **Install Dependencies**
    `ash
    composer install
    npm install
    ` 

3.  **Environment Setup**
    `ash
    cp .env.example .env
    php artisan key:generate
    ` 
    *Configure your database in `.env`.*
    *Add Google OAuth credentials in `.env`:*
    `env
    GOOGLE_CLIENT_ID=your_client_id
    GOOGLE_CLIENT_SECRET=your_client_secret
    GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
    ` 

4.  **Run Migrations & Seeders**
    `ash
    php artisan migrate:fresh --seed
    ` 
    *Creates Admin (`admin@stylo.com`) and Customer (`customer@stylo.com`) accounts.*

5.  **Run Development Server**
    `ash
    npm run dev   # Terminal 1
    php artisan serve # Terminal 2
    ` 

---

##  Team

| Role | Name | GitHub |
| :--- | :--- | :--- |
| **Project Manager** | Narapati Keysa Anandi | [@Narapati24](https://github.com/Narapati24) |
| **Team Member** | ... | ... |
