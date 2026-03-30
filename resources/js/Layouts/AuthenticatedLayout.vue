<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="bg-surface text-on-surface font-body selection:bg-secondary/30 min-h-screen flex flex-col">

        <nav class="bg-surface opacity-95 backdrop-blur-md fixed w-full top-0 z-50 border-b border-outline/20">
            <div class="flex justify-between items-center w-full px-6 lg:px-12 py-4 max-w-[1920px] mx-auto">

                <div class="flex items-center gap-4">
                    <Link :href="route('dashboard')" class="flex items-center gap-3">
                        <ApplicationLogo class="h-[64px] w-auto object-contain" />
                        <span class="hidden sm:block text-xl md:text-2xl font-serif tracking-[0.2em] text-dark-stone-950 uppercase">
                            Resting Heritage
                        </span>
                    </Link>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <Link :href="route('dashboard')" :class="route().current('dashboard') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface hover:text-primary'" class="font-serif tracking-widest uppercase text-sm font-light transition-colors duration-300">
                        Dashboard
                    </Link>
                    <Link :href="route('cemeteries.index')" :class="route().current('cemeteries.*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface hover:text-primary'" class="font-serif tracking-widest uppercase text-sm font-light transition-colors duration-300">
                        Cemeteries
                    </Link>
                    <Link :href="route('graves.index')" :class="route().current('graves.*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface hover:text-primary'" class="font-serif tracking-widest uppercase text-sm font-light transition-colors duration-300">
                        Graves
                    </Link>
                    <Link :href="route('persons.index')" :class="route().current('persons.*') ? 'text-secondary border-b-2 border-secondary pb-1' : 'text-on-surface hover:text-primary'" class="font-serif tracking-widest uppercase text-sm font-light transition-colors duration-300">
                        Persons
                    </Link>
                </div>

                <div class="hidden md:flex items-center gap-6">
                    <div class="hidden lg:flex items-center border-b border-outline/40 pb-1">
                        <span class="material-symbols-outlined text-sm text-on-surface-variant mr-2" data-icon="search">search</span>
                        <span class="font-serif tracking-widest uppercase text-sm font-light text-primary dark:text-surface-container">Search</span>
                    </div>

                    <div class="relative ms-3" v-if="$page.props.auth.user">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button type="button" class="flex items-center gap-2 font-serif tracking-widest uppercase text-sm font-medium text-on-surface hover:text-secondary transition-colors">
                                    {{ $page.props.auth.user.name }}
                                    <span class="material-symbols-outlined text-sm">expand_more</span>
                                </button>
                            </template>
                            <template #content>
                                <DropdownLink :href="route('profile.edit')" class="font-label tracking-wide">Profile</DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button" class="font-label tracking-wide">Log Out</DropdownLink>
                            </template>
                        </Dropdown>
                    </div>

                    <div v-else class="flex gap-4 items-center">
                        <Link :href="route('login')" class="font-label text-xs uppercase tracking-widest text-on-surface hover:text-secondary transition-colors">
                            Log in
                        </Link>
                        <Link :href="route('register')" class="font-label text-xs uppercase tracking-widest bg-secondary text-on-secondary px-4 py-2 hover:bg-secondary-dim transition-colors">
                            Register
                        </Link>
                    </div>
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="text-on-surface focus:outline-none">
                        <span class="material-symbols-outlined text-2xl" v-if="!showingNavigationDropdown">menu</span>
                        <span class="material-symbols-outlined text-2xl" v-else>close</span>
                    </button>
                </div>
            </div>

            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="md:hidden bg-surface-container-low border-t border-outline/20">
                <div class="border-t border-outline/20 pb-4 pt-4 px-4" v-if="$page.props.auth.user">
                    <div class="text-base font-headline text-secondary">{{ $page.props.auth.user.name }}</div>
                    <div class="text-sm font-body italic text-outline">{{ $page.props.auth.user.email }}</div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
                    </div>
                </div>

                <div class="border-t border-outline/20 pb-4 pt-4 px-4 space-y-1" v-else>
                    <ResponsiveNavLink :href="route('login')">Log in</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('register')">Register</ResponsiveNavLink>
                </div>
            </div>
        </nav>

        <header v-if="$slots.header" class="pt-24 bg-surface shadow-sm border-b border-outline/10 z-40 relative">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <slot name="header"/>
            </div>
        </header>

        <main :class="{'pt-24': !$slots.header}" class="relative overflow-hidden flex-grow z-10">
            <slot />
        </main>

        <div class="fixed bottom-12 right-12 z-[60]">
            <Link :href="route('persons.create')" class="w-16 h-16 rounded-full bg-tertiary shadow-[inset_0_2px_4px_rgba(255,255,255,0.2),0_10px_20px_rgba(140,89,41,0.3)] flex items-center justify-center group cursor-pointer hover:bg-secondary transition-colors">
                <span class="material-symbols-outlined text-on-tertiary text-3xl group-hover:scale-110 transition-transform" data-icon="fingerprint" data-weight="fill">fingerprint</span>
            </Link>
        </div>

        <footer class="bg-surface-container w-full pt-16 pb-12 border-t border-outline-variant/15 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 px-12 lg:px-20 max-w-7xl mx-auto">
                <div class="space-y-6">
                    <span class="font-serif text-lg tracking-widest uppercase text-primary">Resting Heritage</span>
                    <p class="font-serif text-sm italic leading-relaxed text-on-surface">
                        © {{ new Date().getFullYear() }} Resting Heritage. Preserving the digital sanctuary of our ancestors.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <a class="font-serif text-sm italic leading-relaxed text-on-surface hover:text-secondary transition-all duration-300" href="#">Researchers</a>
                    <a class="font-serif text-sm italic leading-relaxed text-on-surface hover:text-secondary transition-all duration-300" href="#">Family Search Tools</a>
                    <a class="font-serif text-sm italic leading-relaxed text-on-surface hover:text-secondary transition-all duration-300" href="#">Heritage Documentation</a>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <a class="font-serif text-sm italic leading-relaxed text-on-surface hover:text-secondary transition-all duration-300" href="#">Privacy Policy</a>
                    <a class="font-serif text-sm italic leading-relaxed text-on-surface hover:text-secondary transition-all duration-300" href="#">Archival Ethics</a>
                    <div class="flex gap-4 mt-4">
                        <span class="material-symbols-outlined text-primary" data-icon="auto_stories">auto_stories</span>
                        <span class="material-symbols-outlined text-primary" data-icon="local_library">local_library</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Any global specific styles for the layout */
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
}
.paper-texture {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
    opacity: 0.03;
    pointer-events: none;
}
</style>
