<script setup>
import { onMounted, ref } from 'vue';
import { route } from "ziggy-js";
import { useForm, router, usePage } from '@inertiajs/vue3';
import leaflet from 'leaflet';
import "@geoman-io/leaflet-geoman-free";
import "@geoman-io/leaflet-geoman-free/dist/leaflet-geoman.css";
import InputError from "@/Components/InputError.vue";

const grave = usePage().props.grave;
const mapContainer = ref();
let map, drawnLayer = null;

const form = useForm({
    boundary: grave.boundary ?? null,
});

onMounted(() => {
    map = leaflet.map(mapContainer.value).setView([46.76, 23.59], 15);
    leaflet.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 22,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    map.pm.addControls({
        position: 'topleft',
        drawPolygon: true,
        drawCircleMarker: false,
        drawMarker: false,
        drawRectangle: false,
        drawPolyline: false,
        drawCircle: false,
        drawText: false,
        editMode: true,
        dragMode: true,
        removalMode: true
    });

    if (grave.boundary) {
        drawnLayer = leaflet.geoJSON(grave.boundary).addTo(map);
        map.fitBounds(drawnLayer.getBounds());
    }

    map.on('pm:create', e => {
        if (drawnLayer) map.removeLayer(drawnLayer);
        drawnLayer = e.layer;
    });

    map.on('pm:edit', e => {
        drawnLayer = e.layer;
    });

    map.on('pm:dragend', e => {
        drawnLayer = e.layer;
    });

    map.on('pm:remove', e => {
        drawnLayer = null;
    });
});

const saveBoundary = () => {
    if (!drawnLayer) {
        alert('Please draw a boundary first.');
        return;
    }

    const geojson = drawnLayer.toGeoJSON();
    if (geojson.geometry) {
        form.boundary = geojson.geometry;
    } else {
        form.boundary = geojson.features[0].geometry;
    }

    form.put(route('graves.update-boundary', grave.id), {
        onSuccess: () => router.visit(route('graves.index'))
    });
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-xl font-semibold mb-4">
            Edit boundary for {{ grave.name }}
        </h1>

        <div class="h-screen">
            <div ref="mapContainer" class="w-full h-4/5 rounded-md border"></div>

            <div class="mt-4">
                <InputError :message="form.errors.boundary"/>
            </div>

            <div class="mt-4">
                <button
                    @click="saveBoundary"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                    Save Boundary
                </button>
            </div>
        </div>
    </div>
</template>
