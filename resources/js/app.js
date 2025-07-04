import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createI18n } from 'vue-i18n'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Create i18n instance
        const i18n = createI18n({
            legacy: false,
            locale: props.initialPage.props.locale?.current || 'en',
            fallbackLocale: 'en',
            messages: {
                en: {
                    app: {
                        welcome: 'Welcome',
                        login: 'Login',
                        logout: 'Logout',
                        register: 'Register',
                        dashboard: 'Dashboard',
                        profile: 'Profile',
                        save: 'Save',
                        cancel: 'Cancel',
                        edit: 'Edit',
                        delete: 'Delete',
                        language: 'Language',
                        settings: 'Settings',
                        search: 'Search',
                        not_found: 'Not Found',
                        submit: 'Submit',
                        update: 'Update',
                        create: 'Create',
                        actions: 'Actions',
                        confirm: 'Confirm',
                        yes: 'Yes',
                        no: 'No'
                    }
                },
                ar: {
                    app: {
                        welcome: 'مرحباً',
                        login: 'تسجيل الدخول',
                        logout: 'تسجيل الخروج',
                        register: 'التسجيل',
                        dashboard: 'لوحة التحكم',
                        profile: 'الملف الشخصي',
                        save: 'حفظ',
                        cancel: 'إلغاء',
                        edit: 'تعديل',
                        delete: 'حذف',
                        language: 'اللغة',
                        settings: 'الإعدادات',
                        search: 'بحث',
                        not_found: 'غير موجود',
                        submit: 'إرسال',
                        update: 'تحديث',
                        create: 'إنشاء',
                        actions: 'الإجراءات',
                        confirm: 'تأكيد',
                        yes: 'نعم',
                        no: 'لا'
                    }
                }
            }
        });

        return app
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
