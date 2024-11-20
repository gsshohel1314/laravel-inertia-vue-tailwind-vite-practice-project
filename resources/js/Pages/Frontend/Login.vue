<script setup>
import AuthLayout from '../../Layouts/AuthLayout.vue';
import { useForm  } from '@inertiajs/vue3'
import TextInput from "../../Components/TextInput.vue"

const form = useForm ({
    email: null,
    password: null,
    remember: null
})

const submit = () => {
    form.post(route('login'), {
        onError: () => form.reset('password'),
    })
}
</script>

<template>
    <AuthLayout>
        <Head>
            <title> | Login</title>
            <meta name="description" content="This is login page">
        </Head>

        <div>
            <div class="w-2/4 mx-auto">
                <div class="flex flex-col items-center px-6 py-8 mx-auto md:h-screen">
                    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Login into account
                            </h1>
                            <form @submit.prevent="submit" class="space-y-4 md:space-y-6" action="#">
    
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
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input v-model="form.remember" id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="terms" class="font-bold text-gray-500 dark:text-gray-300">Remember me</label>
                                    </div>
                                </div>
                                <button type="submit" class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                    Don't have an account? <a :href="route('register.show')" class="font-medium text-indigo-600 hover:underline dark:text-primary-500">Register here</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>