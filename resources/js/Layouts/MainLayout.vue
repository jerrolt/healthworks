<template>
    <div class="flex flex-col h-screen">
        <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
            <div class="container mx-auto">
                <nav class="p-4 flex items-center justify-between">
                    <div class="text-lg font-medium">
                        <!-- <Link :href="route('home')" method="GET">Home</Link> -->
                    </div>
                    <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                        <Link :href="route('main')" method="GET">Home</Link>
                    </div>
                    <div v-if="user" class="flex items-center gap-4">
                        <div class="text-sm text-gray-500">{{ user.name }}</div>
                        <Link :href="route('message.create')" class="btn-primary">+ Send Message</Link>
                        <div>
                            <Link :href="route('logout')" method="delete" as="button" class="text-md text-blue-500 hover:underline hover:text-blue-700">Logout</Link>
                        </div>
                    </div>
                    <div v-else class="flex items-center gap-2">
                        <Link :href="route('user-account.create')" class="text-md text-blue-500 hover:underline hover:text-blue-700">Register</Link>
                        <Link :href="route('login')" class="text-md text-blue-500 hover:underline hover:text-blue-700">Sign-In</Link>
                    </div>
                </nav>
            </div>
        </header>
        <main class="container mx-auto p-4 w-full justify-center">
            <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
                {{ flashSuccess }}
            </div>
            <slot>Default</slot>
        </main>
    </div>
</template>
  
<script setup>
import {ref, reactive, computed} from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()

const flashSuccess = computed(
   () => page.props.flash.success,
)

const user = computed(
   () => page.props.user,
 )
</script>