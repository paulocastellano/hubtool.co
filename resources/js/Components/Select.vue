<template>
    <select
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        class="w-full px-3 py-2 rounded focus:outline text-sm border-gray-200 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 focus:border-black dark:focus:border-gray-800 focus:ring-black dark:focus:ring-gray-800 dark:hover:bg-gray-900/80"
    >
        <option v-if="placeholder" :value="''">
            {{ placeholder ? placeholder : "Select..." }}
        </option>
        <option v-for="(value, index) in values" :key="index" :value="index">
            {{ value }}
        </option>
    </select>
</template>

<script>
export default {
    props: {
        values: {
            type: Object,
            required: true,
        },
        modelValue: {
            required: true,
        },
        placeholder: {
            type: String,
            required: false,
            default: "",
        },
    },

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
