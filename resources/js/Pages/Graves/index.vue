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
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map.value);
    updateGraveLocations();
})

const updateGraveLocations = () => {
    markers.forEach(m => map.value.removeLayer(m));
    markers.length = 0;

    let bounds = [];

    for (const grave of graves.data) {
        if (grave.location?.coordinates) {
            // GeoJSON Point = [lon, lat], Leaflet = [lat, lon] !!!
            const latlng = [grave.location.coordinates[1], grave.location.coordinates[0]]
            const marker = leaflet.marker(latlng).addTo(map.value);

            const popupContent = `
          <div>
            <strong>${grave.name}</strong><br/>
            <button class="edit-btn" data-id="${grave.id}"
              style="margin-top:5px; padding:4px 8px; background:#4f46e5; color:white; border:none; border-radius:4px; cursor:pointer;">
              Edit
            </button>
            <button class="delete-btn" data-id="${grave.id}"
              style="margin-top:5px; margin-left:5px; padding:4px 8px; background:#dc2626; color:white; border:none; border-radius:4px; cursor:pointer;">
              Delete
            </button>
          </div>
        `;

            marker.bindPopup(popupContent);

            marker.on("popupopen", (e) => {
                const popupNode = e.popup.getElement();

                popupNode.querySelector(".edit-btn")?.addEventListener("click", () => {
                    router.get(route("graves.edit", grave.id));
                });

                popupNode.querySelector(".delete-btn")?.addEventListener("click", () => {
                    if (confirm("Are you sure you want to delete this grave?")) {
                        deleteForm.delete(route("graves.destroy", grave.id));
                    }
                });
            });

            markers.push(marker);
            bounds.push(latlng);
        }
    }
    if (bounds.length > 0) {
        map.value.fitBounds(bounds);
    }
}

const visitWithParams = () => {
    let url = new URL(route('graves.index'));
    url.searchParams.append('page', pageNumber.value);

    if (search.value) {
        url.searchParams.append('search', search.value);
    }

    router.visit(url, {
        preserveScroll: true,
        preserveState: false,
        replace: true,
        onSuccess: () => {
            updateGraveLocations();
            if (searchInput.value) {
                searchInput.value.focus();
                console.log(searchInput);
                const val = searchInput.value.value;
                searchInput.value.setSelectionRange(val.length, val.length);
            }
        }
    });
};

const updatedPageNumber = (link) => {
    pageNumber.value = link.url.split("=")[1];
    visitWithParams();
}

watch(
    () => search.value,
    () => {
        pageNumber.value = 1;
        visitWithParams();
    }
)

const deleteGrave = (graveId) => {
    if (confirm("Are you sure you want to delete this grave?")) {
        deleteForm.delete(route('graves.destroy', graveId))
    }
}

const addPerson = (graveId) => {
    router.get(route('persons.create'), {
        graveId: graveId,
    })
}
</script>


<template>
    <Head title="Graves"/>

    <AuthenticatedLayout>
        <div class="p-6 max-w-7xl mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Graves</h1>
            </div>

            <div class="py-6 relative text-sm text-gray-800 col-span-3">
                <div
                    class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
                >
                    <MagnifyingGlass/>
                </div>

                <input
                    ref="searchInput"
                    v-model="search"
                    type="text"
                    autocomplete="off"
                    placeholder="Search graves data..."
                    id="search"
                    class="block rounded-lg border-0 py-2 pl-10
                    text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400
                    focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
            </div>

            <div ref="mapContainer" class="w-full h-96"></div>

            <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Plot number</th>
                    <th class="py-2 px-4 text-left">Location</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="grave in graves.data" :key="grave.id" class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ grave.name }}</td>
                    <td class="py-2 px-4">
            <span v-if="grave.location">
              {{ grave.location.coordinates[1] }}, {{ grave.location.coordinates[0] }}
            </span>
                        <span v-else class="text-gray-400 italic">no center</span>
                    </td>
                    <td class="py-2 px-4">
                        <Link :href="route('graves.edit', grave.id)"
                              class="px-2 text-indigo-600 hover:text-indigo-900">Edit
                        </Link>
                        <Link @click="deleteGrave(grave.id)"
                              class="px-2 text-indigo-600 hover:text-indigo-900">
                            Delete
                        </Link>
                    </td>
                    <td class="py-2 px-2">
                        <Link
                            @click="addPerson(grave.id)"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        >
                            +Person
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>

            <!--         Pagination Controls-->
            <div class="p-6 max-w-7xl mx-auto">
                <PaginationBar
                    :meta="graves.meta"
                    :updatedPageNumber="updatedPageNumber"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
