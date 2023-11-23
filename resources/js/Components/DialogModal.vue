<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },

    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    if (props.closeable) {
        emit("close");
    }
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        @close="close"
        :closeable="closeable"
    >
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                <slot name="title" />
            </div>

            <div
                v-if="$slots.description"
                class="text-sm font-normal text-gray-500 dark:text-gray-100 mt-1"
            >
                <slot name="description" />
            </div>

            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <slot name="content" />
            </div>
        </div>

        <div
            v-if="$slots.footer"
            class="flex flex-row items-center space-x-2 justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 border-t border-gray-100 dark:border-gray-800 text-right"
        >
            <slot name="footer" />
        </div>
    </Modal>
</template>
