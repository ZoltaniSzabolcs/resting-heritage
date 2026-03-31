<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    cemeteries: {
        type: [Array, Object],
        required: true,
    }
});

// Lekezeljük, ha a backend Paginatort küld (cemeteries.data), vagy sima tömböt
const cemeteryList = computed(() => props.cemeteries.data || props.cemeteries);

// Szűrő mezők (későbbi funkciókhoz előkészítve)
const searchLocation = ref('');
const searchEra = ref('All Eras');
const searchType = ref('All Types');
</script>

<template>
    <Head title="Cemeteries Archive | Resting Heritage" />

    <AuthenticatedLayout>
        <div class="min-h-screen">
            <section class="pt-32 pb-20 px-6 lg:px-12">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col md:flex-row items-end gap-12">
                        <div class="w-full md:w-1/2">
                            <h1 class="font-headline text-5xl md:text-6xl lg:text-8xl font-light tracking-tight leading-none mb-8">
                                The Resting <br/><span class="italic text-secondary">Grounds</span>
                            </h1>
                            <p class="font-body text-xl md:text-2xl text-on-surface-variant max-w-md leading-relaxed">
                                A curated directory of historical sanctuaries, preserving the silent narratives of our shared past.
                            </p>
                        </div>
                        <div class="w-full md:w-1/2 overflow-hidden">
                            <div class="aspect-[4/5] bg-surface-container relative">
                                <img src="../../../../public/storage/SzekelyudvarhelyCemeteryReformatEntrance.png" alt="Székelyudvarhely Reformat Cemetery Entrance" class="w-full h-full object-cover grayscale-[40%] contrast-[110%]"/>
                                <div class="absolute bottom-0 left-0 p-6 md:p-8 bg-surface/90 backdrop-blur-sm">
                                    <span class="font-label text-xs uppercase tracking-widest block mb-2 text-secondary">Featured Location</span>
                                    <span class="font-headline text-xl">Székelyudvarhely, Romania</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-12 px-6 lg:px-12 sticky top-20 z-40">
                <div class="max-w-7xl mx-auto bg-surface-container-low/95 backdrop-blur-md p-6 flex flex-wrap items-center justify-between gap-8 border border-outline/10 shadow-sm">
                    <div class="flex flex-col md:flex-row items-center gap-6 lg:gap-12 flex-1 w-full">
                        <div class="group relative flex-1 w-full">
                            <label class="font-label text-[10px] uppercase tracking-widest text-outline mb-1 block">Location</label>
                            <input v-model="searchLocation" class="w-full bg-transparent border-b border-outline/40 focus:border-secondary transition-colors py-2 font-body text-lg focus:ring-0 outline-none" placeholder="City or Region..." type="text"/>
                        </div>
                        <div class="group relative w-full md:w-48">
                            <label class="font-label text-[10px] uppercase tracking-widest text-outline mb-1 block">Era</label>
                            <select v-model="searchEra" class="w-full bg-transparent border-b border-outline/40 focus:border-secondary transition-colors py-2 font-body text-lg appearance-none focus:ring-0 outline-none cursor-pointer">
                                <option>All Eras</option>
                                <option>Victorian</option>
                                <option>Colonial</option>
                                <option>Medieval</option>
                            </select>
                        </div>
                        <div class="group relative w-full md:w-48">
                            <label class="font-label text-[10px] uppercase tracking-widest text-outline mb-1 block">Type</label>
                            <select v-model="searchType" class="w-full bg-transparent border-b border-outline/40 focus:border-secondary transition-colors py-2 font-body text-lg appearance-none focus:ring-0 outline-none cursor-pointer">
                                <option>All Types</option>
                                <option>Botanical</option>
                                <option>Churchyard</option>
                                <option>Military</option>
                            </select>
                        </div>
                    </div>
                    <button class="bg-secondary text-on-secondary px-10 py-4 font-label text-sm uppercase tracking-widest hover:bg-secondary-dim transition-colors w-full md:w-auto">
                        Filter Archive
                    </button>
                </div>
            </section>

            <section class="py-20 px-6 lg:px-12">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-24">

                    <div v-for="(cemetery, index) in cemeteryList" :key="cemetery.id"
                         class="group cursor-pointer"
                         :class="{'md:mt-24': index % 2 !== 0}"> <div class="aspect-[16/9] mb-8 relative overflow-hidden bg-surface-container-highest border border-outline/10 shadow-sm group-hover:shadow-md transition-shadow">

                        <img v-if="cemetery.image_url" :src="cemetery.image_url" :alt="cemetery.name" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 grayscale-[20%]"/>

                        <div v-else class="w-full h-full flex flex-col items-center justify-center bg-surface-variant text-outline transition-transform duration-700 group-hover:scale-105">
                            <span class="material-symbols-outlined text-4xl mb-2" data-icon="account_balance">account_balance</span>
                            <span class="font-label text-xs uppercase tracking-widest">Image Unavailable</span>
                        </div>

                        <div class="absolute top-4 right-4 bg-tertiary/90 w-10 h-10 flex items-center justify-center text-on-tertiary shadow-sm">
                            <span class="material-symbols-outlined text-sm" data-icon="bookmark" data-weight="fill">bookmark</span>
                        </div>
                    </div>

                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="font-label text-[10px] uppercase tracking-[0.2em] text-secondary mb-2 block">
                                    {{ cemetery.city || 'Unknown Location' }}
                                </span>
                                <h3 class="font-headline text-3xl md:text-4xl font-light group-hover:text-secondary transition-colors">
                                    {{ cemetery.name }}
                                </h3>
                            </div>
                            <span class="font-body italic text-outline mt-1 text-right">
                                Archive
                            </span>
                        </div>

                        <p class="font-body text-lg leading-relaxed text-on-surface-variant max-w-md line-clamp-3">
                            {{ cemetery.description || 'No description available for this historical site yet. Further documentation is required.' }}
                        </p>

                        <div class="mt-6">
                            <Link :href="route('cemeteries.show', cemetery.id)" class="font-body text-sm text-on-surface border-b border-secondary/40 hover:border-secondary pb-1 transition-all">
                                Explore Documentation
                            </Link>
                        </div>
                    </div>

                </div>

                <div v-if="cemeteryList.length === 0" class="text-center py-20 text-on-surface-variant">
                    <span class="material-symbols-outlined text-6xl mb-4 opacity-50" data-icon="auto_stories">auto_stories</span>
                    <h3 class="font-headline text-2xl">The archive is currently empty.</h3>
                    <p class="font-body italic">No cemeteries have been documented yet.</p>
                </div>
            </section>

            <div v-if="cemeteryList.length > 0" class="py-20 flex justify-center">
                <button class="group flex flex-col items-center">
                    <span class="font-label text-[10px] uppercase tracking-[0.3em] text-outline mb-4 group-hover:text-secondary transition-colors">Continue Exploration</span>
                    <span class="material-symbols-outlined text-4xl text-secondary animate-bounce" data-icon="keyboard_double_arrow_down">keyboard_double_arrow_down</span>
                </button>
            </div>
        </div>

        <div class="fixed bottom-32 right-12 z-50"> <Link :href="route('cemeteries.create')" class="w-16 h-16 rounded-full bg-secondary shadow-[0_10px_20px_rgba(140,89,41,0.2)] flex items-center justify-center text-on-secondary relative group transition-colors hover:bg-tertiary">
            <div class="absolute inset-0 border-2 border-white/20 rounded-full scale-90 group-hover:scale-100 transition-transform"></div>
            <span class="material-symbols-outlined text-3xl" data-icon="add_location_alt" data-weight="fill">add_location_alt</span>
            <span class="absolute right-20 bg-surface px-4 py-2 font-label text-xs uppercase tracking-widest text-on-surface opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap shadow-sm border border-outline-variant/15 pointer-events-none">
                    Document Cemetery
                </span>
        </Link>
        </div>
    </AuthenticatedLayout>
</template>
