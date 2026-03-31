<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    persons: {
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

// Keresés figyelése késleltetéssel (Debounce)
let searchTimeout;
watch(searchQuery, (value) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(route('persons.index'), { search: value }, {
            preserveState: true,
            preserveScroll: true,
            replace: true
        });
    }, 300);
});

// Évszám kinyerő segédfüggvény
const getYear = (dateString) => {
    if (!dateString) return 'Unknown';
    return new Date(dateString).getFullYear();
};

// Dinamikus monogram generátor a kép nélküli kártyákhoz
const getMonogram = (firstName, lastName, initials) => {
    if (initials) return initials.replace(/\./g, '').substring(0, 2).toUpperCase();
    return `${firstName?.charAt(0) || ''}${lastName?.charAt(0) || ''}`.toUpperCase();
};
</script>

<template>
    <Head title="The Departed Archive | Resting Heritage" />

    <AuthenticatedLayout>
        <header class="pt-32 pb-20 px-8 md:px-20 bg-gradient-to-br from-primary to-primary-dim text-on-primary border-b border-outline/10">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-end justify-between">
                <div class="w-full md:w-2/3">
                    <span class="font-label text-xs uppercase tracking-[0.3em] opacity-80 mb-4 block">The Global Repository</span>
                    <h1 class="font-headline text-5xl md:text-7xl font-bold tracking-tight leading-none mb-8">
                        THE DEPARTED <br/><span class="italic font-normal">Civil Registry</span>
                    </h1>
                    <p class="font-body text-xl md:text-2xl max-w-xl opacity-90 leading-relaxed italic">
                        "Tracing the quiet echoes of those who walked before us. A living directory of souls preserved within the vellum of digital history."
                    </p>
                </div>
                <div class="hidden md:block w-1/3 text-right">
                    <span class="font-label text-8xl opacity-10 font-bold select-none">1844</span>
                </div>
            </div>
        </header>

        <main class="min-h-screen pb-24">

            <section class="max-w-7xl mx-auto px-6 mb-20 -mt-8 relative z-10">
                <div class="bg-surface-container-low p-8 md:p-12 flex flex-col md:flex-row gap-8 lg:gap-12 items-end shadow-sm border border-outline/10">
                    <div class="flex-1 w-full group">
                        <label class="font-label text-xs uppercase tracking-widest text-outline mb-2 block">Deceased Name</label>
                        <input v-model="searchQuery"
                               class="w-full bg-transparent border-0 border-b border-outline/40 focus:ring-0 focus:border-secondary py-3 text-lg font-body outline-none transition-all placeholder:italic"
                               placeholder="Search by name or initials..." type="text"/>
                    </div>

                    <div class="flex-1 w-full group opacity-50 cursor-not-allowed">
                        <label class="font-label text-xs uppercase tracking-widest text-outline mb-2 block">Occupation</label>
                        <input disabled class="w-full bg-transparent border-0 border-b border-outline/40 focus:ring-0 py-3 text-lg font-body outline-none transition-all cursor-not-allowed" placeholder="Botanist, Archivist..." type="text"/>
                    </div>
                    <div class="flex-1 w-full group opacity-50 cursor-not-allowed">
                        <label class="font-label text-xs uppercase tracking-widest text-outline mb-2 block">Location</label>
                        <input disabled class="w-full bg-transparent border-0 border-b border-outline/40 focus:ring-0 py-3 text-lg font-body outline-none transition-all cursor-not-allowed" placeholder="Cemetery Name..." type="text"/>
                    </div>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 items-start" v-if="persons.data.length > 0">

                    <article v-for="(person, index) in persons.data" :key="person.id"
                             class="bg-surface-container p-4 transition-all hover:bg-surface-container-highest group border border-outline/5 shadow-sm"
                             :class="{'lg:translate-y-12': index % 3 === 0, 'lg:translate-y-24': index % 3 === 2}">
                        <div class="aspect-[3/4] overflow-hidden mb-8 relative bg-surface-container-highest flex items-center justify-center">

                            <img v-if="person.imageUrl"
                                 :src="person.imageUrl"
                                 :alt="person.lastName"
                                 class="w-full h-full object-cover sepia-filter grayscale transition-transform duration-700 group-hover:scale-105" />

                            <div v-else class="w-full h-full flex items-center justify-center relative">
                                <div class="text-outline-variant/40 font-headline text-8xl select-none">
                                    {{ getMonogram(person.firstName, person.lastName, person.initials) }}
                                </div>
                                <div class="absolute inset-0 border-[24px] border-surface-container/30"></div>
                                <div class="absolute bottom-4 right-4 font-label text-[10px] uppercase tracking-widest text-outline bg-surface/80 px-2 py-1">
                                    Unarchived Portrait
                                </div>
                            </div>

                            <div class="absolute inset-0 bg-secondary/5 pointer-events-none"></div>
                        </div>

                        <div class="px-4 pb-4">
                            <p class="font-label text-[10px] uppercase tracking-[0.4em] text-secondary mb-3 line-clamp-1" :title="person.occupation">
                                {{ person.occupation || 'Unrecorded Profession' }}
                            </p>
                            <h2 class="font-headline text-3xl mb-1 text-on-surface line-clamp-1">
                                {{ person.firstName }} {{ person.lastName }}
                            </h2>
                            <p class="font-body italic text-outline mb-6">
                                {{ getYear(person.birthDate) }} — {{ getYear(person.deathDate) }}
                            </p>
                            <div class="flex items-center text-sm text-on-surface-variant font-body mb-8 line-clamp-1">
                                <span class="material-symbols-outlined text-base mr-2" style="font-variation-settings: 'FILL' 1;">location_on</span>
                                {{ person.cemeteryName || 'Unknown Location' }}
                            </div>

                            <Link :href="route('persons.show', person.id)" class="inline-flex items-center font-label text-xs uppercase tracking-widest text-on-surface border-b border-secondary pb-1 group-hover:text-secondary transition-colors">
                                Open Dossier
                                <span class="material-symbols-outlined text-sm ml-2">chevron_right</span>
                            </Link>
                        </div>
                    </article>
                </div>

                <div v-else class="text-center py-32">
                    <span class="material-symbols-outlined text-6xl text-outline mb-4 opacity-50">search_off</span>
                    <h3 class="font-headline text-3xl text-on-surface mb-2">No Records Found</h3>
                    <p class="font-body italic text-on-surface-variant text-lg">The archives do not contain any matches for your query.</p>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-6 mt-32 text-center" v-if="persons.meta && persons.meta.last_page > 1">
                <div class="flex justify-center gap-2">
                    <Link v-for="link in persons.meta.links" :key="link.label" :href="link.url || '#'"
                          class="px-4 py-2 font-label text-xs uppercase tracking-widest border transition-colors"
                          :class="link.active ? 'bg-secondary text-white border-secondary' : 'bg-transparent text-on-surface border-outline/30 hover:border-secondary'"
                          v-html="link.label">
                    </Link>
                </div>
            </section>

        </main>

        <div class="fixed bottom-12 right-12 z-50" v-if="$page.props.auth.user">
            <Link :href="route('persons.create')" class="w-16 h-16 rounded-full bg-tertiary flex items-center justify-center text-on-tertiary shadow-[inset_-2px_-2px_4px_rgba(0,0,0,0.4),_inset_2px_2px_4px_rgba(255,255,255,0.1),_0_8px_24px_rgba(56,57,43,0.25)] hover:scale-110 transition-transform active:scale-95 group">
                <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">ink_pen</span>
                <div class="absolute right-20 bg-on-surface text-background px-4 py-2 font-label text-[10px] uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap shadow-xl">
                    New Record
                </div>
            </Link>
        </div>

    </AuthenticatedLayout>
</template>

<style scoped>
.sepia-filter {
    filter: sepia(0.5) contrast(1.05) grayscale(0.3);
}
</style>
