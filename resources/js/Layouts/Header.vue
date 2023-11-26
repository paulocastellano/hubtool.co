<script setup>
import { ref } from "vue";
import { usePage, Link } from "@inertiajs/vue3";

import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";

import {
    IconX,
    IconSearch,
    IconMenu,
    IconChevronDown,
} from "@tabler/icons-vue";

import Search from "./Search.vue";
import Input from "@/Components/Input.vue";

const search = ref(null);
const cache = usePage().props.cache;
const user = usePage().props.auth.user;

const mobileMenuOpen = ref(false);

const navigation = [
    {
        name: "Home",
        href: route("home"),
        current: route().current("home"),
    },

    {
        name: "Explore",
        href: "#",
        items: cache.featured_categories.map((category) => ({
            name: category.name,
            href: route("categories.show", category.slug),
        })),
    },
];

const userNavigation = [
    { name: "Your Profile", href: route("account.edit") },
    { name: "Your Tools", href: route("tools.index") },
];
</script>

<template>
    <header
        class="fixed w-full top-0 bg-white sm:border-b border-gray-100 z-10"
    >
        <nav
            class="mx-auto flex max-w-full items-center justify-between gap-x-6 py-4 px-6 lg:px-8"
        >
            <div class="flex lg:flex-1 space-x-8">
                <Link :href="route('home')" class="-m-1.5 p-1.5">
                    <span class="sr-only">Hubtool.co</span>
                    <img
                        class="h-8 w-auto"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                        alt=""
                    />
                </Link>

                <div class="hidden lg:flex items-center lg:gap-x-8">
                    <div class="relative flex-1">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center"
                        >
                            <IconSearch class="h-5 w-5 text-gray-400" />
                        </div>
                        <Input
                            class="w-full pl-10"
                            autocomplete="off"
                            type="text"
                            placeholder="Search..."
                        />
                        <div
                            class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5"
                        >
                            <kbd class="kbd-search">⌘K</kbd>
                        </div>

                        <div
                            class="absolute inset-0 z-10 bg-transparent cursor-pointer"
                            @click="search.open()"
                        ></div>
                    </div>

                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="text-sm font-semibold text-gray-900"
                    >
                        <div v-if="!item.items">
                            {{ item.name }}
                        </div>

                        <Popover class="relative" v-else>
                            <PopoverButton
                                class="inline-flex items-center gap-x-1 text-sm font-semibold text-gray-900 outline-none"
                            >
                                <span>Explore</span>
                                <IconChevronDown
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </PopoverButton>

                            <transition
                                enter-active-class="transition ease-out duration-200"
                                enter-from-class="opacity-0 translate-y-1"
                                enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="opacity-100 translate-y-0"
                                leave-to-class="opacity-0 translate-y-1"
                            >
                                <PopoverPanel
                                    class="absolute left-1/2 z-10 mt-5 flex w-screen max-w-min -translate-x-1/2 px-4"
                                >
                                    <div
                                        class="w-56 shrink rounded-xl bg-white p-4 text-sm font-semibold text-gray-900 shadow-lg ring-1 ring-gray-900/5"
                                    >
                                        <Link
                                            v-for="item in item.items"
                                            :key="item.name"
                                            :href="item.href"
                                            class="block p-2 hover:text-indigo-600"
                                        >
                                            {{ item.name }}
                                        </Link>
                                    </div>
                                </PopoverPanel>
                            </transition>
                        </Popover>
                    </Link>
                </div>
            </div>
            <div class="flex flex-1 items-center justify-end gap-x-6">
                <Link
                    :href="route('tools.create')"
                    class="hidden lg:text-sm lg:font-semibold lg: lg:text-orange-600 lg:flex items-center space-x-1"
                >
                    <div>Add your tool</div>
                </Link>

                <div v-if="user" class="flex items-center">
                    <Menu as="div" class="relative ml-3">
                        <div>
                            <MenuButton
                                class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                <span class="absolute -inset-1.5" />
                                <span class="sr-only">Open user menu</span>
                                <img
                                    class="h-8 w-8 rounded-full"
                                    :src="user.photo_url"
                                    :alt="user.name"
                                />
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
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <MenuItem
                                    v-for="item in userNavigation"
                                    :key="item.name"
                                    v-slot="{ active }"
                                >
                                    <Link
                                        :href="item.href"
                                        :class="[
                                            active ? 'bg-gray-100' : '',
                                            'block px-4 py-2 text-sm text-gray-700',
                                        ]"
                                        >{{ item.name }}</Link
                                    >
                                </MenuItem>

                                <MenuItem v-slot="{ active }">
                                    <Link
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                        type="button"
                                        :class="[
                                            active ? 'bg-gray-100' : '',
                                            'block text-left px-4 py-2 text-sm text-gray-700 w-full',
                                        ]"
                                    >
                                        <div>Sign Out</div>
                                    </Link>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>

                <template v-else class="flex items-center space-x-1">
                    <Link
                        :href="route('login')"
                        class="hidden lg:block lg:text-sm lg:font-semibold lg: lg:text-gray-900"
                        >Log in</Link
                    >
                    <Link
                        :href="route('register')"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Sign up
                    </Link>
                </template>
            </div>
            <div class="flex lg:hidden">
                <button
                    type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    @click="mobileMenuOpen = true"
                >
                    <span class="sr-only">Open main menu</span>
                    <IconMenu class="h-6 w-6" aria-hidden="true" />
                </button>
            </div>
        </nav>
        <Dialog
            as="div"
            class="lg:hidden"
            @close="mobileMenuOpen = false"
            :open="mobileMenuOpen"
        >
            <div class="fixed inset-0 z-10" />
            <DialogPanel
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-4 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
            >
                <div class="flex items-center gap-x-6">
                    <Link :href="route('home')" class="-m-1.5 p-1.5">
                        <span class="sr-only">Hubtool.co</span>
                        <img
                            class="h-8 w-auto"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                            alt=""
                        />
                    </Link>
                    <Link
                        :href="route('register')"
                        class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    >
                        Sign up
                    </Link>
                    <button
                        type="button"
                        class="-m-2.5 rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = false"
                    >
                        <span class="sr-only">Close menu</span>
                        <IconX class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <Link
                                v-for="item in navigation"
                                :key="item.name"
                                :href="item.href"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50"
                            >
                                {{ item.name }}
                            </Link>
                        </div>
                        <div class="py-6">
                            <Link
                                :href="route('login')"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50"
                            >
                                Log in
                            </Link>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>

    <Search ref="search" />
</template>
