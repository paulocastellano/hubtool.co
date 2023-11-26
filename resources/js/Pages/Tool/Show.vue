<script setup>
import { Head, Link } from "@inertiajs/vue3";
import helper from "@/helper";

import { IconArrowNarrowRight } from "@tabler/icons-vue";

import Layout from "@/Layouts/Master.vue";
import ToolCard from "@/Components/Tool/Card.vue";
import ToolCategory from "@/Components/Tool/Category.vue";
import ToolShare from "@/Components/Tool/Share.vue";

const { tool, relatedTools } = defineProps({
    tool: {
        type: Object,
        required: true,
    },

    relatedTools: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <!-- <div class="flex items-center mb-2 space-x-2">


        <ToolShare :tool="tool" />
    </div> -->

    <Layout max-width="5xl">
        <div class="grid grid-cols-1 sm:grid-cols-10 gap-8">
            <div class="col-span-6 p-6 order-2 sm:order-1">
                <div class="">
                    <div class="py-8 first:pt-0 last:pb-0">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div v-if="tool.photo">
                                    <img
                                        :src="tool.photo_url"
                                        class="h-14 w-auto rounded"
                                    />
                                </div>

                                <div>
                                    <a
                                        class="inline-flex items-center rounded-full bg-gray-50 px-3 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 space-x-1"
                                        :href="tool.website"
                                        target="_blank"
                                    >
                                        <span>{{ tool.website }}</span>

                                        <IconArrowNarrowRight
                                            class="w-4 h-4 -rotate-45"
                                        />
                                    </a>
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <Link
                                    as="h3"
                                    class="flex-shrink text-2xl font-semibold text-black hover:text-accent-color cursor-pointer"
                                    :href="route('tools.show', tool.slug)"
                                >
                                    {{ tool.name }}
                                </Link>

                                <p class="text-sm text-gray-400 line-clamp-2">
                                    {{ tool.headline }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="py-6 prose prose-sm prose-img:rounded max-w-full"
                            v-html="tool.description"
                        />
                    </div>
                </div>
            </div>

            <div
                class="col-span-4 border-l border-gray-100 order-1 sm:order-2 overflow-none"
            >
                <div class="px-4 sticky top-20">
                    <div>
                        <div>
                            <div>
                                <div>Pricing</div>
                                <div>{{ tool.pricing }}</div>
                            </div>

                            <div>
                                <div>Categories</div>
                                <div class="space-x-2 py-6">
                                    <div
                                        v-for="category in tool.categories"
                                        :key="category.id"
                                        class="inline-flex"
                                    >
                                        <ToolCategory :category="category" />
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div>Featured</div>
                                <div class="text-gray-400 font-medium text-xs">
                                    {{ helper.formatDate(tool.published_at) }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="font-medium mb-4 text-sm text-gray-600">
                                {{ `${tool.name} Alternatives` }}
                            </div>

                            <div class="space-y-6">
                                <div
                                    v-for="tool in relatedTools"
                                    :key="tool.id"
                                >
                                    <Link
                                        :href="route('tools.show', tool.slug)"
                                        class="flex items-center cursor-pointer space-x-4"
                                    >
                                        <div class="flex-none">
                                            <img
                                                :src="tool.photo_url"
                                                :alt="tool.name"
                                                class="w-14 h-14 rounded"
                                            />
                                        </div>
                                        <div>
                                            <div class="mb-2">
                                                <h3
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{ tool.name }}
                                                </h3>
                                                <p
                                                    class="text-xs text-gray-600 line-clamp-2"
                                                >
                                                    {{ tool.headline }}
                                                </p>
                                            </div>
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
