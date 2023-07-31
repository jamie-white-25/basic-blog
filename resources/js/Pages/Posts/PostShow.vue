<script setup>
import { Link } from "@inertiajs/vue3";

import Comment from "./Partials/Comment.vue";
import CommentForm from "./Partials/CommentForm.vue";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { computed } from "vue";
import { ref } from "vue";

const { post } = defineProps({
    post: Object,
    canEdit: Boolean,
    canDelete: Boolean,
});

const postData = computed(() => post.data);
const comments = computed(() => post.data.comments);
</script>

<template>
    <Head :title="postData.title" />

    <DefaultLayout>
        <div class="bg-white px-6 py-32 lg:px-8">
            <div class="mx-auto text-base leading-7 text-gray-700">
                <div class="flex justify-end space-x-2">
                    <Link
                        v-if="canEdit"
                        :href="route('posts.edit', postData.slug)"
                    >
                        <SecondaryButton> Edit </SecondaryButton>
                    </Link>
                    <Link
                        v-if="canDelete"
                        method="DELETE"
                        :href="route('posts.destroy', postData.slug)"
                    >
                        <SecondaryButton
                            class="!bg-red-400 hover:!bg-red-500 text-white"
                        >
                            Delete
                        </SecondaryButton>
                    </Link>
                </div>
                <p class="text-base font-semibold leading-7 text-indigo-600">
                    Written by {{ postData.user.name }}
                </p>

                <h1
                    class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                >
                    {{ postData.title }}
                </h1>

                <figure class="mt-16">
                    <img
                        class="aspect-video w-full rounded-xl bg-gray-50 object-cover"
                        :src="`/storage/${postData.image}`"
                        alt=""
                    />
                </figure>
                <p class="mt-6 text-xl leading-8">
                    {{ postData.body }}
                </p>
            </div>
        </div>

        <div class="px-3 mb-12">
            <CommentForm v-if="$page.props.auth.user" :slug="postData.slug" />
            <div class="space-y-4 px-3 mt-4">
                <h2 class="px-6">Comments</h2>
                <Comment v-for="comment in comments" :comment="comment" />
            </div>
        </div>
    </DefaultLayout>
</template>
