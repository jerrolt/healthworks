<template>
<div class="pb-10 rounded-md w-1/2 mx-auto">
    <h1 class="flex items-center text-2xl font-extrabold dark:text-white mb-5">Login</h1>
    <form @submit.prevent="login">
        <!-- <div class="w-1/2 mx-auto"> -->
            <div>
                <label for="email" class="label">E-mail (username)</label>
                <input id="email" v-model="form.email" type="text" class="input" />
                <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input" />
                <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Login</button>
            </div>
        <!-- </div> -->
    </form>
</div>
</template>
  
<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
})
const login = () => form.post(route('login.store'))
</script>

<script>
import MainLayout from '../../Layouts/MainLayout.vue';
export default{
    layout: MainLayout
}
</script>