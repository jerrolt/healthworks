<template>
    <div class="p-10 border-2 border-solid rounded-md shadow-md w-full mx-auto">
        <h1 class="flex items-center text-2xl font-extrabold dark:text-white mb-5">Files Available:</h1>
        
        <div class="link-container clear-both" v-for="(file,index) in props.message.files" :key="index">
            <img src="https://icon-library.com/images/download-icon-file/download-icon-file-25.jpg" width="15" height="15" />
            <a class="text-sm text-blue-500 hover:underline hover:text-red-500 active:text-yellow-500" :href="`/download/${file.secret}`" target="_blank">
                {{ `${file.filename}.${file.extension}` }}
            </a>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
const props = defineProps({
    message: Object
})
console.log(props.files)
</script>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';
export default{
    layout: MainLayout
}
</script>
<style scoped>
.link-container {
    display:flex;
    align-items: center;
}
.link-container img{
    margin-right: 8px;
}
</style>