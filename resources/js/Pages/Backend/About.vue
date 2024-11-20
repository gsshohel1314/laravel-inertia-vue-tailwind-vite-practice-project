<script setup>
import Layout from "../../Layouts/Layout.vue";
import Toastr from "../../Components/Toastr.vue";
import { useForm  } from '@inertiajs/vue3'
import Toast from "../../Stores/Toastr.js";

defineProps({
    user: Object
});

const form = useForm({});

const submit = () => {
    form.post(route('test_toastr'));
}

const addToastr = (message, title, type) => {
    Toast.add({ 
        key: Date.now() + Math.random(), 
        message: message, 
        title: title, 
        type: type
    })
}
</script>

<template>
    <Layout>
        <Head>
            <title> | About</title>
            <meta name="description" content="This is about page description">
        </Head>
    
    
    
    
    
    
        <!-- <Toastr /> -->
        <Toastr :message="$page.props.flash.message ?? 'Default Message'" title="Created" type="info"/>
    
        <div class="mb-4 mt-14 flex items-center justify-center h-[32.5rem] rounded bg-gray-50 dark:bg-gray-800">
            <div class="px-6 py-4 text-center">
                <div class="font-bold text-xl mb-2">{{ $page.component }} Page</div>
                <p class="text-gray-700 text-base"> Name: {{ user.name }}</p>
                <p class="text-gray-700 text-base"> Age: {{ user.age }}</p>
                <p class="text-gray-700 text-base"> Student: {{ user.isStudent ? 'Yes' : 'No' }}</p>
                <div class="mt-14">
                    <button 
                        @click="Toast.add({message: $page.props.flash.message ?? 'Default Message', title: 'Title', type: 'info'})" 
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Info
                    </button>
    
                    <button 
                        @click="Toast.add({message: $page.props.flash.message ?? 'Default Message', title: 'Title', type: 'success'})" 
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Success
                    </button>
    
                    <button 
                        @click="Toast.add({message: $page.props.flash.message ?? 'Default Message', title: 'Title', type: 'error'})" 
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Error
                    </button>
    
                    <button 
                        @click="Toast.add({message: $page.props.flash.message ?? 'Default Message', title: 'Title', type: 'warning'})" 
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                        Warning
                    </button>
                </div>
            </div>
        </div>
    
        <button 
            @click="addToastr($page.props.flash.message ?? 'Default Message', 'Created', 'success')" 
            class="text-white bg-indigo-600 hover:bg-indigo-700 px-5 py-4">
            Add Toast
        </button>
    
        <form @submit.prevent="submit" class="mb-28">
            <button
                type="submit" 
                class="text-white bg-indigo-600 hover:bg-indigo-700 px-5 py-4">
                Test Toastr
            </button>
        </form>







        


        

        



    </Layout>
</template>