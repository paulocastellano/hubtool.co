<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        class="w-full px-3 py-2 rounded text-sm focus:outline border-gray-200 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 focus:border-black dark:focus:border-gray-800 focus:ring-black dark:focus:ring-gray-800 dark:hover:bg-gray-900/80"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
