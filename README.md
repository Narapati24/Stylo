# Stylo - Fashion E-commerce Web Application

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Livewire](https://img.shields.io/badge/Livewire-3.x-4E56A6?style=for-the-badge&logo=livewire)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)

**Stylo** is a modern Fashion E-commerce Web Application developed as a Final Project for **Praktikum Pemrograman Web (2025/2026)** at **Universitas Pasundan**. This application is built using the **Laravel 12 Monolith** architecture, leveraging **Blade Templates** for the frontend and **Livewire** for dynamic interactions, ensuring a seamless user experience without the complexity of a full SPA.

---

## 👥 Team Members

| NPM | Name | Role | GitHub Profile |
| :--- | :--- | :--- | :--- |
| `223040155` | **Narapati Keysa Anandi** | Project Manager / Fullstack | [Link](https://github.com/Narapati24) |
| `XXXXXXXXX` | **[Member Name]** | Backend Developer | [Link](https://github.com/) |
| `XXXXXXXXX` | **[Member Name]** | Backend Developer | [Link](https://github.com/) |
| `XXXXXXXXX` | **[Member Name]** | Frontend Developer | [Link](https://github.com/) |
| `XXXXXXXXX` | **[Member Name]** | Frontend Developer | [Link](https://github.com/) |

---

## 🚀 Key Features

### 🛍️ User Client (Front-Office)
*   **Landing Page:** Attractive homepage showcasing featured products and promotions.
*   **Product Catalog:** Browse fashion items with detailed descriptions and images.
*   **Live Search & Filter:** Real-time product searching and category filtering powered by **Laravel Livewire** (No page reload).
*   **Shopping Cart:** Add items to cart, update quantities, and view total price.
*   **Checkout System:** Secure checkout process for finalizing orders.

### 🛠️ Admin Dashboard (Back-Office)
*   **Dashboard Stats:** Overview of total products, orders, and revenue.
*   **Product Management (CRUD):** Add, edit, and delete products with **Image Upload** and strict **Server-side Validation**.
*   **Category Management:** Organize products into categories.
*   **PDF Reporting:** Generate and download sales reports in PDF format.

### ⚙️ Technical Specifications
*   **Public API Integration:** Connected to external APIs (e.g., RajaOngkir for shipping costs or Currency Converter).
*   **Authentication:** Secure Login, Register, and Logout functionality for Users and Admins.
*   **Responsive Design:** Fully responsive layout built with **Tailwind CSS**.

---

## 💻 Tech Stack

*   **Framework:** Laravel 12 (PHP 8.2+)
*   **Frontend:** Blade Templates, Tailwind CSS (Manual Setup)
*   **Interactivity:** Laravel Livewire
*   **Database:** MySQL
*   **Version Control:** Git & GitHub

---

## 📂 Folder Structure

We follow a strict separation of concerns between Admin (Backend logic) and Front (User logic) to minimize conflicts.

```text
app/Http/Controllers/
├── Admin/                  <-- Admin Logic
│   ├── DashboardController.php
│   ├── ProductController.php
│   ├── CategoryController.php
│   └── ReportController.php
└── Front/                  <-- User Logic
    ├── HomeController.php
    ├── CartController.php
    └── CheckoutController.php

resources/views/
├── layouts/                <-- Master Layouts
│   ├── admin.blade.php
│   └── app.blade.php
├── components/             <-- Reusable Blade Components
│   ├── product-card.blade.php
│   └── alert.blade.php
├── admin/                  <-- Admin Views
│   ├── products/
│   └── dashboard.blade.php
└── front/                  <-- User Views
    ├── home.blade.php
    ├── product-detail.blade.php
    └── cart.blade.php
```

---

## 🛠️ Installation Guide

Follow these steps to set up the project locally:

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/Narapati24/stylo.git
    cd stylo
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Setup**
    Copy the example environment file and configure your database credentials.
    ```bash
    cp .env.example .env
    ```
    *Open `.env` and set your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.*

4.  **Generate App Key**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations & Seeders**
    ```bash
    php artisan migrate --seed
    ```

6.  **Run the Application**
    Start the local development server and asset compiler.
    ```bash
    # Terminal 1
    php artisan serve

    # Terminal 2
    npm run dev
    ```

7.  **Access the App**
    *   User: `http://127.0.0.1:8000`
    *   Admin: `http://127.0.0.1:8000/admin`

---

## 🤝 Contribution Guidelines (SOP)

To ensure a smooth workflow and high code quality, all team members must adhere to the following rules:

1.  **Branching Strategy:**
    *   `main`: Production-ready code only.
    *   `dev`: Integration branch. Merge features here first.
    *   `feature/feature-name`: Working branch for specific tasks (e.g., `feature/login-page`, `feature/product-crud`).
2.  **Commit Rules:**
    *   Write clear and descriptive commit messages.
    *   **Requirement:** Each member must have a **minimum of 10 commits**.
3.  **Styling Rules:**
    *   **STRICTLY NO Bootstrap or Materialize.** Use **Tailwind CSS** or custom CSS only.
    *   Use Blade Components for reusable UI elements.
4.  **Code Etiquette:**
    *   Do not edit files outside your assigned module without communication.
    *   Always pull the latest changes from `dev` before pushing.

---

**Universitas Pasundan - 2025/2026**

