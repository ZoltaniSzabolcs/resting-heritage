<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    graves: {
        type: Object,
        required: true,
    },
    search: {
        type: String,
        default: '',
    }
});

// Keresési állapot
const searchQuery = ref(props.search);
const sortOption = ref('Date of Interment'); // Jövőbeli fejlesztéshez előkészítve

// Keresés figyelése késleltetéssel (Debounce)
let searchTimeout;
watch(searchQuery, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('graves.index'), { search: value }, {
            preserveState: true,
            preserveScroll: true,
            replace: true // Ne szemetelje tele a böngésző visszagomb-előzményeit
        });
    }, 300); // 300ms várás gépelés után
});

// Segédfüggvény a személyek előnézetének generálásához
const getPersonsPreview = (persons) => {
    if (!persons || persons.length === 0) return 'No interred individuals recorded.';
    const names = persons.map(p => `${p.firstName} ${p.lastName}`);
    if (names.length <= 2) return names.join(', ');
    return `${names[0]}, ${names[1]} and ${names.length - 2} more...`;
};
</script>

<template>
    <Head title="Graves Archive Directory | Resting Heritage" />

    <AuthenticatedLayout>
        <header class="pt-32 pb-20 px-8 md:px-20 bg-gradient-to-br from-primary to-primary-dim text-on-primary">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-end justify-between">
                <div class="w-full md:w-2/3">
                    <span class="font-label text-xs uppercase tracking-[0.3em] opacity-80 mb-4 block">The Global Repository</span>
                    <h1 class="font-headline text-5xl md:text-7xl font-bold tracking-tight leading-none mb-8">
                        GRAVES <br/><span class="italic font-normal">Archive Directory</span>
                    </h1>
                    <p class="font-body text-xl md:text-2xl max-w-xl opacity-90 leading-relaxed italic">
                        "Every record is a life's echo, preserved in the silence of the stone."
                    </p>
                </div>
                <div class="hidden md:block w-1/3 text-right">
                    <span class="font-label text-8xl opacity-10 font-bold select-none">1844</span>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-8 md:px-20 -mt-10 relative z-10">

            <div class="bg-surface-container-low p-8 shadow-sm flex flex-col md:flex-row gap-8 mb-20">
                <div class="flex-1 group">
                    <label class="font-label text-[10px] uppercase tracking-widest text-outline mb-1 block">Search Records</label>
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search by Grave Name or Identifier..."
                        class="w-full bg-transparent border-t-0 border-x-0 border-b border-outline/40 focus:ring-0 focus:border-secondary transition-colors py-2 font-body text-lg placeholder:text-outline/40"
                    />
                </div>
                <div class="w-full md:w-64">
                    <label class="font-label text-[10px] uppercase tracking-widest text-outline mb-1 block">Sort By</label>
                    <select v-model="sortOption" class="w-full bg-transparent border-t-0 border-x-0 border-b border-outline/40 focus:ring-0 focus:border-secondary transition-colors py-2 font-body text-lg appearance-none">
                        <option>Date of Interment</option>
                        <option>Alphabetical</option>
                    </select>
                </div>
                <button class="bg-secondary text-on-secondary px-10 py-4 font-label uppercase text-xs tracking-widest hover:bg-secondary-dim transition-colors self-end">
                    Search Archive
                </button>
            </div>

            <div class="mb-16 grid grid-cols-12 gap-4">
                <div class="col-start-1 col-span-12 md:col-start-2 md:col-span-10">
                    <h2 class="font-headline text-4xl tracking-widest uppercase mb-2">The Plot Registry</h2>
                    <div class="w-24 h-px bg-secondary opacity-50 mb-6"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-20 items-start">

                <template v-for="(grave, index) in graves.data" :key="grave.id">

                    <div v-if="index % 2 === 0" class="md:col-span-7 bg-surface-container p-0 overflow-hidden flex flex-col md:flex-row group transition-transform duration-700 hover:-translate-y-2 border border-outline/10 shadow-sm">
                        <div class="w-full md:w-1/2 aspect-square md:aspect-auto relative bg-surface-variant flex items-center justify-center">
                            <img v-if="grave.imageUrl" :src="grave.imageUrl" :alt="grave.name" class="w-full h-full object-cover filter sepia-[0.4] contrast-[1.1] grayscale-[0.2] opacity-80 group-hover:opacity-100 transition-opacity duration-500" />
                            <div v-else class="text-outline opacity-40 flex flex-col items-center">
                                <span class="material-symbols-outlined text-6xl mb-2 font-light">account_balance</span>
                                <span class="font-label text-[10px] tracking-widest uppercase">Image Unavailable</span>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 p-10 flex flex-col justify-between">
                            <div>
                                <span class="font-label text-[10px] uppercase tracking-widest text-secondary mb-2 block line-clamp-1">
                                    {{ grave.cemeteryName || 'Unknown Cemetery' }}
                                </span>
                                <h3 class="font-headline text-2xl font-bold mb-4 line-clamp-2">{{ grave.name }}</h3>
                                <p class="font-body text-on-surface-variant italic mb-2 line-clamp-2">
                                    {{ getPersonsPreview(grave.persons) }}
                                </p>
                                <p class="font-label text-[10px] uppercase tracking-widest text-outline">
                                    {{ grave.persons ? grave.persons.length : 0 }} Records Found
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-8">
                                <span class="font-label text-[10px] uppercase tracking-tighter opacity-60">
                                    {{ grave.location?.coordinates ? `${grave.location.coordinates[1].toFixed(4)}°N, ${grave.location.coordinates[0].toFixed(4)}°E` : 'Uncharted' }}
                                </span>
                                <Link :href="route('graves.show', grave.id)" class="text-secondary font-label text-[10px] uppercase tracking-widest border-b border-secondary/30 pb-1 hover:border-secondary transition-all">
                                    View Dossier
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div v-else class="md:col-span-5 bg-surface-container-high p-10 self-stretch flex flex-col relative group border border-outline/10 shadow-sm">
                        <div class="mb-8">
                            <span class="font-label text-[10px] uppercase tracking-widest text-secondary mb-2 block line-clamp-1">
                                {{ grave.cemeteryName || 'Unknown Cemetery' }}
                            </span>
                            <h3 class="font-headline text-2xl font-bold mb-2 tracking-tight">{{ grave.name }}</h3>
                            <p class="font-body text-on-surface-variant italic line-clamp-2">
                                {{ getPersonsPreview(grave.persons) }}
                            </p>
                        </div>
                        <div class="mt-auto">
                            <div class="w-full h-48 bg-surface-variant mb-6 overflow-hidden flex items-center justify-center">
                                <img v-if="grave.imageUrl" :src="grave.imageUrl" :alt="grave.name" class="w-full h-full object-cover grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500" />
                                <div v-else class="text-outline opacity-40 flex flex-col items-center">
                                    <span class="material-symbols-outlined text-4xl mb-2 font-light">account_balance</span>
                                    <span class="font-label text-[10px] tracking-widest uppercase">No Image</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-label text-[10px] uppercase tracking-widest opacity-60">
                                    {{ grave.persons && grave.persons.length > 0 ? 'Occupied' : 'Empty Plot' }}
                                </span>
                                <Link :href="route('graves.show', grave.id)" class="w-12 h-12 rounded-full bg-tertiary flex items-center justify-center text-on-tertiary shadow-[inset_-2px_-2px_4px_rgba(0,0,0,0.4),_0_4px_12px_rgba(0,0,0,0.2)] cursor-pointer hover:scale-105 transition-transform" title="View Dossier">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">book</span>
                                </Link>
                            </div>
                        </div>
                    </div>

                </template>

                <div v-if="graves.data.length === 0" class="col-span-12 text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-outline mb-4 opacity-50">search_off</span>
                    <h3 class="font-headline text-2xl text-on-surface">No Records Found</h3>
                    <p class="font-body italic text-on-surface-variant">Adjust your search parameters to explore the archives.</p>
                </div>
            </div>

            <div class="flex justify-center pb-20" v-if="graves.meta && graves.meta.last_page > 1">
                <div class="flex gap-2">
                    <Link v-for="link in graves.meta.links" :key="link.label" :href="link.url || '#'"
                          class="px-4 py-2 font-label text-xs uppercase tracking-widest border transition-colors"
                          :class="link.active ? 'bg-secondary text-white border-secondary' : 'bg-transparent text-on-surface border-outline/30 hover:border-secondary'"
                          v-html="link.label">
                    </Link>
                </div>
            </div>

        </main>

        <div class="fixed bottom-8 right-8 z-50" v-if="$page.props.auth.user">
            <Link :href="route('graves.create')" class="w-16 h-16 rounded-full bg-tertiary flex items-center justify-center text-on-tertiary shadow-[inset_-2px_-2px_4px_rgba(0,0,0,0.4),_0_4px_12px_rgba(0,0,0,0.2)] hover:scale-110 transition-transform active:scale-95 group">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">ink_pen</span>
                <div class="absolute right-20 bg-on-surface text-background px-4 py-2 font-label text-[10px] uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap shadow-md">
                    New Record
                </div>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
