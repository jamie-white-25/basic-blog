<script setup></script>

<template>
    <div class="min-h-screen m-0 p-0 pb-12">
        <div
            class="w-full sm:top-0 sm:right-0 p-6 text-right max-w-7xl mx-auto space-x-4"
        >
            <Link
                :href="route('posts.index')"
                class="font-semibold text-gray-600 hover:text-gray-900focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500"
            >
                Posts
            </Link>

            <template v-if="$page.props.auth.user">
                <Link
                    :href="route('dashboard')"
                    class="font-semibold text-gray-600 hover:text-gray-900focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500"
                >
                    Dashboard
                </Link>
                <Link
                    method="post"
                    :href="route('logout')"
                    class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500"
                >
                    Logout
                </Link>
            </template>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500"
                >
                    Log in
                </Link>

                <Link
                    :href="route('register')"
                    class="font-semibold text-gray-600 hover:text-indigo-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500"
                >
                    Register
                </Link>
            </template>
        </div>

        <main class="max-w-7xl mx-auto">
            <slot />
        </main>
    </div>
</template>
