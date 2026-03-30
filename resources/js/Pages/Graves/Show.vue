<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';

import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const props = defineProps({
    grave: {
        type: Object,
        required: true,
    }
});

const graveData = computed(() => props.grave.data || props.grave);

const mapContainer = ref(null);

const getYear = (dateString) => {
    if (!dateString) return 'Unknown';
    return new Date(dateString).getFullYear();
};

onMounted(() => {
    if (!mapContainer.value) return;

    let mapCenter = [46.77, 23.60];

    if (graveData.value.location?.coordinates) {
        mapCenter = [
            graveData.value.location.coordinates[1], // Latitude
            graveData.value.location.coordinates[0]  // Longitude
        ];
    }

    const map = L.map(mapContainer.value, {
        zoomControl: false
    }).setView(mapCenter, 18);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        className: 'map-tiles-grayscale'
    }).addTo(map);

    const customIcon = L.divIcon({
        className: 'custom-map-marker',
        html: `<span class="material-symbols-outlined text-secondary text-5xl" style="font-variation-settings: 'FILL' 1; text-shadow: 0 4px 6px rgba(0,0,0,0.3);">location_on</span>`,
        iconSize: [48, 48],
        iconAnchor: [24, 48]
    });

    if (graveData.value.location?.coordinates) {
        L.marker(mapCenter, { icon: customIcon }).addTo(map);
    }

    if (graveData.value.boundary?.coordinates?.[0]) {
        const latlngs = graveData.value.boundary.coordinates[0].map(
            ([lng, lat]) => [lat, lng]
        );

        const polygon = L.polygon(latlngs, {
            color: "#7e5f1f", // Secondary szín
            weight: 2,
            fillColor: "#7e5f1f",
            fillOpacity: 0.2,
        }).addTo(map);

        map.fitBounds(polygon.getBounds(), { padding: [20, 20] });
    }
});
</script>

