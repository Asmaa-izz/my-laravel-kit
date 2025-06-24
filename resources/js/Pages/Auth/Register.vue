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

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />

    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-muted p-6 md:p-10"
    >
        <div class="flex w-full max-w-sm flex-col gap-6">
            <div class="flex flex-col gap-6">
                <Card>
                    <CardHeader class="text-center">
                        <CardTitle class="text-xl"> Let’s get you started</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <form @submit.prevent="submit">
                            <div class="grid gap-6">
                                <div class="grid gap-6">
                                    <div class="grid gap-2">
                                        <Label html-for="name">Name</Label>
                                        <Input
                                            id="name"
                                            type="text"
                                            placeholder="example"
                                            v-model="form.name"
                                            required
                                        />
                                        <p v-if="form.errors.name" class="text-sm font-medium text-destructive">
                                            {{ form.errors.name  }}
                                        </p>
                                    </div>
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
                                        <Label html-for="password"
                                            >Password</Label
                                        >
                                        <Input
                                            id="password"
                                            type="password"
                                            required
                                            v-model="form.password"
                                        />
                                        <p v-if="form.errors.password" class="text-sm font-medium text-destructive">
                                            {{ form.errors.password  }}
                                        </p>
                                    </div>
                                    <div class="grid gap-2">
                                        <Label html-for="password_confirmation"
                                            >Confirm Password</Label
                                        >
                                        <Input
                                            id="password_confirmation"
                                            type="password"
                                            required
                                            v-model="form.password_confirmation"
                                        />
                                        <p v-if="form.errors.password_confirmation" class="text-sm font-medium text-destructive">
                                            {{ form.errors.password_confirmation  }}
                                        </p>
                                    </div>
                                    <Button type="submit" class="w-full">
                                        Register
                                    </Button>
                                </div>
                                <div class="text-center text-sm">
                                    Already registered?
                                    <Link
                                         :href="route('login')"
                                        class="underline underline-offset-4"
                                    >
                                    Login
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
