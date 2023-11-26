<script setup>
import Layout from "@/Layouts/Auth.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Layout>
        <Head title="Forgot Password" />

        <div>
            <div class="mb-6">
                <div class="flex justify-center">
                    <img
                        src="https://changelogfy.com/images/changelogfy/logo-color.png"
                        class="h-14"
                    />
                </div>

                <h1
                    class="mt-10 text-center text-2xl font-medium leading-9 tracking-tight text-gray-900"
                >
                    Forgot your password?
                </h1>
            </div>

            <div class="mb-4 text-sm text-gray-600">
                Don't worry. Just let us know your email address and we will
                email you a password reset link that will allow you to choose a
                new one.
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
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Button
                        :class="{
                            'btn-primary w-full': true,
                            'opacity-25': form.processing,
                        }"
                        :disabled="form.processing"
                    >
                        Email Password Reset Link
                    </Button>
                </div>
            </form>
        </div>
    </Layout>
</template>
