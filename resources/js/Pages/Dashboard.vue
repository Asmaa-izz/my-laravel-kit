<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import useAuth from '@/Composables/useAuth';

const { can, hasRole } = useAuth()
</script>

<template>
    <AppLayout title="Dashboard">
        <div>
            <button v-if="can('edit posts')">تعديل المنشور</button>
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
