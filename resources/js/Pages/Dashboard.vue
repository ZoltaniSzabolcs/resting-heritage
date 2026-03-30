<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    cemeteries: Array
});

</script>

<template>
    <Head title="Dashboard | Resting Heritage" />

    <AuthenticatedLayout>

        <section class="relative min-h-[921px] flex flex-col items-center justify-center px-6">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-b from-primary/20 via-background to-background z-10"></div>
                <img alt="Ethereal historic cemetery at dawn" class="w-full h-full object-cover grayscale opacity-40 mix-blend-multiply" src="../../../public/storage/EtherealHistoricCemeteryAtDawn.png"/>
                <div class="paper-texture absolute inset-0 z-20"></div>
            </div>

            <div class="relative z-30 max-w-4xl w-full text-center space-y-12">
                <h1 class="font-headline text-5xl md:text-7xl lg:text-8xl tracking-tight text-on-background leading-none">
                    Every name is a <span class="italic font-light">legacy.</span>
                </h1>

                <div class="bg-surface-container/90 backdrop-blur-sm p-2 shadow-2xl ring-1 ring-outline/10">
                    <div class="flex flex-col md:flex-row items-center border border-outline/20">
                        <div class="flex-1 w-full px-6 py-4 flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary" data-icon="history_edu">history_edu</span>
                            <input class="bg-transparent border-none focus:ring-0 w-full font-body text-xl placeholder:text-outline/60 italic" placeholder="Search Ancestor Name..." type="text"/>
                        </div>
                        <div class="w-px h-10 bg-outline/20 hidden md:block"></div>
                        <div class="flex-1 w-full px-6 py-4 flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary" data-icon="location_on">location_on</span>
                            <input class="bg-transparent border-none focus:ring-0 w-full font-body text-xl placeholder:text-outline/60 italic" placeholder="Burial Location..." type="text"/>
                        </div>
                        <button class="bg-secondary text-on-secondary px-10 py-5 font-label uppercase tracking-widest text-sm font-medium w-full md:w-auto hover:bg-secondary-dim transition-colors">
                            Explore Archive
                        </button>
                    </div>
                </div>

                <p class="font-body text-lg md:text-xl text-on-surface-variant max-w-2xl mx-auto leading-relaxed italic">
                    Access over four centuries of meticulously preserved genealogical records and high-fidelity archival imagery.
                </p>
            </div>
        </section>

        <section class="py-32 px-12 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-20 items-center">
                <div class="md:col-span-7 relative">
                    <div class="absolute -top-12 -left-12 w-64 h-64 bg-primary-container/30 -z-10"></div>
                    <img alt="Old handwritten letters and records" class="w-full grayscale brightness-90 border-r-[24px] border-b-[24px] border-surface-container-highest" src="../../../public/storage/OldHandwrittenLettersAndRecords.png"/>
                </div>
                <div class="md:col-span-5 space-y-8">
                    <span class="font-label uppercase tracking-[0.3em] text-secondary text-xs font-bold block">Our Mission</span>
                    <h2 class="font-headline text-4xl md:text-5xl text-on-background leading-tight">Preserving the silent voices of time.</h2>
                    <p class="font-body text-xl text-on-surface-variant leading-relaxed">
                        Resting Heritage exists at the intersection of history and technology. We believe that a cemetery is more than a final resting place; it is a library of lived experiences.
                    </p>
                    <p class="font-body text-lg text-on-surface-variant italic">
                        "To be forgotten is to die twice. We ensure that every story, no matter how humble, finds its place in the digital sanctuary."
                    </p>
                    <div class="pt-4">
                        <a class="font-label text-on-surface border-b border-secondary pb-1 tracking-widest uppercase text-xs font-bold hover:text-secondary transition-colors" href="#">Documentation Protocol</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-surface-container py-32">
            <div class="px-6 lg:px-12 max-w-[1920px] mx-auto">
                <div class="flex justify-between items-end mb-20 border-b border-outline/10 pb-8">
                    <div>
                        <span class="font-label uppercase tracking-[0.3em] text-secondary text-xs font-bold block mb-4">Curated Finds</span>
                        <h2 class="font-headline text-5xl text-on-background italic">Historical Highlights</h2>
                    </div>
                    <a class="hidden md:block font-body text-xl italic text-secondary hover:underline underline-offset-8" href="#">Browse the Full Collection →</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-8 h-auto md:h-[800px]">
                    <div class="md:col-span-2 md:row-span-2 relative group overflow-hidden bg-on-background cursor-pointer">
                        <img alt="Victorian monument detail" class="w-full h-full object-cover opacity-70 group-hover:scale-105 transition-transform duration-700 grayscale" src="../../../public/storage/VictorianMonumentDetail.png"/>
                        <div class="absolute inset-0 p-8 lg:p-12 flex flex-col justify-end bg-gradient-to-t from-on-background/80 to-transparent">
                            <span class="font-label text-surface text-xs uppercase tracking-widest mb-4">Series: Victorian Elegance</span>
                            <h3 class="font-headline text-3xl lg:text-4xl text-surface mb-4">The Highgate Angels</h3>
                            <p class="font-body text-lg text-surface-container/80 italic mb-6">A deep dive into the master stonemasons of 19th-century London.</p>
                            <button class="w-fit border border-surface/30 px-6 py-3 text-surface font-label uppercase text-xs tracking-widest hover:bg-surface hover:text-on-background transition-colors">Read Manuscript</button>
                        </div>
                    </div>

                    <div class="md:col-span-2 bg-surface-container-low p-8 lg:p-10 flex flex-col justify-between border-t-8 border-secondary cursor-pointer hover:bg-surface transition-colors">
                        <div class="space-y-4">
                            <div class="flex gap-2">
                                <span class="material-symbols-outlined text-secondary text-sm" data-icon="star" data-weight="fill">star</span>
                                <span class="material-symbols-outlined text-secondary text-sm" data-icon="star" data-weight="fill">star</span>
                                <span class="material-symbols-outlined text-secondary text-sm" data-icon="star" data-weight="fill">star</span>
                            </div>
                            <h3 class="font-headline text-3xl">Forgotten Founders</h3>
                            <p class="font-body text-lg text-on-surface-variant leading-relaxed">Recovering the lost burial records of the 1764 New England settler wave. Over 400 new names indexed this month.</p>
                        </div>
                        <div class="pt-8 flex items-center justify-between">
                            <span class="font-label text-xs uppercase tracking-widest opacity-50">Volume XIV • No. 2</span>
                            <span class="material-symbols-outlined text-secondary" data-icon="arrow_forward">arrow_forward</span>
                        </div>
                    </div>

                    <div class="md:col-span-1 bg-primary text-on-primary p-8 lg:p-10 flex flex-col justify-end relative overflow-hidden cursor-pointer hover:bg-primary-dim transition-colors">
                        <div class="absolute top-0 right-0 p-4 opacity-20">
                            <span class="material-symbols-outlined text-8xl" data-icon="auto_stories">auto_stories</span>
                        </div>
                        <h3 class="font-headline text-2xl mb-2">Symbolism Guide</h3>
                        <p class="font-body text-sm italic opacity-80">Understanding the language of cemetery iconography: From ivy to anchors.</p>
                    </div>

                    <div class="md:col-span-1 relative group overflow-hidden cursor-pointer">
                        <img alt="Macro of cemetery stone" class="w-full h-full object-cover grayscale brightness-75 group-hover:scale-110 transition-transform duration-700" src="../../../public/storage/MacroOfCemeteryStone.png"/>
                        <div class="absolute inset-0 bg-secondary/20 mix-blend-multiply"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="font-headline text-xl text-surface">Recent Scans</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-32 px-6 lg:px-12 max-w-7xl mx-auto">
            <div class="text-center mb-24">
                <h2 class="font-headline text-4xl mb-4">Recent Documentations</h2>
                <div class="w-24 h-px bg-secondary mx-auto"></div>
            </div>

            <div class="space-y-16">
                <div class="flex flex-col md:flex-row items-center gap-8 lg:gap-12 group cursor-pointer">
                    <div class="w-full md:w-1/3 aspect-[4/5] overflow-hidden bg-surface-container-highest">
                        <img alt="Headstone of Eleanor Vance" class="w-full h-full object-cover grayscale opacity-80 group-hover:opacity-100 transition-opacity duration-500" src="../../../public/storage/Headstone%20OfEleanorVance.png"/>
                    </div>
                    <div class="w-full md:w-2/3 space-y-4">
                        <div class="flex items-center gap-4 text-secondary">
                            <span class="font-label uppercase tracking-widest text-xs">New Entry</span>
                            <span class="w-8 h-px bg-secondary/40"></span>
                            <span class="font-label text-xs">Oct 24, 2024</span>
                        </div>
                        <h3 class="font-headline text-3xl lg:text-4xl group-hover:text-secondary transition-colors">
                            Vance, Eleanor M. <span class="font-light italic text-xl lg:text-2xl text-on-surface-variant">(1842—1912)</span>
                        </h3>
                        <p class="font-body text-xl text-on-surface-variant max-w-xl italic leading-relaxed">
                            "A pioneer of the textile arts in the Southern Appalachians. Her monument features the rare 'spinning wheel' motif, recently restored by our North Carolina team."
                        </p>
                        <div class="pt-4 flex flex-wrap gap-6">
                            <span class="font-label text-xs uppercase tracking-tighter flex items-center gap-2"><span class="material-symbols-outlined text-sm" data-icon="location_on">location_on</span> Asheville, NC</span>
                            <span class="font-label text-xs uppercase tracking-tighter flex items-center gap-2"><span class="material-symbols-outlined text-sm" data-icon="photo_camera">photo_camera</span> 12 Hi-Res Scans</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row-reverse items-center gap-8 lg:gap-12 group cursor-pointer">
                    <div class="w-full md:w-1/3 aspect-[4/5] overflow-hidden bg-surface-container-highest">
                        <img alt="St. Mary's Cemetery gates" class="w-full h-full object-cover grayscale opacity-80 group-hover:opacity-100 transition-opacity duration-500" src="../../../public/storage/StMarysCemeteryGates.png"/>
                    </div>
                    <div class="w-full md:w-2/3 space-y-4 md:text-right md:flex md:flex-col md:items-end">
                        <div class="flex items-center gap-4 text-secondary md:flex-row-reverse">
                            <span class="font-label uppercase tracking-widest text-xs">Site Update</span>
                            <span class="w-8 h-px bg-secondary/40"></span>
                            <span class="font-label text-xs">Oct 21, 2024</span>
                        </div>
                        <h3 class="font-headline text-3xl lg:text-4xl group-hover:text-secondary transition-colors">
                            Pere Lachaise: North Wing <span class="font-light italic text-xl lg:text-2xl text-on-surface-variant">(Paris, FR)</span>
                        </h3>
                        <p class="font-body text-xl text-on-surface-variant max-w-xl italic leading-relaxed md:text-right">
                            "Full mapping completed for the 4th Division. Includes geolocation for over 1,200 artistic mausoleums and family vaults."
                        </p>
                        <div class="pt-4 flex flex-wrap gap-6 md:flex-row-reverse">
                            <span class="font-label text-xs uppercase tracking-tighter flex items-center gap-2"><span class="material-symbols-outlined text-sm" data-icon="public">public</span> France</span>
                            <span class="font-label text-xs uppercase tracking-tighter flex items-center gap-2"><span class="material-symbols-outlined text-sm" data-icon="map">map</span> Interactive Map Ready</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-24 text-center">
                <button class="bg-primary text-on-primary px-12 py-5 font-label uppercase tracking-[0.2em] text-sm hover:bg-primary-dim transition-colors">
                    Load More Records
                </button>
            </div>
        </section>

        <section class="mb-20 px-6">
            <div class="max-w-5xl mx-auto bg-surface-container-highest p-10 lg:p-16 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 border-t border-r border-secondary/20 -mr-12 -mt-12"></div>
                <div class="relative z-10 text-center space-y-8">
                    <h2 class="font-headline text-4xl">Support the Archive</h2>
                    <p class="font-body text-xl text-on-surface-variant italic max-w-2xl mx-auto">
                        Join our community of independent researchers and preservationists. Receive monthly archival updates and documentation tools.
                    </p>
                    <div class="flex flex-col md:flex-row max-w-lg mx-auto gap-4">
                        <input class="flex-1 bg-surface border border-outline/40 px-4 py-3 focus:border-secondary transition-colors font-body text-lg italic outline-none focus:ring-1 focus:ring-secondary" placeholder="archivist@example.com" type="email"/>
                        <button class="bg-secondary text-on-secondary px-8 py-3 font-label uppercase text-xs tracking-widest hover:bg-secondary-dim transition-colors">Subscribe</button>
                    </div>
                </div>
            </div>
        </section>

    </AuthenticatedLayout>
</template>
