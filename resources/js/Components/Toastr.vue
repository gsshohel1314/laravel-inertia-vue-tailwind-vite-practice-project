<script setup>
import ToastrItem from "../Components/ToastrItem.vue";
import { Inertia } from '@inertiajs/inertia';
import { onMounted, onUnmounted } from 'vue';
import Toastr from "../Stores/Toastr.js";

const props = defineProps({
    message: {
        type: String,
        required: true
    },

    title: {
        type: String,
        required: false
    },

    type: {
        type: String,
        required: true
    }
})

let removeFinishEventListener;

onMounted(() => {
    // Attach the event listener and handle it when component is mounted
    removeFinishEventListener = Inertia.on('finish', () => {
        if (props.message) {
            Toastr.add({ 
                message: props.message,
                title: props.title,
                type: props.type 
            });
        }
    });
});

onUnmounted(() => {
    // Remove the event listener when component is unmounted
    if (removeFinishEventListener) {
        removeFinishEventListener();
    }
});


const remove = (index) => {    
    Toastr.remove(index);
}
</script>

<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs"
    >
        <ToastrItem 
            v-for="(item, index) in Toastr.items"
            :key = "item.key"
            :message = "item.message"
            :title = "item.title"
            :duration = "1000"
            :type = "item.type"
            @remove = "remove(index)"
        />
    </TransitionGroup>
</template>