<script setup>
import { computed } from "vue";
import Header from "./Header.vue";

import Banner from "@/Components/Banner.vue";

const props = defineProps({
    maxWidth: {
        type: String,
        default: "5xl",
    },
});

const maxWidthClass = computed(() => {
    return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
        "3xl": "sm:max-w-3xl",
        "4xl": "sm:max-w-4xl",
        "5xl": "sm:max-w-5xl",
        "6xl": "sm:max-w-6xl",
        "7xl": "sm:max-w-7xl",
    }[props.maxWidth];
});
</script>

<template>
    <Header />

    <main class="mx-auto sm:p-6 lg:p-8 mt-[72px]" :class="maxWidthClass">
        <div
            v-if="$slots.header"
            class="border-b border-gray-100 dark:border-gray-700 px-4 pt-4 sm:pt-0 pb-4 sm:px-0 sm:pb-8 mb-4 sm:mb-8"
        >
            <slot name="header"></slot>
        </div>
        <slot />
    </main>
    <Banner />
</template>
