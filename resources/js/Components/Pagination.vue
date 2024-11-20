<script setup>
defineProps({
    paginator: {
        type: Object,
        required: true
    },
});

const makeLabel = (label) => {    
    if (label.includes("Previous")) {
        return "Previous";
    } else if (label.includes("Next")) {
        return "Next";
    } else {
        return label;
    }
} 
</script>

<template>
    <nav class="bg-white dark:bg-gray-800 flex flex-column flex-wrap items-center justify-between md:flex-row px-5 py-3" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
            Showing 
            <span class="font-semibold text-gray-900 dark:text-white">{{ paginator.from }}</span>
            to
            <span class="font-semibold text-gray-900 dark:text-white">{{ paginator.to }}</span> 
            of 
            <span class="font-semibold text-gray-900 dark:text-white">{{ paginator.total }}</span>
        </span>

        <ul class="inline-flex -space-x-px">
            <li v-for="(link,index) in paginator.links" :key="link.url ? link.url + '-' + index : index">
                <component 
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makeLabel(link.label)"
                    :class="[
                        'flex items-center justify-center px-3 py-2 leading-tight border',
                        link.active 
                            ? 'font-bold text-white bg-gray-700 border-gray-700' 
                            : 'text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                        {
                            'rounded-s-lg': link.label.includes('Previous'),
                            'rounded-e-lg': link.label.includes('Next'),
                            'text-zinc-400': !link.url
                        }
                    ]"
                />
            </li>
        </ul>
    </nav>
</template>