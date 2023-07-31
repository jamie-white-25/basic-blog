<script setup>
import { useForm } from "@inertiajs/vue3";

const { comment } = defineProps({ comment: Object });

const form = useForm({});

function deleteComment() {
    form.delete(route("comments.destroy", comment.id), {
        preserveScroll: true,
        preserveState: false,
    });
}
</script>

<template>
    <article class="p-6 mb-6 text-base bg-white rounded-lg border-b">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900">
                    {{ comment.user.name }}
                </p>
                <p class="text-sm text-gray-600">
                    <time
                        :datetime="comment.created_at"
                        title="February 8th, 2022"
                        >{{ comment.created_at }}</time
                    >
                </p>
            </div>
        </div>
        <p class="text-gray-500">
            {{ comment.body }}
        </p>
        <div class="flex items-center mt-4 space-x-4">
            <Button
                v-if="comment.canDelete"
                @click="deleteComment"
                class="flex items-center text-xs p-2 bg-red-500 text-white rounded hover:bg-red-700"
            >
                Delete
            </Button>
        </div>
    </article>
</template>
