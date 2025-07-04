<script setup>
import { ref, computed } from 'vue'
import { useI18n } from 'vue-i18n'
import { usePage } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { Globe } from 'lucide-vue-next'

const { t, locale } = useI18n()
const page = usePage()

const currentLocale = computed(() => page.props.locale?.current || 'en')
const supportedLocales = computed(() => page.props.locale?.supported || {})
const direction = computed(() => page.props.locale?.direction || 'ltr')

const switchLanguage = async (newLocale) => {
    try {
        // Get CSRF token from meta tag or use a default approach
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                         document.querySelector('meta[name="_token"]')?.getAttribute('content') ||
                         ''

        const response = await fetch('/locale/switch', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ locale: newLocale })
        })

        if (response.ok) {
            // Reload the page to apply the new locale
            window.location.reload()
        } else {
            console.error('Failed to switch language:', response.statusText)
        }
    } catch (error) {
        console.error('Error switching language:', error)
    }
}
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="outline" size="sm" class="gap-2">
                <Globe class="h-4 w-4" />
                {{ supportedLocales[currentLocale]?.flag || '🌐' }}
                {{ supportedLocales[currentLocale]?.name || currentLocale.toUpperCase() }}
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end" class="w-48">
            <DropdownMenuItem
                v-for="(localeInfo, localeCode) in supportedLocales"
                :key="localeCode"
                @click="switchLanguage(localeCode)"
                :class="{ 'bg-accent': localeCode === currentLocale }"
            >
                <span class="mr-2">{{ localeInfo.flag }}</span>
                <span>{{ localeInfo.native_name }}</span>
                <span v-if="localeCode === currentLocale" class="ml-auto text-xs text-muted-foreground">
                    ✓
                </span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
