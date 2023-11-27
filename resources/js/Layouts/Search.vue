<script setup>
import { computed, ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import hotkeys from "hotkeys-js";
import debounce from "@/debounce";

import { IconBell, IconSearch } from "@tabler/icons-vue";

import {
    Combobox,
    ComboboxInput,
    ComboboxOptions,
    ComboboxOption,
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

const show = ref(false);
const query = ref("");
const tools = ref([]);

const search = debounce(() => {
    axios
        .get(route("tools.search", { q: query.value }))
        .then((data) => {
            tools.value = data.data;
        })
        .catch((error) => {
            console.log(error);
        });
}, 500);

function onSelect(item) {
    router.visit(route("tools.show", item.slug));
}
const open = () => {
    show.value = true;
};

const close = () => {
    show.value = false;
};

defineExpose({ open, close });

const startShortcuts = () => {
    hotkeys("ctrl+k,command+k", (event, handler) => {
        event.preventDefault();
        switch (handler.key) {
            case "ctrl+k":
                open();
                break;
            case "command+k":
                open();
                break;
        }
    });
};

onMounted(() => {
    startShortcuts();
});
</script>

<template>
    <TransitionRoot :show="show" as="template" @after-leave="query = ''" appear>
        <Dialog as="div" class="relative z-10" @close="show = false">
            <TransitionChild
                as="template"
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div
                    class="fixed inset-0 bg-black bg-opacity-60 transition-opacity"
                />
            </TransitionChild>

            <div
                class="fixed inset-0 z-10 w-screen overflow-y-auto p-4 sm:p-6 md:p-20"
            >
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0 scale-95"
                    enter-to="opacity-100 scale-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100 scale-100"
                    leave-to="opacity-0 scale-95"
                >
                    <DialogPanel
                        class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all"
                    >
                        <Combobox @update:modelValue="onSelect">
                            <div class="relative">
                                <IconSearch
                                    class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400"
                                    aria-hidden="true"
                                />
                                <ComboboxInput
                                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                                    placeholder="Search..."
                                    @change="query = $event.target.value"
                                    @keyup="search"
                                />
                            </div>

                            <ComboboxOptions
                                v-if="tools.length > 0"
                                static
                                class="max-h-96 transform-gpu scroll-py-3 overflow-y-auto p-3"
                            >
                                <ComboboxOption
                                    v-for="tool in tools"
                                    :key="tool.id"
                                    :value="tool"
                                    as="template"
                                    v-slot="{ active }"
                                >
                                    <li
                                        :class="[
                                            'flex select-none rounded p-3  cursor-pointer',
                                            active && 'bg-gray-100',
                                        ]"
                                    >
                                        <img
                                            class="flex h-10 w-10 flex-none items-center justify-center rounded"
                                            :src="tool.photo_url"
                                        />
                                        <div class="ml-4 flex-auto">
                                            <p
                                                :class="[
                                                    'text-sm font-medium',
                                                    active
                                                        ? 'text-gray-900'
                                                        : 'text-gray-700',
                                                ]"
                                            >
                                                {{ tool.name }}
                                            </p>
                                            <p
                                                :class="[
                                                    'text-sm',
                                                    active
                                                        ? 'text-gray-700'
                                                        : 'text-gray-500',
                                                ]"
                                            >
                                                {{ tool.headline }}
                                            </p>
                                        </div>
                                    </li>
                                </ComboboxOption>
                            </ComboboxOptions>

                            <div
                                v-if="query !== '' && tools.length === 0"
                                class="px-6 py-14 text-center text-sm sm:px-14"
                            >
                                <IconBell
                                    type="outline"
                                    name="exclamation-circle"
                                    class="mx-auto h-6 w-6 text-gray-400"
                                />
                                <p class="mt-4 font-semibold text-gray-900">
                                    No results found
                                </p>
                                <p class="mt-2 text-gray-500">
                                    No tools found for this search term. Please
                                    try again.
                                </p>
                            </div>
                        </Combobox>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>
