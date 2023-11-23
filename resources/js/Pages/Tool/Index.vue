<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Master.vue";

const { tools } = defineProps({
    tools: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Your Products" />

    <Layout>
        <div>Your Products</div>

        <div>
            <div v-for="tool in tools" :key="tool.id">
                {{ tool.name }}

                {{ tool.status }}

                <Link :href="route('tools.edit', tool.id)">Edit</Link>
            </div>
        </div>
    </Layout>
</template>
