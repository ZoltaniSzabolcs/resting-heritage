<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import L from "leaflet";
import "@geoman-io/leaflet-geoman-free";
import "@geoman-io/leaflet-geoman-free/dist/leaflet-geoman.css";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    grave: {
        type: Object,
        required: true,
    },
});

const grave = usePage().props.grave
const map = ref(null);
let marker = null;
let polygon = null;

onMounted(() => {
    const { location, boundary } = grave;

    map.value = L.map("graveMap").setView(
        location?.coordinates
            ? [location.coordinates[1], location.coordinates[0]]
            : [46.77, 23.60],
        17
    );

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map.value);

    if (location?.coordinates) {
        marker = L.marker([
            location.coordinates[1],
            location.coordinates[0],
        ]).addTo(map.value);
    }

    if (boundary?.coordinates?.[0]) {
        const latlngs = boundary.coordinates[0].map(([lon, lat]) => [lat, lon]);
        polygon = L.polygon(latlngs, {
            color: "#1d4ed8",
            weight: 2,
            fillColor: "#60a5fa",
            fillOpacity: 0.4,
        }).addTo(map.value);

        map.value.fitBounds(polygon.getBounds());
    }
});
</script>

<template>
    <Head :title="`Grave: ${grave.name}`"/>

    <AuthenticatedLayout>
        <div class="max-w-5xl mx-auto p-6">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li>
                        <Link :href="route('graves.index')" class="hover:text-blue-600"
                        >Graves
                        </Link
                        >
                    </li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-700 font-semibold">{{ grave.name }}</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-semibold">{{ grave.name }}</h1>

                <div class="space-x-2">
                    <Link
                        :href="route('graves.edit', grave.id)"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Edit
                    </Link>
                    <Link
                        :href="route('cemeteries.show', grave.cemetery_id)"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                    >
                        Cemetery
                    </Link>
                </div>
            </div>

            <!-- Map -->
            <div
                id="graveMap"
                class="rounded-lg shadow border border-gray-300"
                style="height: 500px"
            ></div>

            <!-- Info -->
            <div class="mt-6 bg-white p-6 rounded-lg shadow space-y-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Grave Details</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Cemetery ID:</span>
                        <span class="text-gray-900">{{ grave.cemetery_id }}</span>
                    </div>
                    <br>
                    <div>
                        <span class="font-medium text-gray-700">Latitude:</span>
                        <span class="text-gray-900">{{
                                grave.location?.coordinates?.[1]?.toFixed(6)
                            }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Longitude:</span>
                        <span class="text-gray-900">{{
                                grave.location?.coordinates?.[0]?.toFixed(6)
                            }}</span>
                    </div>
                </div>
            </div>

            <!-- Persons Info Section -->
            <div v-if="grave.persons && grave.persons.length" class="mt-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Buried Person(s)</h2>

                <div
                    v-for="person in grave.persons"
                    :key="person.id"
                    class="bg-gray-50 rounded-lg p-4 mb-4 shadow-sm flex gap-4 items-start"
                >
                    <!-- Person Image -->
                    <img
                        :src="person.image_url || '../../../../public/storage/default-avatar.jpg'"
                        class="w-24 h-24 object-cover rounded-md shadow bg-[url(/public/storage/default-avatar2.jpg)]"
                    />

                    <!-- Person Info -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ person.initials }} {{ person.last_name }} {{ person.first_name }}
                        </h3>

                        <p class="text-sm text-gray-700">
                            <span v-if="person.birth_date">{{ new Date(person.birth_date).toLocaleDateString() }}</span>
                            –
                            <span v-if="person.death_date">{{ new Date(person.death_date).toLocaleDateString() }}</span>
                        </p>

                        <p class="text-sm text-gray-600 mt-1">
                            <span v-if="person.birth_place">Born in {{ person.birth_place }}</span>
                            <span v-if="person.death_place">, Died in {{ person.death_place }}</span>
                        </p>

                        <p v-if="person.occupation" class="text-sm text-gray-800 mt-2 font-medium">
                            Occupation: {{ person.occupation }}
                        </p>

                        <p v-if="person.biography" class="text-sm text-gray-700 mt-2 leading-snug">
                            {{ person.biography }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
