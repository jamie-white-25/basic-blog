<script setup>
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";

const $emits = defineEmits(["add", "delete"]);

const { slug } = defineProps({
    slug: String,
});

const form = useForm({
    body: "",
    post_slug: slug,
});

// function addComment() {
//     form.post(route("comments.store"), {
//         preserveScroll: true,
//         // onSuccess: $emit(),
//     });
// }
</script>

<template>
    <div class="flex items-start space-x-4">
        <div class="min-w-0 flex-1">
            <form
                @submit.prevent="
                    form.post(route('comments.store'), {
                        preserveScroll: true,
                        preserveState: false,
                    })
                "
            >
                <div
                    :class="{
                        'border-red-600': form.errors.body,
                    }"
                    class="border-b border-gray-200 focus-within:border-indigo-600"
                >
                    <label for="comment" class="sr-only"
                        >Add your comment</label
                    >
                    <textarea
                        v-model="form.body"
                        rows="3"
                        name="comment"
                        id="comment"
                        class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 text-gray-900 placeholder:text-gray-400 focus:border-indigo-600 focus:ring-0 sm:text-sm sm:leading-6"
                        placeholder="Add your comment..."
                    ></textarea>
                </div>
                <InputError class="mt-2" :message="form.errors.body" />
                <div class="flex justify-end pt-2">
                    <div class="flex-shrink-0">
                        <button
                            type="submit"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
