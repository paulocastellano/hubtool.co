<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    category: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="route('categories.show', category.slug)"
        :class="`inline-flex bg-gray-100 text-gray-500 ring-1 ring-inset ring-gray-300 ring-opacity-40 text-xs truncate font-medium px-2 py-1 rounded`"
    >
        {{ category.name }}
    </Link>
</template>
