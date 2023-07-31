<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";
import { router } from "@inertiajs/vue3";

//* Vue components
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import Pagination from "@/Shared/Pagination.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref } from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const { posts, search } = defineProps({
    posts: Object,
    search: { type: String, default: () => "" },
});

const form = useForm({ search: search });

function searchPosts() {
    form.get(route("posts.index"));
}

function clearSearch() {
    form.search = "";
    searchPosts();
}

const postsData = computed(() => posts.data);
const meta = computed(() => posts.meta);
</script>

<template>
    <Head title="Posts" />
    <DefaultLayout>
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-4xl">
                    <h2
                        class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                    >
                        From the blog
                    </h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">
                        View example blog post
                    </p>

                    <div class="mt-8 max-w-xl">
                        <input
                            id="search"
                            type="text"
                            class="mt-1 block w-full rounded border-gray-300"
                            placeholder="search..."
                            v-model="form.search"
                        />

                        <div class="flex space-x-3 mt-3">
                            <PrimaryButton @click="searchPosts"
                                >Search</PrimaryButton
                            >

                            <SecondaryButton @click="clearSearch">
                                Clear
                            </SecondaryButton>
                        </div>
                    </div>

                    <div class="mt-12 space-y-20 lg:mt-16 lg:space-y-20">
                        <article
                            v-for="post in postsData"
                            class="relative isolate flex flex-col gap-8 lg:flex-row"
                        >
                            <div
                                class="relative aspect-[16/9] sm:aspect-[2/1] lg:aspect-square lg:w-64 lg:shrink-0"
                            >
                                <img
                                    :src="`/storage/${post.image}`"
                                    alt=""
                                    class="absolute inset-0 h-full w-full rounded-2xl bg-gray-50 object-cover"
                                />
                                <div
                                    class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"
                                ></div>
                            </div>
                            <div>
                                <div class="flex items-center gap-x-4 text-xs">
                                    <time
                                        :datetime="post.created_at"
                                        class="text-gray-500"
                                        >{{ post.created_at }}</time
                                    >
                                </div>
                                <div class="group relative max-w-xl">
                                    <h3
                                        class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600"
                                    >
                                        <Link
                                            :href="
                                                route('posts.show', post.slug)
                                            "
                                        >
                                            <span class="absolute inset-0">
                                            </span>
                                            {{ post.title }}
                                        </Link>
                                    </h3>
                                    <p
                                        class="mt-5 text-sm leading-6 text-gray-600"
                                    >
                                        {{ post.body.slice(0, 200) }}... view
                                        more
                                    </p>
                                </div>
                                <div
                                    class="mt-6 flex border-t border-gray-900/5 pt-6"
                                >
                                    <div
                                        class="relative flex items-center gap-x-4"
                                    >
                                        <div class="text-sm leading-6">
                                            <p
                                                class="font-semibold text-gray-900"
                                            >
                                                <span></span>
                                                Created by
                                            </p>
                                            <p class="text-gray-600">
                                                {{ post.user.name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <Pagination
                            :links="meta.links"
                            :total="meta.total"
                            :last-page="meta.last_page"
                            :current-page="meta.current_page"
                            :next-link="meta.next_page_url"
                            :previous-link="meta.prev_page_url"
                        />
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
