<script setup>
import { route } from 'ziggy-js';
import { computed, ref, watch } from "vue";
import { Link, useForm, router, usePage, Head } from "@inertiajs/vue3";
import PaginationBar from "@/Components/PaginationBar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";

defineProps({
    cemeteries: {
        type: Object,
        required: true,
    },
    search: {
        type: String,
        required: false
    },
})

let search = ref(usePage().props.search), pageNumber = ref(1);
let cemeteryUrl = computed(() => {
    let url = new URL(route('cemeteries.index'))
    url.searchParams.append('page', pageNumber.value)

    if (search.value) {
        url.searchParams.append('search', search.value);
    }

    return url;
})

const updatedPageNumber = (link) => {
    pageNumber.value = link.url.split("=")[1];
}

watch(
    () => cemeteryUrl.value,
    (newCemeteryUrl) => {
        router.visit(newCemeteryUrl, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        })
    })

watch(
    () => search.value,
    (newSearch) => {
        if (newSearch) {
            pageNumber.value = 1;
        }
    })


const deleteForm = useForm();

const deleteCemetery = (cemeteryId) => {
    if (confirm("Are you sure you want to delete this cemetery?")) {
        deleteForm.delete(route('cemeteries.destroy', cemeteryId))
    }
}

const addGrave = (cemeteryId) => {
    router.get(route('graves.create'), {
        cemeteryId: cemeteryId,
    });
}

</script>

<template>
    <Head title="Cemeteries" />

    <AuthenticatedLayout>
        <div class="p-6 max-w-7xl mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Cemeteries</h1>

                <Link
                    :href="route('cemeteries.create')"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                >
                    Add Cemetery
                </Link>
            </div>

            <div class="py-6 relative text-sm text-gray-800 col-span-3">
                <div
                    class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
                >
                    <MagnifyingGlass/>
                </div>

                <input
                    v-model="search"
                    type="text"
                    autocomplete="off"
                    placeholder="Search cemeteries data..."
                    id="search"
                    class="block rounded-lg border-0 py-2 pl-10
                    text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400
                    focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
            </div>

            <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Name</th>
                    <th class="py-2 px-4 text-left">City</th>
                    <th class="py-2 px-4 text-left">Description</th>
                    <th class="py-2 px-4 text-left">Center (lat, lng)</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="cemetery in cemeteries.data" :key="cemetery.id" class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ cemetery.name }}</td>
                    <td class="py-2 px-4">{{ cemetery.city }}</td>
                    <td class="py-2 px-4">{{ cemetery.description }}</td>
                    <td class="py-2 px-4">
            <span v-if="cemetery.center">
              {{ cemetery.center.coordinates[1] }}, {{ cemetery.center.coordinates[0] }}
            </span>
                        <span v-else class="text-gray-400 italic">no center</span>
                    </td>
                    <td class="py-2 px-4">
                        <Link :href="route('cemeteries.edit', cemetery.id)"
                              class="text-indigo-600 hover:text-indigo-900">Edit
                        </Link>
                    </td>
                    <td class="py-2 px-4">
                        <Link @click="deleteCemetery(cemetery.id)" class="text-indigo-600 hover:text-indigo-900">
                            Delete
                        </Link>
                    </td>
                    <td class="py-2 px-2">
                        <Link
                            @click="addGrave(cemetery.id)"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        >
                            +Grave
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>

            <!--         Pagination Controls-->
            <div class="p-6 max-w-7xl mx-auto">
                <PaginationBar
                    :meta="cemeteries.meta"
                    :updatedPageNumber="updatedPageNumber"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
