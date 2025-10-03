<script setup>

defineProps({
    meta: {
        type: Object,
        required: true,
    },
    updatedPageNumber: {
        type: Function,
        required: true,
    },
})

</script>

<template>
    <div class="flex flex-col sm:flex-row justify-between items-center gap-2 mt-6 text-sm text-gray-700">
        <!-- Left side: info -->
        <div>
            Showing
            <span class="font-medium">{{ meta.from }}</span>
            to
            <span class="font-medium">{{ meta.to }}</span>
            of
            <span class="font-medium">{{ meta.total }}</span>
            results
        </div>

        <!-- Right side: pagination buttons -->
        <div class="inline-flex items-center space-x-1">
            <button
                v-for="(link, index) in meta.links"
                :key="index"
                @click.prevent="updatedPageNumber(link)"
                :disabled="link.active || !link.url"
                class="px-3 py-1 rounded-md border text-sm transition"
                :class="{
            'bg-blue-500 text-white border-blue-600': link.active,
            'text-gray-700 hover:bg-gray-100 border-gray-300': !link.active,
          }">
                <span v-html="link.label"/>
            </button>
        </div>
    </div>
</template>
