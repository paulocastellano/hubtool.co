<template>
    <div class="flex flex-1 items-center justify-end">
        <Menu as="div" class="ml-auto relative inline-block text-left">
            <div>
                <MenuButton
                    class="inline-flex w-full justify-center gap-x-1.5 px-3 py-1 text-sm font-semibold text-gray-400 hover:text-gray-800"
                >
                    <IconShare class="h-5 w-5" aria-hidden="true" />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
            >
                <MenuItems
                    class="absolute right-0 z-10 w-64 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="py-1">
                        <MenuItem v-slot="{ active }">
                            <a
                                target="_blank"
                                :href="`https://www.facebook.com/sharer/sharer.php?t=${
                                    tool.name
                                }&u=${route('tools.show', tool.slug)}`"
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'px-4 py-2 flex items-center space-x-2 group',
                                ]"
                            >
                                <IconBrandFacebook
                                    class="h-5 w-5 text-gray-300 group-hover:text-gray-800"
                                />
                                <div
                                    class="font-medium text-sm text-gray-600 group-hover:text-gray-800"
                                >
                                    Share on Facebook
                                </div>
                            </a>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <a
                                target="_blank"
                                :href="`https://twitter.com/intent/tweet?text=${
                                    tool.name
                                }&url=${route('tools.show', tool.slug)}`"
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'px-4 py-2 flex items-center space-x-2 group',
                                ]"
                            >
                                <IconBrandTwitter
                                    class="h-5 w-5 text-gray-300 group-hover:text-gray-800"
                                />
                                <div
                                    class="font-medium text-sm text-gray-600 group-hover:text-gray-800"
                                >
                                    Share on Twitter
                                </div>
                            </a>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <a
                                target="_blank"
                                :href="`https://www.linkedin.com/sharing/share-offsite/?url=${route(
                                    'tools.show',
                                    tool.slug
                                )}`"
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'px-4 py-2 flex items-center space-x-2 group',
                                ]"
                            >
                                <IconBrandLinkedin
                                    class="h-5 w-5 text-gray-300 group-hover:text-gray-800"
                                />
                                <div
                                    class="font-medium text-sm text-gray-600 group-hover:text-gray-800"
                                >
                                    Share on LinkedIn
                                </div>
                            </a>
                        </MenuItem>

                        <MenuItem v-slot="{ active }">
                            <a
                                target="_blank"
                                :href="`https://api.whatsapp.com/send?text=${route(
                                    'tools.show',
                                    tool.slug
                                )}`"
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'px-4 py-2 flex items-center space-x-2 group',
                                ]"
                            >
                                <IconBrandWhatsapp
                                    class="h-5 w-5 text-gray-300 group-hover:text-gray-800"
                                />
                                <div
                                    class="font-medium text-sm text-gray-600 group-hover:text-gray-800"
                                >
                                    Share on WhatsApp
                                </div>
                            </a>
                        </MenuItem>

                        <MenuItem v-slot="{ active }">
                            <a
                                :href="route('tools.show', tool.slug)"
                                @click.prevent="
                                    helper.copyToClipboard(
                                        route('tools.show', tool.slug)
                                    )
                                "
                                :class="[
                                    active
                                        ? 'bg-gray-100 text-gray-900'
                                        : 'text-gray-700',
                                    'px-4 py-2 flex items-center space-x-2 group',
                                ]"
                            >
                                <IconLink
                                    class="h-5 w-5 text-gray-300 group-hover:text-gray-800"
                                />
                                <div
                                    class="font-medium text-sm text-gray-600 group-hover:text-gray-800"
                                >
                                    Click to copy the link
                                </div>
                            </a>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import {
    IconBrandFacebook,
    IconBrandTwitter,
    IconBrandLinkedin,
    IconBrandWhatsapp,
    IconLink,
    IconShare,
} from "@tabler/icons-vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

import helper from "@/helper";

const { tool } = defineProps({
    tool: {
        type: Object,
        required: true,
    },
});
</script>
