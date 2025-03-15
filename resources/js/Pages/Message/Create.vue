<template>
    <div class="pb-10 rounded-md w-3/4 mx-auto">
        <h1 class="flex items-center text-2xl font-extrabold dark:text-white mb-5">Send Message</h1>
        <div v-if="form.errors.sms" class="input-error">
            {{ form.errors.sms }}
        </div>
        <form @submit.prevent="submit" enctype='multipart/form-data'>
            <div class="clear-both mb-2">
                <label for="msg-phone" class="label">Recipient Phone Number:</label>
                <input id="msg-phone" v-model="form.phone_number" type="text" placeholder="Enter 10 digits only" class="input"/>
                <div v-if="form.errors.phone_number" class="input-error">
                    {{ form.errors.phone_number }}
                </div>
            </div>

            <div class="clear-both mb-2">
                <label for="msg-content" class="label">Message:</label>
                <textarea id="msg-content" name="content" v-model="form.content" class="input" rows="5" ></textarea>
                <div v-if="form.errors.content" class="input-error">
                    {{ form.errors.content }}
                </div>
            </div>

            <div class="clear-both mb-2">
                <label for="msg-files" class="label">Select Files:</label>
                <input id="msg-files" type="file" multiple @click="clearFiles" @input="addFiles" class="input"/>
                <div v-if="imageError" class="input-error">
                    {{ imageError }}
                </div>
            </div>
            
            <div class="clear-both mb-2">
                <button type="submit" :disabled="!canSend" class="btn-primary disabled:opacity-25 disabled:cursor-not-allowed">Send</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
import {ref, computed} from 'vue'
import MainLayout from '@/Layouts/MainLayout.vue'



const form = useForm({
    content:'default content',
    phone_number: '',
    files: []
})


const submit = () => {
    form.post(route('message.store'));
}

const addFiles = (event) => {
   for (const file of event.target.files) {
     form.files.push(file)
   }
}

const canSend = computed(() => form.files.length)

const clearFiles = (event) => {
    form.files = []
}
const imageError = computed(() => {
    let vals = Object.values(form.errors)
    let keys = Object.keys(form.errors)

    let found = false;
    let idx = -1;
    found = keys.every((k) => {
        idx++
        if(k.match(/^files.[0-9]+/))
            return true;
        return false;
    })
    return found ? vals[idx] : false;
})
</script>
<script>
import MainLayout from '@/Layouts/MainLayout.vue'

export default{
    layout: MainLayout
}
</script>
