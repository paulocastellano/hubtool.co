<template>
    <Header />

    <main class="mx-auto sm:p-6 lg:p-8" :class="maxWidthClass">
        <slot />
    </main>
    <Footer />
    <Banner />
</template>

<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
import Banner from "@/Components/Banner.vue";

import { computed } from "vue";

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
