<script setup>
import { ref, computed } from "vue";
import { useForm, usePage, Head } from "@inertiajs/vue3";

import Layout from "@/Layouts/Master.vue";
import Form from "./Partial/Form.vue";

const { tool } = defineProps({
    tool: {
        type: Object,
        required: true,
    },
});

// create form  but remove photo
const form = useForm({
    ...tool,
    photo: null,
});

const update = () => {
    form.post(route("tools.update", tool.id), {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>

<template>
    <Layout max-width="3xl">
        <Head title="Project Settings" />

        <template #header>
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="page-title">Edit your tool</h1>
                </div>
            </div>
        </template>

        <Form :form="form" @form:submitted="update" />
    </Layout>
</template>
