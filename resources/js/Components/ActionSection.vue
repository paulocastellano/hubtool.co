<script setup>
import SectionTitle from "./SectionTitle.vue";
</script>

<template>
    <div>
        <SectionTitle v-if="$slots.title || $slots.description">
            <template #title>
                <div class="text-black dark:text-white">
                    <slot name="title" />
                </div>
            </template>
            <template #description>
                <div
                    class="text-sm font-light text-gray-400 dark:text-gray-400"
                >
                    <slot name="description" />
                </div>
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="pt-4 text-black dark:text-gray-300 text-sm">
                <slot name="content" />
            </div>
        </div>

        <div v-if="$slots.action" class="mt-5">
            <slot name="action" />
        </div>
    </div>
</template>
