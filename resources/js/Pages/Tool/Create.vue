<script setup>
import { ref, computed } from "vue";
import { useForm, usePage, Head } from "@inertiajs/vue3";

import Layout from "@/Layouts/Master.vue";

import Form from "./Partial/Form.vue";

const form = useForm({
    photo: "",
    name: "",
    website: "",
    headline: "",
    description: "",
    pricing: "",

    twitter: "",
    facebook: "",
    instagram: "",
    youtube: "",
    linkedin: "",
    github: "",
    support_email: "",

    apple_store_url: "",
    google_play_url: "",
});

const store = () => {
    form.post(route("tools.store"), {
        preserveScroll: true,
        preserveState: true,
        // onSuccess: () => clearPhotoFileInput(),
    });
};
</script>

<template>
    <Layout max-width="3xl">
        <Head title="Project Settings" />

        <template #header>
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="page-title">Submit a new tool</h1>
                </div>
            </div>
        </template>

        <Form :form="form" @form:submitted="store" />
    </Layout>
</template>
