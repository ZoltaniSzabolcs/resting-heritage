<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';

import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const props = defineProps({
    cemetery: {
        type: Object,
        required: true,
    },
    persons: {
        type: [Array, Object],
        default: () => [],
    }
});

const cemData = computed(() => props.cemetery.data || props.cemetery);
const personList = computed(() => props.persons.data || props.persons);

const mapContainer = ref(null);

onMounted(() => {
    if (!mapContainer.value) return;

    const cem = cemData.value;

    let centerLat = 51.5668, centerLng = -0.1475;

    const parsePoint = (pointData) => {
        if (!pointData) return null;
        if (typeof pointData === 'string') {
            const parts = pointData.split(',');
            if (parts.length === 2) return [parseFloat(parts[0].trim()), parseFloat(parts[1].trim())];
        }
        if (typeof pointData === 'object' && pointData.coordinates) {
            return [pointData.coordinates[1], pointData.coordinates[0]]; // Leaflet [lat, lon]-t vár!
        }
        return null;
    };

    const centerCoords = parsePoint(cem.center) || [centerLat, centerLng];
    const entranceCoords = parsePoint(cem.entrance);

    const map = L.map(mapContainer.value, {
        zoomControl: false
    }).setView(centerCoords, 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        className: 'map-tiles-grayscale'
    }).addTo(map);

    const customIcon = L.divIcon({
        className: 'custom-map-marker',
        html: `<span class="material-symbols-outlined text-secondary text-5xl" style="font-variation-settings: 'FILL' 1; text-shadow: 0 4px 6px rgba(0,0,0,0.3);">location_on</span>`,
        iconSize: [48, 48],
        iconAnchor: [24, 48]
    });

    L.marker(centerCoords, { icon: customIcon }).addTo(map).bindPopup('<span class="font-label uppercase tracking-widest text-xs">Center Viewpoint</span>');

    if (entranceCoords) {
        L.marker(entranceCoords, { icon: customIcon }).addTo(map).bindPopup('<span class="font-label uppercase tracking-widest text-xs">Archive Entrance</span>');
    }

    if (cem.boundary) {
        try {
            const geoJson = typeof cem.boundary === 'string' ? JSON.parse(cem.boundary) : cem.boundary;

            if(geoJson && geoJson.coordinates) {
                L.geoJSON(geoJson, {
                    style: {
                        color: '#7e5f1f',
                        weight: 2,
                        fillColor: '#7e5f1f',
                        fillOpacity: 0.1
                    }
                }).addTo(map);
            }
        } catch (e) {
            console.warn("Nem sikerült feldolgozni a boundary adatot.", e);
        }
    }
});
</script>

