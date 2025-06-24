<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Button } from "@/Components/ui/button";
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from "@/Components/ui/card";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Checkbox } from "@/Components/ui/checkbox";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Login" />

    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-muted p-6 md:p-10"
    >
        <div class="flex w-full max-w-sm flex-col gap-6">
            <div class="flex flex-col gap-6">
                <Card>
                    <CardHeader class="text-center">
                        <CardTitle class="text-xl">  Welcome back</CardTitle>
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
                                        <p v-if="form.errors.email" class="text-sm font-medium text-destructive">
                                            {{ form.errors.email  }}
                                        </p>
                                    </div>
                                    <div class="grid gap-2">
                                        <div class="flex items-center">
                                        <Label for="password">Password</Label>
                                        <Link
                                            v-if="canResetPassword"
                                            :href="route('password.request')"
                                            class="ml-auto text-sm underline-offset-2 hover:underline"
                                        >
                                            Forgot your password?
                                        </Link>
                                    </div>
                                    <Input
                                        id="password"
                                        type="password"
                                        v-model="form.password"
                                        required
                                    />
                                        <p v-if="form.errors.password" class="text-sm font-medium text-destructive">
                                            {{ form.errors.password  }}
                                        </p>
                                    </div>

                                    <div class="grid gap-2">
                                    <label class="flex items-center">
                                        <Checkbox
                                            v-model:checked="form.remember"
                                            name="remember"
                                        />
                                        <span class="ms-2 text-sm text-gray-600"
                                            >Remember me</span
                                        >
                                    </label>
                                </div>

                                    <Button type="submit" class="w-full">
                                        Login
                                    </Button>
                                </div>
                                <div class="text-center text-sm">
                                    Don't have an account?
                                    <Link
                                        :href="route('register')"
                                        class="underline underline-offset-4"
                                    >
                                        Sign up
                                    </Link>
                                </div>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </div>
    </div>
</template>
