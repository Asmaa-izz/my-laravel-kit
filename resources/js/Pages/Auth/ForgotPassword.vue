<script setup>
import { Head, useForm } from "@inertiajs/vue3";

import { Button } from "@/Components/ui/button";
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
    CardDescription,
} from "@/Components/ui/card";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="Forgot Password" />

    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-muted p-6 md:p-10"
    >
        <div class="flex w-full max-w-sm flex-col gap-6">
            <div class="flex flex-col gap-6">
                <Card>
                    <CardHeader class="text-center">
                        <CardTitle class="text-xl"> Welcome back</CardTitle>
                        <CardDescription>
                        Forgot your password? No problem. Just let us know your
                        email address and we will email you a password reset
                        link that will allow you to choose a new one.
                    </CardDescription>
                    </CardHeader>

                    <CardContent>
                        <form @submit.prevent="submit">
                            <div class="grid gap-6">
                                <div class="grid gap-6">
                                    <div class="grid gap-2">
                                        <Label html-for="email">Email</Label>
                                        <Input
                                            id="email"
                                            type="email"
                                            placeholder="m@example.com"
                                            required
                                            v-model="form.email"
                                        />
                                        <p
                                            v-if="form.errors.email"
                                            class="text-sm font-medium text-destructive"
                                        >
                                            {{ form.errors.email }}
                                        </p>
                                    </div>
                                    <Button type="submit" class="w-full">
                                        Email Password Reset Link
                                    </Button>
                                </div>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</template>