<template>
    <Head :title="`${graveData.name} | Resting Heritage`" />

    <AuthenticatedLayout>

        <section class="relative h-[500px] md:h-[614px] flex flex-col justify-center px-6 md:px-12 lg:px-24 bg-surface-container-low border-b border-outline-variant/10 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="../../../../public/storage/gravestone2.jpg"
                     alt="Grave Background"
                     class="w-full h-full object-cover grayscale-[50%] brightness-[0.4] sepia-[0.2]">
                <div class="absolute inset-0 paper-texture opacity-20 mix-blend-overlay"></div>
            </div>

            <div class="relative z-10 max-w-4xl space-y-4">
                <nav class="flex items-center gap-2 text-surface-container-highest font-label text-xs md:text-sm uppercase tracking-[0.2em] mb-4">
                    <span>Located within:
                        <Link :href="route('cemeteries.show', graveData.cemeteryId)" class="text-secondary hover:text-white transition-colors">
                            {{ graveData.cemeteryName || 'Unknown Cemetery' }}
                        </Link>
                    </span>
                </nav>
                <h1 class="font-headline text-5xl md:text-7xl lg:text-8xl text-white tracking-tighter leading-none drop-shadow-md">
                    {{ graveData.name }}
                </h1>
                <div class="pt-6">
                    <span class="font-label text-[10px] text-surface-container-highest tracking-widest uppercase block mb-1">Archival ID</span>
                    <span class="font-mono text-xs md:text-sm tracking-widest text-white opacity-60">{{ graveData.id }}</span>
                </div>
            </div>

            <div class="absolute right-0 bottom-0 w-1/3 h-full opacity-10 pointer-events-none z-0">
                <svg class="w-full h-full" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,77.4,-44.7C85.5,-31.3,90.7,-15.7,89.7,-0.6C88.6,14.5,81.4,29,71.5,41.2C61.6,53.4,49,63.2,35,69.8C21,76.4,5.5,79.8,-10.1,78.2C-25.7,76.5,-41.4,69.8,-54.6,59.3C-67.8,48.8,-78.5,34.5,-82.9,18.5C-87.3,2.5,-85.4,-15.2,-77.8,-30.7C-70.2,-46.2,-56.9,-59.5,-42,-66.2C-27.1,-72.9,-10.6,-73,2.6,-77.5C15.8,-82.1,31.4,-83.6,44.7,-76.4Z" fill="#ffffff" transform="translate(100 100)"></path>
                </svg>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 min-h-[500px]">
            <div class="bg-surface-container p-12 lg:p-24 flex flex-col justify-center space-y-12">
                <div class="space-y-8">
                    <div class="border-l-2 border-secondary/30 pl-6 py-2">
                        <label class="font-label text-xs uppercase tracking-widest text-outline block mb-2">Latitude</label>
                        <p class="font-headline text-2xl text-on-surface">
                            {{ graveData.location?.coordinates ? graveData.location.coordinates[1].toFixed(6) + '° N' : 'Uncharted' }}
                        </p>
                    </div>
                    <div class="border-l-2 border-secondary/30 pl-6 py-2">
                        <label class="font-label text-xs uppercase tracking-widest text-outline block mb-2">Longitude</label>
                        <p class="font-headline text-2xl text-on-surface">
                            {{ graveData.location?.coordinates ? graveData.location.coordinates[0].toFixed(6) + '° E' : 'Uncharted' }}
                        </p>
                    </div>
                    <div class="border-l-2 border-secondary/30 pl-6 py-2">
                        <label class="font-label text-xs uppercase tracking-widest text-outline block mb-2">Boundary Status</label>
                        <div class="flex items-center gap-2">
                            <span v-if="graveData.boundary" class="font-headline text-2xl text-on-surface">Verified Polygon</span>
                            <span v-else class="font-headline text-2xl text-on-surface-variant italic">Pending Verification</span>

                            <span v-if="graveData.boundary" class="material-symbols-outlined text-primary text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative bg-surface-dim overflow-hidden group min-h-[400px]">
                <div ref="mapContainer" class="absolute inset-0 z-10 bg-[#e5e4cd]"></div>

                <div class="absolute inset-0 bg-primary/5 pointer-events-none z-20"></div>

                <div class="absolute bottom-8 left-8 bg-surface/90 backdrop-blur px-4 py-2 text-[10px] font-label uppercase tracking-widest border border-outline-variant/20 z-30 pointer-events-none shadow-sm">
                    Geospatial Record
                </div>
            </div>
        </section>

        <section class="py-24 px-6 md:px-12 lg:px-24 bg-surface border-t border-outline/10">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-16 gap-6">
                <h2 class="font-headline text-4xl text-on-surface flex items-center gap-4 flex-grow">
                    Interred Individuals
                    <span class="hidden md:block h-px flex-grow bg-outline-variant/30 ml-4"></span>
                </h2>

                <Link v-if="$page.props.auth.user" :href="route('persons.create', { grave_id: graveData.id })" class="shrink-0 border border-secondary text-secondary px-6 py-2 font-label text-xs uppercase tracking-widest hover:bg-secondary hover:text-white transition-colors">
                    + Add Record
                </Link>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24" v-if="graveData.persons && graveData.persons.length > 0">

                <article v-for="(person, index) in graveData.persons" :key="person.id"
                         class="flex flex-col sm:flex-row gap-8 items-start"
                         :class="{'lg:translate-y-12': index % 2 !== 0}"> <div class="w-full sm:w-48 aspect-[3/4] bg-surface-container-highest overflow-hidden relative shadow-md shrink-0 flex items-center justify-center">
                    <img v-if="person.imageUrl"
                         :src="person.imageUrl"
                         :alt="person.lastName"
                         class="w-full h-full object-cover grayscale sepia-[0.3]" />

                    <div v-else class="flex flex-col items-center justify-center opacity-30 text-outline">
                        <span class="material-symbols-outlined text-6xl">person</span>
                    </div>
                </div>

                    <div class="flex-1 space-y-4">
                        <div>
                            <h3 class="font-headline text-3xl text-on-surface line-clamp-1">
                                {{ person.firstName }} {{ person.lastName }}
                            </h3>
                            <p class="font-body italic text-secondary-dim text-lg">
                                {{ getYear(person.birthDate) }} - {{ getYear(person.deathDate) }}
                            </p>
                        </div>
                        <div class="pt-2">
                            <label class="font-label text-[10px] uppercase tracking-widest text-outline block mb-1">Occupation</label>
                            <p class="font-body text-on-surface-variant line-clamp-2">
                                {{ person.occupation || 'Unrecorded' }}
                            </p>
                        </div>
                        <Link :href="route('persons.show', person.id)" class="inline-block pt-4 text-on-surface font-label text-xs uppercase tracking-widest border-b border-secondary pb-1 hover:text-secondary transition-colors">
                            View Full Dossier
                        </Link>
                    </div>
                </article>

            </div>

            <div v-else class="text-center py-12">
                <p class="font-body text-xl italic text-on-surface-variant">The archival records for individuals in this plot are currently empty.</p>
            </div>
        </section>

        <Link v-if="$page.props.auth.user" :href="route('graves.edit', graveData.id)" class="fixed bottom-12 right-12 w-20 h-20 rounded-full bg-tertiary text-on-tertiary flex items-center justify-center flex-col group wax-seal-shadow transition-transform hover:scale-105 active:scale-95 z-50 cursor-pointer">
            <span class="material-symbols-outlined text-3xl mb-0.5" style="font-variation-settings: 'FILL' 1;">edit_square</span>
            <span class="font-label text-[8px] uppercase tracking-tighter leading-tight text-center px-2">Edit Grave</span>
            <div class="absolute inset-0 border-4 border-black/10 rounded-full"></div>
        </Link>

    </AuthenticatedLayout>
</template>

<style scoped>
/* Térkép Szürkeárnyalat */
:deep(.map-tiles-grayscale) {
    filter: grayscale(100%) contrast(110%) sepia(20%) opacity(80%);
}

:deep(.custom-map-marker) {
    background: transparent;
    border: none;
}

.wax-seal-shadow {
    box-shadow: inset -2px -2px 4px rgba(0, 0, 0, 0.4), 2px 2px 6px rgba(0, 0, 0, 0.3);
}

.paper-texture {
    /* Base64 kódolt textúra a külső URL helyett a stabil működésért */
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
}
</style>
