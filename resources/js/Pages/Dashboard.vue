<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import useAuth from '@/composables/useAuth';
import { useI18n } from 'vue-i18n'

const { can, hasRole } = useAuth()
const { t } = useI18n()
</script>

<template>
    <AppLayout :title="t('app.dashboard')">
        <div>
            <button v-if="can('edit posts')">{{ t('app.edit') }} المنشور</button>
            <button v-if="hasRole('admin')">زر خاص للمشرفين</button>
        </div>

        <!-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
          <div class="aspect-video rounded-xl bg-muted/50" />
          <div class="aspect-video rounded-xl bg-muted/50" />
          <div class="aspect-video rounded-xl bg-muted/50" />
        </div>
        <div class="min-h-[100vh] flex-1 rounded-xl bg-muted/50 md:min-h-min" /> -->
    </AppLayout>
</template>
