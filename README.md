# 🚀 Laravel + Vue 3 Starter Kit

Welcome 👋  
This is a modern and flexible starter kit that helps you quickly launch full-stack web applications using **Laravel + Vue 3 + Inertia.js + TailwindCSS**.  
It’s designed to save you time by providing a clean and scalable foundation for any new project — with optional internationalization (i18n) support.

---

## 🧠 Overview

Instead of rebuilding the same boilerplate over and over — setting up Inertia, Vue, Tailwind, authentication, and translations — this starter kit gives you a ready-to-use base so you can **focus on building your application**, not the setup.

---

## ⚙️ Technologies Used

| Tech               | Description                                      |
|--------------------|--------------------------------------------------|
| **Laravel 12**     | Back-end framework                              |
| **Jetstream**      | Authentication scaffolding with Inertia support |
| **Inertia.js**     | Connects Laravel and Vue without API layers     |
| **Vue 3**          | Reactive front-end framework                     |
| **TailwindCSS**    | Utility-first CSS for styling                    |
| **shadcn-vue**     | UI component library (optional integration)      |

---

## 🌿 Available Branches

| Branch         | Description                                       |
|----------------|---------------------------------------------------|
| `main`         | Basic starter kit without i18n                    |

---

## 🚀 Getting Started

### 1. Use as a GitHub Template

- Go to the repository on GitHub
- Click **"Use this template"**
- Name your new project
- Expand **Advanced options** to choose a branch (`main` or `...`)

### 2. Clone and Set Up Locally

```bash
git clone https://github.com/your-username/your-project-name.git
cd your-project-name

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Set environment and key
cp .env.example .env
php artisan key:generate
