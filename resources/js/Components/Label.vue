<script setup>
import { IconInfoCircle } from "@tabler/icons-vue";
defineProps(["value", "required", "tooltip"]);
</script>

<template>
    <label class="label">
        <span>{{ value }}</span>
        <span v-if="required" class="text-red-500 ml-0.5">*</span>
        <IconInfoCircle
            v-if="tooltip"
            class="h-4 w-4 ml-1"
            v-tooltip="{
                content: tooltip,
            }"
        />
    </label>
</template>
