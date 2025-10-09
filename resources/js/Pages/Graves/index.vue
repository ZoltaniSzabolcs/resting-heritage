<script setup>
import { route } from 'ziggy-js';
import { onMounted, ref, watch } from "vue";
import { Link, useForm, router, usePage, Head } from "@inertiajs/vue3";
import PaginationBar from "@/Components/PaginationBar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import leaflet from "leaflet";

defineProps({
    graves: {
        type: Object,
        required: true,
    },
    search: {
        type: String,
        required: false,
    },
    page: {
        type: [Number, String],
        required: false,
    }
})

const graves = usePage().props.graves;
const search = ref(usePage().props.search ?? "");
const pageNumber = ref(usePage().props.page ?? 1);

const searchInput = ref(null);
const map = ref();
const mapContainer = ref();
const markers = [];

const deleteForm = useForm();

onMounted(() => {
    map.value = leaflet.map(mapContainer.value).setView([46.762353, 23.5931572], 15);
    leaflet.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        { maxZoom: 19, attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>' }
    ).addTo(map.value);

    updateGraveLocations();
});

const updateGraveLocations = () => {
    markers.forEach(m => map.value.removeLayer(m));
    markers.length = 0;

    let bounds = [];

    for (const grave of graves.data) {
        if (grave.location?.coordinates) {
            const latlng = [grave.location.coordinates[1], grave.location.coordinates[0]];
            const marker = leaflet.marker(latlng).addTo(map.value);

            marker.bindPopup(`<strong>${grave.name}</strong>`);
            markers.push(marker);
            bounds.push(latlng);
        }
    }

    if (bounds.length > 0) {
        map.value.fitBounds(bounds);
    }
};

const visitWithParams = () => {
    let url = new URL(route('graves.index'));
    url.searchParams.append('page', pageNumber.value);
    if (search.value) url.searchParams.append('search', search.value);

    router.visit(url, {
        preserveScroll: true,
        preserveState: false,
        replace: true,
        onSuccess: updateGraveLocations
    });
};

const updatedPageNumber = (link) => {
    pageNumber.value = link.url.split("=")[1];
    visitWithParams();
};

watch(() => search.value, () => {
    pageNumber.value = 1;
    visitWithParams();
});

const deleteGrave = (graveId) => {
    if (confirm("Are you sure you want to delete this grave?")) {
        deleteForm.delete(route('graves.destroy', graveId));
    }
};

const addPerson = (graveId) => {
    router.get(route('persons.create'), { graveId });
};
</script>

<template>
    <Head title="Graves" />

    <AuthenticatedLayout>
        <div class="p-6 max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Graves</h1>
            </div>

            <!-- Search -->
            <div class="py-4 relative text-sm text-gray-800 mb-6">
                <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                    <MagnifyingGlass />
                </div>
                <input
                    ref="searchInput"
                    v-model="search"
                    type="text"
                    autocomplete="off"
                    placeholder="Search graves..."
                    class="block w-full rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200
                    placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
            </div>

            <!-- Map -->
            <div ref="mapContainer" class="w-full h-80 rounded-lg shadow mb-8"></div>

            <!-- Graves Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="grave in graves.data"
                    :key="grave.id"
                    class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition-shadow"
                >
                    <img
                        src="../../../../public/storage/gravestone2.jpg"
                        alt="Grave photo"
                        class="h-48 w-full object-cover"
                    />

                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ grave.name }}</h2>
                        <p class="text-sm text-gray-600 mb-3">
                            <span v-if="grave.location">
                                {{ grave.location.coordinates[1] }}, {{ grave.location.coordinates[0] }}
                            </span>
                            <span v-else class="italic text-gray-400">No location</span>
                        </p>

                        <div class="flex flex-wrap gap-2">
                            <Link
                                :href="route('graves.edit', grave.id)"
                                class="px-3 py-1.5 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                Edit
                            </Link>
                            <Link
                                :href="route('graves.edit-boundary', grave.id)"
                                class="px-3 py-1.5 text-sm bg-yellow-500 text-white rounded-md hover:bg-yellow-600"
                            >
                                Boundary
                            </Link>
                            <button
                                @click="deleteGrave(grave.id)"
                                class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-md hover:bg-red-700"
                            >
                                Delete
                            </button>
                            <button
                                @click="addPerson(grave.id)"
                                class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            >
                                +Person
                            </button>
                            <Link
                                :href="route('graves.show', grave.id)"
                                class="px-3 py-1.5 text-sm bg-gray-700 text-white rounded-md hover:bg-gray-800"
                            >
                                More
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                <PaginationBar :meta="graves.meta" :updatedPageNumber="updatedPageNumber" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
