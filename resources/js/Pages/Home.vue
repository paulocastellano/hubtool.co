<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import helper from "@/helper";
import Layout from "@/Layouts/Master.vue";
import ToolCard from "@/Components/Tool/Card.vue";

const cache = usePage().props.cache;

const { tools } = defineProps({
    tools: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Home" />

    <Layout>
        <div class="grid grid-cols-1 sm:grid-cols-10 gap-8">
            <div class="col-span-6 p-6 order-2 sm:order-1">
                <div class="flex flex-col space-y-4 relative mt-8">
                    <div v-for="(all, day) in tools" :key="day">
                        <div class="mb-4 text-lg font-semibold">
                            {{ helper.formatDate(day) }}
                        </div>
                        <div class="space-y-1">
                            <div v-for="tool in all" :key="tool.id">
                                <ToolCard :tool="tool" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="col-span-4 border-l border-gray-100 order-1 sm:order-2 overflow-none"
            >
                <div
                    class="grid grid-cols-1 lg:grid-cols-2 gap-4 px-4 sticky top-20"
                >
                    <Link
                        v-for="featured_category in cache.featured_categories"
                        :key="featured_category.id"
                        :href="route('categories.show', featured_category.slug)"
                        class="p-4 bg-gray-100 rounded flex items-center space-x-2"
                    >
                        <div>{{ featured_category.icon }}</div>
                        <div>{{ featured_category.name }}</div>
                    </Link>
                </div>
            </div>
        </div>
    </Layout>
</template>
