<script setup>
import { onMounted, ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import leaflet from 'leaflet'
import 'leaflet/dist/leaflet.css'
import 'leaflet.heat'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const map = ref(null)
const heatLayer = ref(null)
const loading = ref(true)
const stats = ref({
    totalViews: 0,
    topViewed: [],
})

async function loadHeatmap() {
    const res = await fetch('/dashboard/heatmap')
    const data = await res.json()

    // Heatmap data = [lat, lng, intensity]
    const heatData = data.map(g => [
        g.coordinates.lat,
        g.coordinates.lng,
        Math.log1p(g.view_count) // csillapított intenzitás
    ])

    stats.value.totalViews = data.reduce((acc, g) => acc + g.view_count, 0)
    stats.value.topViewed = [...data]
        .sort((a, b) => b.view_count - a.view_count)
        .slice(0, 5)

    if (heatLayer.value) heatLayer.value.remove()
    heatLayer.value = L.heatLayer(heatData, { radius: 25 }).addTo(map.value)

    loading.value = false
}

onMounted(() => {
    map.value = leaflet.map('heatmap', {
        center: [46.77, 23.60],
        zoom: 14,
        zoomControl: false,
    })
    leaflet
        .tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '© OpenStreetMap contributors',
        })
        .addTo(map.value)

    loadHeatmap()
})
</script>

<template>
    <Head title="Living Heritage Dashboard" />

    <AuthenticatedLayout>
        <div class="max-w-6xl mx-auto py-8 px-4 space-y-6">
            <h1 class="text-3xl font-semibold mb-4">Living Heritage Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold mb-2">Total Grave Views</h2>
                    <p class="text-4xl text-blue-700 font-bold">
                        {{ stats.totalViews.toLocaleString() }}
                    </p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 md:col-span-2">
                    <h2 class="text-lg font-semibold mb-2">Most Visited Graves</h2>
                    <ul class="divide-y">
                        <li v-for="grave in stats.topViewed" :key="grave.id" class="py-2">
                            <div class="flex justify-between">
                                <span>{{ grave.name }}</span>
                                <span class="font-semibold">{{ grave.view_count }} views</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                id="heatmap"
                class="rounded-lg shadow border border-gray-300"
                style="height: 600px"
            ></div>

            <div v-if="loading" class="text-gray-500 text-center mt-4">
                Loading heatmap data...
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
#heatmap {
    z-index: 0;
}
</style>
