<script setup>
import Layout from "@/Layouts/Master.vue";
import { Link, Head } from "@inertiajs/vue3";

const { blogPost } = defineProps({
    blogPost: Object,
});

const formatDate = (date) => {
    return dayjs(date).format("MMMM D, YYYY");
};
</script>
<template>
    <Head>
        <title>
            {{ blogPost.seo_title ? blogPost.seo_title : blogPost.title }}
        </title>

        <meta
            name="description"
            :content="
                blogPost.seo_description
                    ? blogPost.seo_description
                    : blogPost.excerpt
            "
        />

        <link
            v-if="blogPost.canonical"
            rel="canonical"
            :href="blogPost.canonical"
        />
    </Head>

    <Layout>
        <div class="bg-white py-24 sm:py-40">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-3xl">
                    <div
                        v-if="blogPost.blog_category"
                        class="relative font-semibold text-blue-600 text-xs uppercase mb-2"
                    >
                        <Link
                            :href="
                                route(
                                    'blog.categories.show',
                                    blogPost.blog_category.slug
                                )
                            "
                            >{{ blogPost.blog_category.title }}</Link
                        >
                    </div>
                    <h1
                        class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-4"
                    >
                        {{ blogPost.title }}
                    </h1>
                    <div class="mb-4 text-xs text-gray-600">
                        {{
                            `By ${blogPost.user.name} on ${formatDate(
                                blogPost.published_at
                            )} — ${blogPost.reading_time} min read`
                        }}
                    </div>

                    <div
                        v-if="blogPost.cover_image_preview"
                        class="relative w-full"
                    >
                        <img
                            :src="blogPost.cover_image_preview"
                            alt=""
                            class="aspect-[16/9] w-full rounded bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]"
                        />
                        <div class="absolute inset-0 rounded" />
                    </div>
                </div>
                <div class="mx-auto max-w-3xl">
                    <div class="">
                        <div class="group relative">
                            <div
                                v-html="blogPost.body"
                                class="mt-5 text-sm leading-6 text-gray-600 prose prose-2xl min-w-full"
                            ></div>
                        </div>
                        <div
                            class="relative flex items-start gap-x-4 border-t border-gray-100 mt-8 pt-8"
                        >
                            <img
                                :src="blogPost.user.photo_url"
                                alt=""
                                class="h-10 w-10 rounded-full bg-gray-100"
                            />
                            <div class="text-sm">
                                <p class="font-semibold text-gray-900">
                                    {{ blogPost.user.name }}
                                </p>
                                <p class="font-normal text-gray-500 max-w-sm">
                                    {{ blogPost.user.job_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
