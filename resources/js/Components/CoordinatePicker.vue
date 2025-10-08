<script setup>
import { ref, watch } from "vue";
import L from "leaflet";
import "@geoman-io/leaflet-geoman-free";
import "@geoman-io/leaflet-geoman-free/dist/leaflet-geoman.css";

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    modelValue: {
        type: Object,
        required: true,
        default: () => ({
            type: "Point",
            coordinates: [null, null],
        }),
    },
});

const emit = defineEmits(["update:modelValue"]);

const showMap = ref(false);
let map;
let marker;

function toggleMap() {
    showMap.value = !showMap.value;
    if (showMap.value) {
        setTimeout(initMap, 150);
    }
}

function initMap() {
    if (map) return;

    map = L.map(`map-${props.label.replace(/\s+/g, "-").toLowerCase()}`).setView(
        [props.modelValue.coordinates[1] || 46.76, props.modelValue.coordinates[0] || 23.59],
        15
    );

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);

    if (props.modelValue.coordinates[0] && props.modelValue.coordinates[1]) {
        marker = L.marker([
            props.modelValue.coordinates[1],
            props.modelValue.coordinates[0],
        ]).addTo(map);
    }

    map.pm.addControls({
        position: "topleft",
        drawMarker: true,
        drawCircle: false,
        drawPolyline: false,
        drawRectangle: false,
        drawPolygon: false,
        drawCircleMarker: false,
        drawText: false,
        editMode: false,
        dragMode: false,
        cutPolygon: false,
        removalMode: true,
    });

    map.on("pm:create", (e) => {
        if (marker) map.removeLayer(marker);
        marker = e.layer;
        const { lat, lng } = marker.getLatLng();
        updateCoordinates(lat, lng);
    });

    map.on("pm:remove", () => {
        marker = null;
        updateCoordinates(null, null);
    });
}

function updateCoordinates(lat, lng) {
    emit("update:modelValue", {
        type: "Point",
        coordinates: [lng, lat],
    });
}

watch(
    () => props.modelValue,
    (newVal) => {
        if (map && marker && newVal.coordinates[0] && newVal.coordinates[1]) {
            marker.setLatLng([newVal.coordinates[1], newVal.coordinates[0]]);
        }
    },
    { deep: true }
);
</script>

<template>
    <div>
        <label class="block text-sm font-medium text-gray-700">{{ label }} (coordinates)</label>
        <div class="flex space-x-2 mt-1">
            <input
                type="text"
                placeholder="Latitude"
                :value="modelValue.coordinates[1]"
                @input="updateCoordinates($event.target.value, modelValue.coordinates[0])"
                class="block w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            />
            <input
                type="text"
                placeholder="Longitude"
                :value="modelValue.coordinates[0]"
                @input="updateCoordinates(modelValue.coordinates[1], $event.target.value)"
                class="block w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
            />
        </div>

        <button
            type="button"
            @click="toggleMap"
            class="mt-3 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
        >
            {{ showMap ? 'Hide map' : 'Select on map' }}
        </button>

        <div
            v-show="showMap"
            :id="`map-${label.replace(/\s+/g, '-').toLowerCase()}`"
            class="mt-4 h-80 w-full rounded-md border"
        ></div>
    </div>
</template>

<style scoped>
.leaflet-container {
    border-radius: 0.5rem;
}
</style>
