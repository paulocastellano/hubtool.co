<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import Layout from "@/Layouts/Auth.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Layout max-width="lg">
        <Head title="Log in" />

        <div>
            <div class="mb-6">
                <div class="flex justify-center">
                    <img
                        src="https://changelogfy.com/images/changelogfy/logo-color.png"
                        class="h-14"
                    />
                </div>

                <h1
                    class="mt-10 text-center text-2xl font-medium tracking-tight text-gray-900"
                >
                    Log in to your Hubtool account
                </h1>
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <Label for="email" value="Email" />

                    <Input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="email"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <Label for="password" value="Password" />

                    <Input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <Link
                        :href="route('password.request')"
                        class="text-xs hover:underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Forgot your password?
                    </Link>

                    <Link
                        :href="route('register')"
                        class="text-xs hover:underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Don't have an account? Register Free
                    </Link>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Button
                        class="btn-primary w-full"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </Button>
                </div>
            </form>
        </div>
    </Layout>
</template>
