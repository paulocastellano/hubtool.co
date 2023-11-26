<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Layout from "@/Layouts/Master.vue";
import ToolCard from "@/Components/Tool/Card.vue";

const { tools } = defineProps({
    tools: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Your Tools" />

    <Layout max-width="2xl">
        <div>Your Tools</div>

        <div>
            <!-- <div v-for="tool in tools" :key="tool.id">
                {{ tool.name }}

                {{ tool.status }}

                <Link :href="route('tools.edit', tool.id)">Edit</Link>
            </div> -->
            <div class="space-y-4">
                <div v-for="tool in tools" :key="tool.id">
                    <div
                        class="relative isolate flex flex-col gap-8 lg:flex-row items-center hover:bg-gray-50 px-6 py-4 rounded"
                    >
                        <div class=" ">
                            <img
                                :src="tool.photo_url"
                                :alt="tool.name"
                                class="w-14 h-14 rounded"
                            />
                        </div>
                        <div>
                            <div class="relative max-w-xl mb-2">
                                <h3 class="text-sm font-semibold text-gray-900">
                                    {{ tool.name }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ tool.headline }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div>{{ tool.status }}</div>
                            <div>{{ tool.days_to_review }}</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a :href="route('billing.skip-line', tool.id)"
                                >Skip the line</a
                            >
                            <div>Edit</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
