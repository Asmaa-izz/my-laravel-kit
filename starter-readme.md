# 🚀 Laravel Starter Kit (Jetstream + Inertia + Vue 3 + TailwindCSS 4 + shadcn-vue)

نقطة انطلاق جاهزة لبناء مشاريع Laravel حديثة بواجهة قوية باستخدام Inertia.js و Vue 3 وتصميم عصري بمساعدة shadcn-vue.

---

## ✅ يتضمن:

- Laravel 12
- Jetstream (Inertia Stack)
- Vue 3
- TailwindCSS v4
- shadcn-vue (UI Kit)
- Auth + API Tokens جاهزة
- إعدادات Vite و npm كاملة

---

## 📦 خطوات التشغيل لأول مرة:

```bash
git clone <رابط الريبو> my-project
cd my-project

# إعداد باك إند Laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

# إعداد الفرونت إند
npm install
npm run dev

# تشغيل السيرفر المحلي
php artisan serve
