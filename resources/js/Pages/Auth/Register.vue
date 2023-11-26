<script setup>
import Layout from "@/Layouts/Auth.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    username: "",
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Layout>
        <Head title="Register" />

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
                    Create your Hubtool account
                </h1>
            </div>

            <form @submit.prevent="submit">
                <div>
                    <Label for="name" value="Name" />

                    <Input
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <Label for="username" value="Username" />

                    <Input
                        id="username"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.username"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.username" />
                </div>

                <div class="mt-4">
                    <Label for="email" value="Email" />

                    <Input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
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
                    <Link
                        :href="route('login')"
                        class="text-xs hover:underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Button
                        :class="{
                            'btn-primary w-full': true,
                            'opacity-25': form.processing,
                        }"
                        :disabled="form.processing"
                    >
                        Register
                    </Button>
                </div>
            </form>
        </div>
    </Layout>
</template>
