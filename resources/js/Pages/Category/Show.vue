<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Layout from "@/Layouts/Master.vue";
import ToolCard from "@/Components/Tool/Card.vue";

const { category, tools } = defineProps({
    category: {
        type: Object,
        required: true,
    },

    tools: {
        type: Object,
        required: true,
    },
});

console.log(tools);
</script>

<template>
    <Layout>
        <div>{{ category.name }}</div>

        <div class="flex flex-col space-y-4 relative mt-8">
            <div v-for="tool in tools" :key="tool.id">
                <ToolCard :tool="tool" />
            </div>
        </div>
    </Layout>
</template>