<template>
    <Head :title="`${cemData.name} | Resting Heritage`" />

    <AuthenticatedLayout>

        <section class="relative w-full h-[870px] overflow-hidden flex items-end px-12 pb-20 -mt-24 pt-24">
            <div class="absolute inset-0 z-0 mt-24">
                <img :src="cemData.image_url || '/storage/SzekelyudvarhelyCemeteryReformatEntrance.png'"
                     :alt="cemData.name"
                     class="w-full h-full object-cover filter contrast-[1.05] brightness-90 sepia-[0.1]">
                <div class="absolute inset-0 bg-gradient-to-t from-[#38392b]/60 to-transparent"></div>
            </div>
            <div class="relative z-10 max-w-5xl">
                <div class="flex items-center gap-4 mb-6">
                    <span class="h-px w-12 bg-secondary"></span>
                    <span class="font-label text-white uppercase tracking-[0.3em] text-xs font-medium">Historical Sanctuary</span>
                </div>
                <h1 class="font-headline text-6xl md:text-8xl lg:text-9xl text-white tracking-tighter leading-none mb-4">
                    {{ cemData.name }}
                </h1>
                <p class="font-headline text-2xl italic text-white/90 font-light">
                    {{ cemData.city || 'Location Details Pending' }}
                </p>
            </div>
        </section>

        <section class="max-w-7xl mx-auto -mt-16 relative z-20 px-6">
            <div class="bg-surface-container p-10 shadow-sm border-l-8 border-secondary flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1">
                    <h3 class="font-headline text-2xl text-on-surface mb-2">Search the Registry</h3>
                    <p class="text-on-surface-variant font-light italic font-body">
                        Locate individuals, family plots, or architectural memorials within {{ cemData.name }}.
                    </p>
                </div>
                <div class="w-full md:w-1/2 flex border-b border-outline group focus-within:border-secondary transition-colors">
                    <input class="w-full bg-transparent py-4 focus:ring-0 border-none font-label text-sm placeholder:italic" placeholder="Enter name or plot number..." type="text"/>
                    <button class="px-4 text-secondary hover:text-primary transition-colors">
                        <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto mt-32 px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
                <div class="lg:col-span-7 space-y-12">
                    <div class="space-y-6">
                        <h2 class="font-headline text-4xl text-primary border-b border-outline-variant/15 pb-4">
                            Archival Documentation
                        </h2>
                        <div class="space-y-8 text-xl leading-relaxed text-on-surface/90 font-light font-body first-letter:text-7xl first-letter:font-headline first-letter:mr-3 first-letter:float-left first-letter:text-secondary whitespace-pre-wrap">
                            {{ cemData.description || 'The historical documentation for this site is currently being compiled by our dedicated archivists. Check back for comprehensive historical data.' }}
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5 space-y-16">
                    <div class="bg-surface-container p-8 space-y-8 shadow-sm">
                        <div>
                            <span class="font-label text-[10px] uppercase tracking-[0.4em] text-secondary font-semibold block mb-2">Designation</span>
                            <p class="font-headline text-xl">Historical Archive</p>
                        </div>
                        <div>
                            <span class="font-label text-[10px] uppercase tracking-[0.4em] text-secondary font-semibold block mb-2">City</span>
                            <p class="font-headline text-xl">{{ cemData.city || 'Unknown' }}</p>
                        </div>
                        <div class="pt-6 border-t border-outline-variant/20">
                            <button class="bg-secondary text-on-secondary px-8 py-4 w-full font-label text-sm tracking-widest uppercase hover:bg-tertiary transition-colors shadow-md">
                                Contribute Records
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto mt-40 px-6">
            <div class="mb-16">
                <span class="font-label text-[12px] uppercase tracking-[0.5em] text-secondary font-semibold block mb-4">Registry</span>
                <h2 class="font-headline text-5xl text-primary">The Departed</h2>
                <div class="w-24 h-1 bg-secondary mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12" v-if="personList.length > 0">
                <div v-for="person in personList" :key="person.id" class="bg-surface-container-low p-8 border border-outline-variant/30 flex flex-col gap-6 group hover:bg-surface-container transition-colors shadow-sm">
                    <div class="aspect-[4/5] w-full overflow-hidden grayscale group-hover:grayscale-0 transition-all duration-700 bg-surface flex items-center justify-center">
                        <img v-if="person.imageUrl" :src="person.imageUrl" :alt="person.lastName" class="w-full h-full object-cover" />

                        <div v-else class="flex flex-col items-center justify-center text-outline opacity-50">
                            <span class="material-symbols-outlined text-6xl mb-2">person_off</span>
                            <span class="font-label text-xs uppercase tracking-widest">No Portrait</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <span class="font-label text-[10px] uppercase tracking-widest text-secondary block">
                                {{ person.initials || `${person.firstName.charAt(0)}.${person.lastName.charAt(0)}.` }}
                            </span>
                            <h3 class="font-headline text-2xl text-on-surface line-clamp-1">
                                {{ person.firstName }} {{ person.lastName }}
                            </h3>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm font-light font-body">
                            <div>
                                <span class="block font-label text-[9px] uppercase tracking-wider text-outline mb-1">Lifespan</span>
                                <p class="font-headline italic">{{ person.birthDate ? new Date(person.birthDate).getFullYear() : '?' }} — {{ person.deathDate ? new Date(person.deathDate).getFullYear() : '?' }}</p>
                            </div>
                            <div>
                                <span class="block font-label text-[9px] uppercase tracking-wider text-outline mb-1">Grave ID</span>
                                <p class="font-headline">Plot {{ person.graveId || 'Unknown' }}</p>
                            </div>
                            <div>
                                <span class="block font-label text-[9px] uppercase tracking-wider text-outline mb-1">Birthplace</span>
                                <p class="font-headline italic line-clamp-1" :title="person.birthPlace">{{ person.birthPlace || 'Unknown' }}</p>
                            </div>
                            <div>
                                <span class="block font-label text-[9px] uppercase tracking-wider text-outline mb-1">Deathplace</span>
                                <p class="font-headline italic line-clamp-1" :title="person.deathPlace">{{ person.deathPlace || 'Unknown' }}</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-outline-variant/20">
                            <span class="block font-label text-[9px] uppercase tracking-wider text-outline mb-1">Occupation</span>
                            <p class="font-headline text-lg line-clamp-1">{{ person.occupation || 'Unrecorded' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-20 border border-dashed border-outline-variant/50">
                <span class="material-symbols-outlined text-4xl text-outline mb-2">history_edu</span>
                <p class="font-body italic text-on-surface-variant text-lg">No records have been digitized for this sanctuary yet.</p>
            </div>
        </section>

        <section class="mt-40 bg-surface-container-highest py-32 border-t border-outline/10">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-4 space-y-6">
                    <h2 class="font-headline text-4xl text-on-surface">Grounds & Boundaries</h2>
                    <p class="text-on-surface-variant leading-relaxed font-body">
                        The archival boundaries represent the protected historic park. The central viewpoint provides the architectural orientation for researchers.
                    </p>
                    <div class="space-y-4 pt-4">
                        <div class="bg-surface-container-low p-4 space-y-3 shadow-sm border border-outline/5">
                            <span class="font-label text-[10px] uppercase font-bold text-secondary tracking-widest block border-b border-outline-variant pb-1">Entrance Point</span>
                            <div class="flex justify-between items-center">
                                <span class="font-label text-xs uppercase font-medium">Lat / Long</span>
                                <span class="font-headline italic text-sm">{{ cemData.entrance ? cemData.entrance.coordinates[1].toString() + ", " + cemData.entrance.coordinates[0].toString() : 'Uncharted' }}</span>
                            </div>
                        </div>
                        <div class="bg-surface-container-low p-4 space-y-3 shadow-sm border border-outline/5">
                            <span class="font-label text-[10px] uppercase font-bold text-secondary tracking-widest block border-b border-outline-variant pb-1">Center Viewpoint</span>
                            <div class="flex justify-between items-center">
                                <span class="font-label text-xs uppercase font-medium">Orientation</span>
                                <span class="font-headline italic text-sm">{{ cemData.center ? cemData.center.coordinates[1].toString() + ", " + cemData.center.coordinates[0].toString() : 'Uncharted' }}</span>
                            </div>
                        </div>
                        <div class="bg-surface-container-low p-4 space-y-3 shadow-sm border border-outline/5">
                            <span class="font-label text-[10px] uppercase font-bold text-secondary tracking-widest block border-b border-outline-variant pb-1">Boundary Status</span>
                            <div class="flex justify-between items-center">
                                <span class="font-label text-xs uppercase font-medium">Type</span>
                                <span class="font-headline italic text-sm">{{ cemData.boundary ? 'Archived Polygon' : 'Pending' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8 h-[500px] w-full bg-surface relative group border border-outline-variant/30 shadow-inner p-2">

                    <div
                        ref="mapContainer"
                        class="w-full h-full z-10 relative bg-[#f0efdd]"
                        style="height: 500px"
                    ></div>

                    <div class="absolute inset-0 border-[20px] border-surface-container-highest z-20 pointer-events-none"></div>
                </div>
            </div>
        </section>

        <div class="fixed bottom-12 right-12 z-40" v-if="$page.props.auth.user">
            <Link :href="route('persons.create', { cemetery_id: cemData.id })" class="w-20 h-20 rounded-full bg-tertiary shadow-[0_12px_24px_rgba(0,0,0,0.15)] flex items-center justify-center group relative border-4 border-[#7d4d1e] hover:bg-secondary transition-colors">
                <div class="absolute inset-0 rounded-full border-t-2 border-white/20"></div>
                <span class="material-symbols-outlined text-white text-3xl transition-transform group-hover:scale-110" data-icon="person_add" style="font-variation-settings: 'FILL' 1;">person_add</span>
                <span class="absolute -top-12 right-0 bg-on-surface text-surface text-[10px] px-3 py-1 font-label uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-md pointer-events-none">
                    Add Record
                </span>
            </Link>
        </div>

    </AuthenticatedLayout>
</template>

<style>
/* Globális vagy scope-olt CSS a Leaflet térkép szürkeárnyalatossá tételéhez */
.map-tiles-grayscale {
    filter: grayscale(100%) contrast(110%) sepia(20%) opacity(80%);
}

.custom-map-marker {
    background: transparent;
    border: none;
}
</style>
