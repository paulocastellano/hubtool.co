<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Master.vue";
import ToolCard from "@/Components/Tool/Card.vue";

const { tools, featuredCategories } = defineProps({
    tools: {
        type: Object,
        required: true,
    },

    featuredCategories: {
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
                <div class="mb-4">
                    <h2 class="max-w-sm text-2xl font-semibold">
                        Featured Tools
                    </h2>
                </div>

                <div class="flex flex-col space-y-4 relative mt-8">
                    <div v-for="(all, day) in tools" :key="day">
                        <div class="mb-4">{{ day }}</div>
                        <div v-for="tool in all" :key="tool.id">
                            <ToolCard :tool="tool" />
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
                        v-for="featuredCategory in featuredCategories"
                        :key="featuredCategory.id"
                        :href="route('categories.show', featuredCategory.slug)"
                        class="p-4 bg-gray-100 rounded flex items-center space-x-2"
                    >
                        <div>{{ featuredCategory.icon }}</div>
                        <div>{{ featuredCategory.name }}</div>
                    </Link>
                </div>
            </div>
        </div>
    </Layout>
</template>
