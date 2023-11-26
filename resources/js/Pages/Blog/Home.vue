<script setup>
import Layout from "@/Layouts/Master.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link, Head } from "@inertiajs/vue3";

const { blogPosts } = defineProps({
    blogPosts: Object,
});

const formatDate = (date) => {
    return dayjs(date).format("MMMM D, YYYY");
};
</script>
<template>
    <Head title="Blog" />
    <Layout>
        <div class="py-24 sm:py-40">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2
                        class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                    >
                        Launch Stack Blog
                    </h2>
                    <p class="mt-2 text-lg text-gray-600">
                        Learn how to grow your business with our expert advice.
                    </p>
                </div>
                <div
                    class="mx-auto mt-16 mb-8 grid max-w-2xl grid-cols-1 gap-y-20 gap-x-8 lg:mx-0 lg:max-w-none lg:grid-cols-3"
                >
                    <article
                        v-for="blogPost in blogPosts.data"
                        :key="blogPost.id"
                        class="flex flex-col items-start justify-between"
                    >
                        <Link
                            v-if="blogPost.cover_image_preview"
                            :href="route('blog.show', blogPost.slug)"
                            class="relative w-full"
                        >
                            <img
                                :src="blogPost.cover_image_preview"
                                alt=""
                                class="aspect-[16/9] w-full rounded bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]"
                            />
                            <div class="absolute inset-0 rounded" />
                        </Link>
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <Link
                                    v-if="blogPost.blog_category"
                                    :href="route('blog.show', blogPost.slug)"
                                    class="relative font-medium text-gray-500"
                                    >{{ blogPost.blog_category.title }}
                                </Link>
                            </div>
                            <div class="group relative">
                                <h3
                                    class="mt-3 text-lg font-bold text-gray-900 group-hover:text-gray-600"
                                >
                                    <Link
                                        :href="
                                            route('blog.show', blogPost.slug)
                                        "
                                    >
                                        <span class="absolute inset-0" />
                                        {{ blogPost.title }}
                                    </Link>
                                </h3>
                                <div
                                    v-html="blogPost.body"
                                    class="mt-5 text-sm text-gray-600 line-clamp-2 prose"
                                ></div>
                            </div>
                            <div
                                class="relative mt-8 text-xs text-gray-500 font-medium"
                            >
                                {{
                                    `${formatDate(blogPost.published_at)} — ${
                                        blogPost.reading_time
                                    } min read`
                                }}
                            </div>
                        </div>
                    </article>
                </div>

                <Pagination :data="blogPosts" />
            </div>
        </div>
    </Layout>
</template>
