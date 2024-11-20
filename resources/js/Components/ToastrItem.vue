<script setup>
import { onMounted } from 'vue';

const props = defineProps({
    message: String,
    title: String,
    type: String,
    duration: {
        type: Number,
        default: 2000
    }
});

onMounted(() => {
    setTimeout(() => emit('remove'), props.duration);
});

const emit = defineEmits(['remove']);

// Define the styles and icons based on the type
const typeStyles = {
    success: {
        bgColor: 'bg-green-100',
        iColor: 'text-green-500',
        iBgColor: 'bg-green-300',
        icon: (
            `<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>`
        ),
    },
    
    error: {
        bgColor: 'bg-red-100',
        iColor: 'text-red-500',
        iBgColor: 'bg-red-300',
        icon: (
            `<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>`
        ),
    },

    info: {
        bgColor: 'bg-blue-100',
        iColor: 'text-blue-500',
        iBgColor: 'bg-blue-300',
        icon: (
            `<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h1m0-4h-1m1 0h1M4 6h16M4 12h16M4 18h16"/>
            </svg>`
        ),
    },

    warning: {
        bgColor: 'bg-yellow-100',
        iColor: 'text-yellow-500',
        iBgColor: 'bg-yellow-300',
        icon: (
            `<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 2h.01M4.22 4.22l15.56 15.56M4.22 19.78l15.56-15.56"/>
            </svg>`
        ),
    },
};

// Get the styles for the current type
const { bgColor, iColor, iBgColor, icon } = typeStyles[props.type] || typeStyles.info;
</script>

<template>
    <div :class="`flex items-center p-4 rounded-lg shadow dark:text-gray-400 ${bgColor}`" role="alert">
        <div :class="`inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full ${iBgColor} ${iColor}`" v-html="icon"></div>

        <div class="ms-3">
            <div class="text-sm font-semibold">{{ props.title }}</div>
            <div class="text-sm font-normal">{{ props.message }}</div>
        </div>

        <button @click="$emit('remove')" type="button" class="-mx-1.5 -my-1.5 dark:text-gray-500 h-8 hover:text-gray-900 inline-flex items-center justify-center ms-auto p-1.5 rounded-lg text-gray-400 w-8" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
</template>
