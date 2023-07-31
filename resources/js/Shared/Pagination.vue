<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
    total: Number,
    lastPage: Number,
    currentPage: Number,
    nextLink: String,
    previousLink: String,
});
</script>

<template>
    <div
        class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <Link
                v-if="previousLink"
                :href="previousLink"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >Previous</Link
            >
            <Link
                v-if="nextLink"
                :href="nextLink"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >Next</Link
            >
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Page
                    <span class="font-medium">{{ currentPage }}</span>
                    of
                    <span class="font-medium">{{ lastPage }}</span>
                    results
                    <span class="font-medium">{{ total }}</span>
                </p>
            </div>
            <div>
                <nav
                    class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                    aria-label="Pagination"
                >
                    <Link
                        v-for="link in links"
                        :href="link.url"
                        aria-current="page"
                        :class="{
                            'bg-indigo-600 text-white hover:bg-indigo-500':
                                currentPage == link.label,
                        }"
                        class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex"
                    >
                        <span v-html="link.label"></span>
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>
