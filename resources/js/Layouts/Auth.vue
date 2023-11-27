<template>
    <Header />

    <main
        class="flex min-h-full flex-1 flex-col justify-center px-6 lg:py-12 lg:px-8"
    >
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <slot />
        </div>
    </main>
    <Banner />
</template>

<script setup>
import Header from "./Header.vue";
import Banner from "@/Components/Banner.vue";

import { computed } from "vue";
</script>
