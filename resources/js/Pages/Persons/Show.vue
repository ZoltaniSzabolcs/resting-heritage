<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    person: {
        type: Object,
        required: true,
    }
});

const personData = computed(() => props.person.data || props.person);

const fullName = computed(() => {
    const initials = personData.value.initials ? ` ${personData.value.initials} ` : ' ';
    return `${personData.value.firstName}${initials}${personData.value.lastName}`;
});

const getYear = (dateString) => {
    if (!dateString) return 'Unknown';
    return new Date(dateString).getFullYear();
};
</script>

<template>
    <Head :title="`Memorial Profile | ${fullName} | Resting Heritage`" />

    <AuthenticatedLayout>

        <div class="max-w-7xl mx-auto px-6 md:px-12 pt-12 pb-4">
            <nav class="font-label text-xs uppercase tracking-widest text-outline flex flex-wrap items-center gap-2">
                <Link v-if="personData.cemeteryId" :href="route('cemeteries.show', personData.cemeteryId)" class="hover:text-secondary transition-colors">
                    {{ personData.cemeteryName || 'Archive' }}
                </Link>
                <span v-if="personData.cemeteryId">/</span>
                <Link v-if="personData.graveId" :href="route('graves.show', personData.graveId)" class="hover:text-secondary transition-colors">
                    {{ personData.graveName || 'Grave' }}
                </Link>
                <span v-if="personData.graveId">/</span>
                <span class="text-secondary font-semibold">Memorial Profile</span>
            </nav>
        </div>

        <section class="max-w-7xl mx-auto px-6 md:px-12 pt-8 grid grid-cols-1 md:grid-cols-12 gap-16 items-start">

            <div class="md:col-span-5 relative group">
                <div class="aspect-[3/4] bg-surface-container-highest overflow-hidden editorial-shadow relative z-10 flex items-center justify-center">
                    <img v-if="personData.imageUrl"
                         :src="personData.imageUrl"
                         :alt="fullName"
                         class="w-full h-full object-cover grayscale brightness-90 contrast-110 group-hover:grayscale-0 transition-all duration-700" />

                    <div v-else class="flex flex-col items-center justify-center text-outline opacity-40">
                        <span class="material-symbols-outlined text-8xl mb-4 font-light">account_box</span>
                        <span class="font-label text-xs uppercase tracking-widest">Portrait Unarchived</span>
                    </div>
                </div>
                <div class="absolute -bottom-8 -left-8 w-24 h-24 md:w-32 md:h-32 bg-surface-container border border-outline-variant/15 flex items-center justify-center -z-0">
                    <span class="font-label text-[10px] md:text-xs uppercase tracking-[0.3em] opacity-40 rotate-90 whitespace-nowrap">
                        Record No. {{ String(personData.id).padStart(4, '0') }}
                    </span>
                </div>
            </div>

            <div class="md:col-span-7 flex flex-col pt-12 z-10 relative">
                <span class="font-label text-xs uppercase tracking-[0.5em] text-secondary mb-6 block">Deceased Archive</span>

                <h1 class="font-headline text-5xl md:text-7xl lg:text-8xl font-light tracking-tight text-on-surface mb-4 leading-none break-words">
                    {{ fullName }}
                </h1>

                <div class="flex flex-wrap items-baseline gap-4 mb-12">
                    <p class="font-body italic text-2xl md:text-3xl text-on-surface-variant">
                        {{ getYear(personData.birthDate) }} — {{ getYear(personData.deathDate) }}
                    </p>
                    <span v-if="personData.occupation" class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-secondary/30"></span>
                    <p v-if="personData.occupation" class="font-label text-xs md:text-sm uppercase tracking-widest text-primary">
                        {{ personData.occupation }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 border-t border-outline-variant/20 pt-12">
                    <div>
                        <span class="font-label text-[10px] uppercase tracking-widest text-outline mb-2 block">Birth Place</span>
                        <p class="font-body text-xl">{{ personData.birthPlace || 'Unrecorded in Archives' }}</p>
                    </div>
                    <div>
                        <span class="font-label text-[10px] uppercase tracking-widest text-outline mb-2 block">Death Place</span>
                        <p class="font-body text-xl">{{ personData.deathPlace || 'Unrecorded in Archives' }}</p>
                    </div>
                </div>

                <div class="mt-16" v-if="$page.props.auth.user">
                    <Link :href="route('persons.edit', personData.id)" class="inline-block bg-secondary text-on-secondary px-8 py-4 font-label text-xs uppercase tracking-widest hover:bg-secondary-dim transition-all duration-300">
                        Edit Archive Record
                    </Link>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 md:px-12 py-24 md:py-32 grid grid-cols-1 md:grid-cols-12 gap-16">
            <div class="md:col-start-4 md:col-span-6">
                <h2 class="font-headline text-3xl mb-12 italic border-b border-outline-variant/10 pb-4">Life & Legacy</h2>
                <div class="font-body text-xl leading-relaxed text-on-surface/90 space-y-8 whitespace-pre-wrap">
                    <template v-if="personData.biography">
                        {{ personData.biography }}
                    </template>
                    <template v-else>
                        <p class="italic text-on-surface-variant opacity-70">
                            The biographical ledger for {{ fullName }} is currently under archival review. Further historical details have yet to be transcribed into the digital registry.
                        </p>
                    </template>
                </div>
                <div class="mt-20 flex gap-4">
                    <div class="w-16 h-[1px] bg-secondary self-center"></div>
                    <span class="font-body italic text-on-surface-variant">Archived by Resting Heritage</span>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 md:px-12 pb-32">
            <div class="bg-surface-container p-8 md:p-20 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="font-label text-xs uppercase tracking-widest text-secondary block mb-4">Final Resting Place</span>
                    <h3 class="font-headline text-4xl mb-6">{{ personData.cemeteryName || 'Unknown Cemetery' }}</h3>
                    <p class="font-body text-lg text-on-surface-variant mb-12">
                        Preserving the exact location of the deceased ensures that their historical footprint remains intact for future genealogists and descendants.
                    </p>

                    <div class="bg-surface-container-low p-6 border-l-4 border-secondary shadow-inner">
                        <span class="font-label text-[10px] uppercase tracking-widest text-outline block mb-1">Plot Designation</span>
                        <p class="font-headline text-2xl tracking-wide">{{ personData.graveName || 'Uncharted Plot' }}</p>
                    </div>

                    <Link v-if="personData.graveId" :href="route('graves.show', personData.graveId)" class="mt-12 flex items-center gap-2 group w-fit cursor-pointer">
                        <span class="font-label text-xs uppercase tracking-[0.2em] border-b border-secondary pb-1 group-hover:text-secondary transition-colors text-on-surface">View Plot details</span>
                        <span class="material-symbols-outlined text-sm text-on-surface group-hover:text-secondary transition-colors" data-icon="chevron_right">chevron_right</span>
                    </Link>
                </div>

                <div class="aspect-square bg-surface-variant relative grayscale opacity-70 border border-outline/10">
                    <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=800&auto=format&fit=crop"
                         alt="Location Map"
                         class="w-full h-full object-cover mix-blend-multiply opacity-50"/>

                    <div class="absolute inset-0 border-[20px] border-surface-container z-10 pointer-events-none"></div>

                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20">
                        <div class="w-4 h-4 bg-secondary rounded-full shadow-[0_0_20px_rgba(126,95,31,0.5)] animate-pulse"></div>
                    </div>
                </div>
            </div>
        </section>

    </AuthenticatedLayout>
</template>

<style scoped>
.editorial-shadow {
    box-shadow: 0 24px 48px -12px rgba(56, 57, 43, 0.06);
}
</style>
