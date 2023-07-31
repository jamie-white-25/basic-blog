<script setup>
import { useForm } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import TextareaInput from "@/Components/TextareaInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    title: "",
    body: "",
    file: null,
});
</script>

<template>
    <Head title="Create a post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12"
                >
                    <form
                        @submit.prevent="form.post(route('posts.store'))"
                        class="space-y-10"
                    >
                        <div>
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </div>
                        <div>
                            <InputLabel for="body" value="Content" />

                            <TextareaInput
                                id="body"
                                class="mt-1 block w-full"
                                v-model="form.body"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.body"
                            />
                        </div>
                        <div>
                            <InputLabel for="file" value="File" />

                            <input
                                type="file"
                                @input="form.file = $event.target.files[0]"
                            />
                            <progress
                                v-if="form.progress"
                                :value="form.progress.percentage"
                                max="100"
                            >
                                {{ form.progress.percentage }}%
                            </progress>

                            <InputError
                                class="mt-2"
                                :message="form.errors.file"
                            />
                        </div>

                        <div class="flex justify-end">
                            <PrimaryButton
                                class="bg-indigo-600 hover:bg-indigo-500"
                                type="submit"
                            >
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
