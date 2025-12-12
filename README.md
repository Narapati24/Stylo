# ✨ Stylo - Fashion E-commerce Web Application

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Livewire](https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge&logo=livewire)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)

Stylo is a modern fashion e-commerce monolith built with Laravel 12, Blade, Livewire, and Tailwind CSS.  
The application follows a curated **Earthy Luxury** design system with a clean and strict architecture.

---

## 🌿 Design System: Earthy Luxury

A custom Tailwind configuration is used to enforce visual consistency.

### Colors
| Name | Class | Hex | Usage |
| :--- | :--- | :--- | :--- |
| **Bone White** | `bg-bone` | `#FAF9F6` | Main background |
| **Espresso** | `bg-primary` / `text-primary` | `#2C2A29` | Primary text, buttons, footer |
| **Sand** | `bg-secondary` / `border-secondary` | `#E8E6E1` | Borders, secondary surfaces |
| **Muted Gold** | `text-accent` / `bg-accent` | `#C5A880` | Accents, hover states, badges |

### Typography
- **Headings:** `font-serif` (Playfair Display)  
- **Body:** `font-sans` (Inter)

### UI Guidelines
- Inputs follow a minimal aesthetic with subtle borders  

---

## 🧩 Tech Stack & Development Rules

### Core Stack
- **Backend:** Laravel 12 (PHP 8.2+)  
- **Frontend:** Blade Templates + Tailwind CSS v4  
- **Interactivity:** Livewire 3  
- **Database:** MySQL 8.0  
- **Authentication:** Laravel Socialite (Google OAuth)  

### Project Rules
- No Bootstrap  
- No React/Vue (except Livewire)  
- No jQuery  
- Use Resource Controllers & Form Requests  

---

## 🌿 Branching & Commit Workflow

### 1. Branch Naming

Use the following format:

```
feature/{feature-name}
```

Example:

```
feature/product-crud
feature/google-auth
```

Never commit directly to `main`.

---

### 2. How to Commit (Conventional Commits)

1. Create your branch:
```bash
git checkout -b feature/{feature-name}
```

2. Stage changes:
```bash
git add .
```

3. Commit with the correct prefix:
```bash
git commit -m "feat: add product CRUD"
```

4. Push the branch:
```bash
git push -u origin feature/{feature-name}
```

5. Open a Pull Request and wait for review.

---

## 📝 Conventional Commit Prefixes

- `feat:` New feature  
- `fix:` Bug fix  
- `docs:` Documentation updates  
- `style:` Formatting-only changes  
- `refactor:` Code restructure without behavior change  
- `test:` Tests added or updated  
- `chore:` Config or dependency updates  
- `perf:` Performance improvements  

---

## 📁 Folder Structure

```
app/
  Http/
    Controllers/
      Admin/          # Admin-facing CRUD controllers
      Front/          # Customer-facing controllers
      Auth/           # Authentication controllers
    Requests/         # Form validation classes

resources/
  views/
    admin/            # Admin templates
    front/            # Customer templates
    layouts/          # Master layouts
    components/       # Reusable Blade components
```

---

## 🚀 Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/Narapati24/Stylo.git
cd Stylo
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Configure database in `.env`  
Add Google OAuth:

```
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 4. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

Default accounts:
- Admin: `admin@stylo.com`  
- Customer: `customer@stylo.com`

### 5. Run Development Servers
```bash
npm run dev
php artisan serve
```

---

## 👥 Team Members

| NPM | Name | Role | GitHub Profile |
| :--- | :--- | :--- | :--- |
| `223040155` | **Narapati Keysa Anandi** | Project Manager / Fullstack | [Link](https://github.com/Narapati24) |
| `XXXXXXXXX` | **[Member Name]** | Backend Developer | [Link](https://github.com/) |
| `XXXXXXXXX` | **[Member Name]** | Backend Developer | [Link](https://github.com/) |
| `XXXXXXXXX` | **[Member Name]** | Frontend Developer | [Link](https://github.com/) |
| `XXXXXXXXX` | **[Member Name]** | Frontend Developer | [Link](https://github.com/) |
