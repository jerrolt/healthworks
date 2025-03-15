<template>
<div class="w-1/2 mx-auto">
    <h1 class="flex items-center text-2xl font-extrabold dark:text-white mb-5">Register</h1>
    <form @submit.prevent="register">
      
        <div>
          <label for="name" class="label">Your Name</label>
          <input
            id="name" v-model="form.name" type="text"
            class="input"
          />
          <div v-if="form.errors.name" class="input-error">
            {{
              form.errors.name }}
          </div>
        </div>
        <div class="mt-4">
          <label for="email" class="label">E-mail</label>
          <input
            id="email" v-model="form.email" type="text"
            class="input"
          />
          <div v-if="form.errors.email" class="input-error">
            {{
              form.errors.email }}
          </div>
        </div>
        <div class="mt-4">
          <label for="password" class="label">Password</label>
          <input
            id="password" v-model="form.password"
            type="password" class="input"
          />
          <div
            v-if="form.errors.password"
            class="input-error"
          >
            {{ form.errors.password }}
          </div>
        </div>
        <div class="mt-4">
          <label for="password_confirmation" class="label">Confirm Password</label>
          <input
            id="password_confirmation" v-model="form.password_confirmation"
            type="password" class="input"
          />
        </div>
        <div class="mt-4">
          <button
            class="btn-primary w-full"
            type="submit"
          >
            Create Account
          </button>
        </div>
      
    </form>
</div>
</template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
  })
  const register = () => form.post(route('user-account.store'));
  </script>
  <script>
  import MainLayout from '@/Layouts/MainLayout.vue'
  
  export default{
      layout: MainLayout
  }
  </script>