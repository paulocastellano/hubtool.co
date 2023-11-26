<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { defineComponent, h } from "vue";

const cache = usePage().props.cache;

import { IconBrandTwitter, IconBrandLinkedin } from "@tabler/icons-vue";

const navigation = {
    categories: cache.featured_categories.map((category) => ({
        name: category.name,
        href: route("categories.show", category.slug),
    })),
    alternatives: [
        { name: "Best Google Analytics alternatives", href: "#" },
        { name: "Best Gumroad alternatives", href: "#" },
    ],
    legal: [
        { name: "Terms", href: "#" },
        { name: "Privacy Policy", href: "#" },
    ],
    hubtool: [
        { name: "About us", href: "#" },
        { name: "Blog", href: "#" },
    ],
    social: [
        {
            name: "LinkedIn",
            href: "#",
            icon: IconBrandLinkedin,
        },
        {
            name: "Twitter",
            href: "#",
            icon: IconBrandTwitter,
        },
    ],
};
</script>

<template>
    <footer class="bg-gray-900" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div
            class="mx-auto max-w-7xl px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32"
        >
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="md:grid md:grid-cols-3 col-span-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-white">
                            Categories
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li
                                v-for="item in navigation.categories"
                                :key="item.name"
                            >
                                <a
                                    :href="item.href"
                                    class="text-sm leading-6 text-gray-300 hover:text-white"
                                    >{{ item.name }}</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-white">
                            Alternatives
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li
                                v-for="item in navigation.alternatives"
                                :key="item.name"
                            >
                                <a
                                    :href="item.href"
                                    class="text-sm leading-6 text-gray-300 hover:text-white"
                                    >{{ item.name }}</a
                                >
                            </li>
                        </ul>
                    </div>

                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-white">
                            Legal
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li
                                v-for="item in navigation.legal"
                                :key="item.name"
                            >
                                <a
                                    :href="item.href"
                                    class="text-sm leading-6 text-gray-300 hover:text-white"
                                    >{{ item.name }}</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-10 xl:mt-0">
                    <h3 class="text-sm font-semibold leading-6 text-white">
                        Subscribe to our newsletter
                    </h3>
                    <p class="mt-2 text-sm leading-6 text-gray-300">
                        The latest news, articles, and resources, sent to your
                        inbox weekly.
                    </p>
                    <form class="mt-6 sm:flex sm:max-w-md">
                        <label for="email-address" class="sr-only"
                            >Email address</label
                        >
                        <input
                            type="email"
                            name="email-address"
                            id="email-address"
                            autocomplete="email"
                            required=""
                            class="w-full min-w-0 appearance-none rounded-md border-0 bg-white/5 px-3 py-1.5 text-base text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:w-64 sm:text-sm sm:leading-6 xl:w-full"
                            placeholder="Enter your email"
                        />
                        <div class="mt-4 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                            <button
                                type="submit"
                                class="flex w-full items-center justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                            >
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div
                class="mt-16 border-t border-white/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24"
            >
                <div class="flex space-x-6 md:order-2">
                    <a
                        v-for="item in navigation.social"
                        :key="item.name"
                        :href="item.href"
                        class="text-gray-500 hover:text-gray-400"
                    >
                        <span class="sr-only">{{ item.name }}</span>
                        <component
                            :is="item.icon"
                            class="h-6 w-6"
                            aria-hidden="true"
                        />
                    </a>
                </div>
                <p
                    class="mt-8 text-xs leading-5 text-gray-400 md:order-1 md:mt-0"
                >
                    &copy; 2023 Hubtool LLC, All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    <!-- <footer class="bg-gray-900" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div
            class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32"
        >
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8">
                    <img
                        class="h-7"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Company name"
                    />
                    <p class="text-sm leading-6 text-gray-300">
                        Hubtool is a curated list of the best software and
                        tools. If you're looking for a Google Analytics
                        alternative, Some AI Tool, or are you looking for a new
                        job? We have something for you!
                    </p>
                    <div class="flex space-x-6">
                        <a
                            v-for="item in navigation.social"
                            :key="item.name"
                            :href="item.href"
                            class="text-gray-500 hover:text-gray-400"
                        >
                            <span class="sr-only">{{ item.name }}</span>
                            <component
                                :is="item.icon"
                                class="h-6 w-6"
                                aria-hidden="true"
                            />
                        </a>
                    </div>
                </div>
                <div
                    class="mt-16 grid grid-cols-1 gap-8 lg:grid-cols-3 xl:col-span-2 xl:mt-0"
                >
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-white">
                            Categories
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li
                                v-for="item in navigation.categories"
                                :key="item.name"
                            >
                                <a
                                    :href="item.href"
                                    class="text-sm leading-6 text-gray-300 hover:text-white"
                                    >{{ item.name }}</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-white">
                            Alternatives
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li
                                v-for="item in navigation.alternatives"
                                :key="item.name"
                            >
                                <a
                                    :href="item.href"
                                    class="text-sm leading-6 text-gray-300 hover:text-white"
                                    >{{ item.name }}</a
                                >
                            </li>
                        </ul>
                    </div>

                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm font-semibold leading-6 text-white">
                            Hubtool
                        </h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li
                                v-for="item in navigation.hubtool"
                                :key="item.name"
                            >
                                <a
                                    :href="item.href"
                                    class="text-sm leading-6 text-gray-300 hover:text-white"
                                    >{{ item.name }}</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-16 border-t border-white/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-gray-400 text-center">
                    &copy; 2023 Hubtool LLC. All rights reserved.
                </p>
            </div>
        </div>
    </footer> -->
</template>
