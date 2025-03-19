<template>
    <div  class=" container mx-auto mb-4 border rounded-md shadow-sm border-blue-200 dark:border-blue-800 bg-blue-50 dark:bg-blue-900 p-2 sm:p-2 lg:p-2">
        <!-- Your content here -->
        <Link :href="route('message.show', secret)" class="text-md text-blue-500 hover:underline hover:text-blue-700">Go to the message</Link>
    </div>
</template>

<script setup>
import {ref, reactive, computed} from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const secret = computed(()=>page.props.messageSecret)
</script>

<script>
import MainLayout from '@/Layouts/MainLayout.vue'
export default{
    layout: MainLayout
}
</script>


