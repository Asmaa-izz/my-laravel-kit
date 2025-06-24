<script setup>
import { ChevronsUpDown, Plus } from "lucide-vue-next";

import { ref } from "vue";

import {
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    useSidebar,
} from "@/Components/ui/sidebar";

import { Link } from "@inertiajs/vue3";

import { usePage } from '@inertiajs/vue3'
const { appName } = usePage().props;
</script>

<template>
    <SidebarMenu>
        <SidebarMenuItem>
            <Link :href="route('dashboard')">
                <SidebarMenuButton
                    size="lg"
                    class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                >
                    <div
                        class="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground"
                    >
                        <component is="" class="size-4" />
                    </div>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                        <span class="truncate font-semibold">
                            {{ appName }}
                        </span>
                        <span class="truncate text-xs">new</span>
                    </div>
                </SidebarMenuButton>
            </Link>
        </SidebarMenuItem>
    </SidebarMenu>
</template>
