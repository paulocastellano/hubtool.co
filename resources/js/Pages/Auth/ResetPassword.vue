<script setup>
import Layout from "@/Layouts/Auth.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Layout>
        <Head title="Reset Password" />

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
                New Password
            </h1>
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
                    readonly
                    autocomplete="off"
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
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <Label for="password_confirmation" value="Confirm Password" />

                <Input
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button
                    :class="{
                        'btn-primary w-full': true,
                        'opacity-25': form.processing,
                    }"
                    :disabled="form.processing"
                >
                    Reset Password
                </Button>
            </div>
        </form>
    </Layout>
</template>
