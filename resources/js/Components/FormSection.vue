<script setup>
import { computed, useSlots } from "vue";
import SectionTitle from "./SectionTitle.vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="">
        <form @submit.prevent="$emit('submitted')">
            <div>
                <SectionTitle
                    v-if="
                        $slots.title ||
                        $slots.description ||
                        $slots.titleActions
                    "
                >
                    <template #title>
                        <slot name="title" />
                    </template>
                    <template #titleActions>
                        <slot name="titleActions" />
                    </template>
                    <template #description>
                        <slot name="description" />
                    </template>
                </SectionTitle>
                <div
                    :class="{
                        'grid grid-cols-6 gap-x-6 gap-y-4': true,
                        'pt-4':
                            $slots.title ||
                            $slots.description ||
                            $slots.titleActions,
                    }"
                >
                    <slot name="form" />

                    <div
                        v-if="hasActions"
                        class="col-span-6 flex items-center justify-end space-x-2"
                    >
                        <slot name="actions" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
