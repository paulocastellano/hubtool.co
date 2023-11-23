<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import Search from "./Search.vue";
import Input from "@/Components/Input.vue";

const search = ref(null);
const user = usePage().props.auth.user;

import { ref } from "vue";
import { Dialog, DialogPanel } from "@headlessui/vue";

import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";

import { IconX, IconSearch, IconMenu } from "@tabler/icons-vue";

const mobileMenuOpen = ref(false);

const navigation = [
    {
        name: "Home",
        href: route("home"),
        current: route().current("home"),
    },
    { name: "Product", href: "#" },
    { name: "Features", href: "#" },
    { name: "Marketplace", href: "#" },
    { name: "Company", href: "#" },
];
const userNavigation = [
    { name: "Your Profile", href: route("account.edit") },
    { name: "Your Tools", href: route("tools.index") },
];
</script>

<template>
    <!-- <Disclosure
        as="nav"
        class="bg-white border-b border-gray-100"
        v-slot="{ open }"
    >
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img
                            class="h-8 w-8"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                            alt="Your Company"
                        />
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <Link
                                v-for="item in navigation"
                                :key="item.name"
                                :href="item.href"
                                :class="[
                                    item.current
                                        ? 'bg-gray-900 text-white'
                                        : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                                    'rounded-md px-3 py-2 text-sm font-medium',
                                ]"
                                :aria-current="
                                    item.current ? 'page' : undefined
                                "
                                >{{ item.name }}</Link
                            >
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div v-if="user" class="ml-4 flex items-center md:ml-6">
                        <button
                            type="button"
                            class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <span class="absolute -inset-1.5" />
                            <span class="sr-only">View notifications</span>
                            <IconBell class="h-6 w-6" aria-hidden="true" />
                        </button>

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
                                            class="w-full block text-left px-4 py-2 text-sm text-gray-700 bg-gray-100 cursor-pointer"
                                        >
                                            <div>Sign Out</div>
                                        </Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Log in</Link
                        >

                        <Link
                            :href="route('register')"
                            class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Register</Link
                        >
                    </template>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <DisclosureButton
                        class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    >
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open main menu</span>
                        <IconMenu
                            v-if="!open"
                            class="block h-6 w-6"
                            aria-hidden="true"
                        />
                        <IconX
                            v-else
                            class="block h-6 w-6"
                            aria-hidden="true"
                        />
                    </DisclosureButton>
                </div>
            </div>
        </div>

        <DisclosurePanel class="md:hidden">
            <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                <DisclosureButton
                    v-for="item in navigation"
                    :key="item.name"
                    as="a"
                    :href="item.href"
                    :class="[
                        item.current
                            ? 'bg-gray-900 text-white'
                            : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                        'block rounded-md px-3 py-2 text-base font-medium',
                    ]"
                    :aria-current="item.current ? 'page' : undefined"
                    >{{ item.name }}</DisclosureButton
                >
            </div>
            <div class="border-t border-gray-700 pb-3 pt-4">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img
                            class="h-10 w-10 rounded-full"
                            :src="user.imageUrl"
                            alt=""
                        />
                    </div>
                    <div class="ml-3">
                        <div
                            class="text-base font-medium leading-none text-white"
                        >
                            {{ user.name }}
                        </div>
                        <div
                            class="text-sm font-medium leading-none text-gray-400"
                        >
                            {{ user.email }}
                        </div>
                    </div>
                    <button
                        type="button"
                        class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    >
                        <span class="absolute -inset-1.5" />
                        <span class="sr-only">View notifications</span>
                        <IconBell class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <DisclosureButton
                        v-for="item in userNavigation"
                        :key="item.name"
                        as="a"
                        :href="item.href"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        >{{ item.name }}</DisclosureButton
                    >
                </div>
            </div>
        </DisclosurePanel>
    </Disclosure> -->

    <header class="sticky top-0 bg-white sm:border-b border-gray-100 z-10">
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
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                        >
                            <IconSearch class="h-5 w-5 text-gray-400" />
                        </div>
                        <Input
                            class="w-full pl-10"
                            autocomplete="off"
                            type="text"
                            placeholder="Search..."
                            @click="search.open()"
                        />
                        <div
                            class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5"
                        >
                            <kbd class="kbd-search">⌘K</kbd>
                        </div>
                    </div>

                    <a
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        class="text-sm font-semibold leading-6 text-gray-900"
                        >{{ item.name }}</a
                    >
                </div>
            </div>
            <div class="flex flex-1 items-center justify-end gap-x-6">
                <Link
                    :href="route('login')"
                    class="hidden lg:block lg:text-sm lg:font-semibold lg:leading-6 lg:text-gray-900"
                    >Log in</Link
                >
                <Link
                    :href="route('register')"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Sign up
                </Link>
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
                            <a
                                v-for="item in navigation"
                                :key="item.name"
                                :href="item.href"
                                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                >{{ item.name }}</a
                            >
                        </div>
                        <div class="py-6">
                            <Link
                                :href="route('login')"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                >Log in</Link
                            >
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>

    <Search ref="search" />
</template>
