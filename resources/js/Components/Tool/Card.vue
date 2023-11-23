<script setup>
import { Link } from "@inertiajs/vue3";
import { IconStar, IconHeart, IconExternalLink } from "@tabler/icons-vue";
import ToolCategory from "@/Components/Tool/Category.vue";

const { tool } = defineProps({
    tool: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route('tools.show', tool.slug)"
        class="relative isolate flex flex-col gap-8 lg:flex-row items-center hover:bg-gray-200 p-6 rounded-lg cursor-pointer"
    >
        <div class="relative lg:w-24 lg:h-24">
            <img
                :src="tool.photo_url"
                :alt="tool.name"
                class="absolute inset-0 h-full w-full rounded-lg bg-gray-50 object-cover"
            />
            <div
                class="absolute inset-0 rounded-lg ring-1 ring-inset ring-gray-900/10"
            ></div>
        </div>
        <div>
            <div class="relative max-w-xl mb-2">
                <h3 class="text-lg font-semibold leading-6 mb-1 text-gray-900">
                    {{ tool.name }}
                </h3>
                <p class="text-sm leading-6 text-gray-600">
                    {{ tool.brief }}
                </p>
            </div>

            <div class="flex items-center gap-x-4 text-xs">
                <ToolCategory
                    v-for="category in tool.categories"
                    :key="category.id"
                    :category="category"
                />
            </div>
        </div>
    </Link>
</template>
