<template>
    <div class="flex flex-col h-screen">
        <!-- <main class="flex flex-row w-full justify-center container mx-auto p-5"> -->
        <main class="container mx-auto p-4 w-full justify-center">
            <slot>Default</slot>  
        </main>
    </div>
</template>
  
<script setup>
import {ref, reactive, computed} from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
</script>