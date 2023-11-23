<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Master.vue";
const { categories } = defineProps({
    categories: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Layout>
        <div>Categories index</div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <Link
                v-for="category in categories"
                :key="category.id"
                :href="route('categories.show', category.slug)"
            >
                <div class="flex items-center space-x-2">
                    <div>{{ category.icon }}</div>
                    <div>{{ category.name }}</div>
                </div>
            </Link>
        </div>
    </Layout>
</template>
