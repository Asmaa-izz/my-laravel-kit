<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { Button } from '@/Components/ui/button'

const props = defineProps({
  auth: Object
})
</script>

<template>
  <Head title="Home" />

  <main class="min-h-screen bg-background text-foreground flex flex-col">
    <!-- Navigation -->
    <nav class="w-full py-4 px-6 flex items-center justify-between border-b border-border">
      <h1 class="text-xl font-bold">🌟 MyPlatform</h1>

      <div v-if="!auth?.user" class="flex gap-3">
        <Button as="a" href="/login" variant="outline">Login</Button>
        <Button as="a" href="/register">Sign up</Button>
      </div>
      <div v-else>
        <Button as="a" href="/dashboard">Dashboard</Button>
        <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="hover:underline"
        >
            Logout
        </Link>
      </div>
    </nav>

    <!-- Hero section -->
    <section class="flex-1 flex flex-col items-center justify-center text-center px-4">
      <h2 class="text-4xl font-bold mb-4">Welcome to MyPlatform</h2>
      <p class="text-muted-foreground text-lg max-w-xl mb-6">
        Your all-in-one solution for managing your projects, connecting with your team, and growing your business.
      </p>

      <div v-if="!auth?.user" class="flex gap-4">
        <Button as="a" href="/register">Get Started</Button>
        <Button as="a" href="/login" variant="outline">I already have an account</Button>
      </div>
      <div v-else>
        <Button as="a" href="/dashboard">Go to Dashboard</Button>
      </div>
    </section>
  </main>
</template>
