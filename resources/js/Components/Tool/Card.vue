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
        class="relative isolate flex flex-col gap-8 lg:flex-row items-center hover:bg-gray-50 px-6 py-4 rounded-lg cursor-pointer"
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
    </Link>
</template>
