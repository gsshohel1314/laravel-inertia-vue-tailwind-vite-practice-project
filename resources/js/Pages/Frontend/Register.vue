<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import { useForm  } from '@inertiajs/vue3'
import TextInput from "../../Components/TextInput.vue"

const form = useForm ({
    avatar: null,
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    preview: null,
})

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
}

const submit = () => {
    form.post(route('register'), {
        onError: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
    <AuthLayout>
        <Head>
            <title> | Register</title>
            <meta name="description" content="This is register page">
        </Head>
        
        <div>
            <div class="w-2/4 mx-auto">
                <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen">
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Create an account
                            </h1>
                            <form @submit.prevent="submit" class="space-y-4 md:space-y-6" action="#">
    
                                <div class="grid place-items-center">
                                    <div class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300">
                                        <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
                                            <span class="bg-white/70 pb-2 text-center">Avatar</span>
                                        </label>
                                        <input type="file" id="avatar" @input="change" hidden>
                                        <img class="object-cover h-28 w-28" :src="form.preview ?? '../uploads/avatars/avatar.jpg'" alt="">
                                    </div>
                                    <p><small class="text-red-500 error">{{ form.errors.avatar }}</small></p>
                                </div>
    
                                <TextInput
                                    label="Name"
                                    v-model="form.name"
                                    type="text"
                                    placeholder="Enter your name"
                                    :errorMessage="form.errors.name"
                                />
                                <TextInput
                                    label="Email"
                                    v-model="form.email"
                                    type="email"
                                    placeholder="name@company.com"
                                    :errorMessage="form.errors.email"
                                />
                                <TextInput
                                    label="Password"
                                    v-model="form.password"
                                    type="password"
                                    placeholder="••••••••"
                                    :errorMessage="form.errors.password"
                                />
                                <TextInput
                                    label="Confirm password"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    placeholder="••••••••"
                                />
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-indigo-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                                    </div>
                                </div>
                                <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Already have an account? <a :href="route('login.show')" class="font-medium text-indigo-600 hover:underline dark:text-primary-500">Login here</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>