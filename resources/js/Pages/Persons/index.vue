<script setup>
import { route } from 'ziggy-js';
import { computed, ref, watch } from "vue";
import { Link, useForm, router, usePage, Head } from "@inertiajs/vue3";
import PaginationBar from "@/Components/PaginationBar.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";

defineProps({
    persons: {
        type: Object,
        required: true,
    },
    search: {
        type: String,
        required: false
    },
})

let search = ref(usePage().props.search), pageNumber = ref(1);
let personsUrl = computed(() => {
    let url = new URL(route('persons.index'))
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
    () => personsUrl.value,
    (newPersonsUrl) => {
        router.visit(newPersonsUrl, {
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

const deletePerson = (personId) => {
    if (confirm("Are you sure you want to delete this person?")) {
        deleteForm.delete(route('person.destroy', personId))
    }
}

</script>

<template>
    <Head title="Persons" />

    <AuthenticatedLayout>
        <div class="p-6 max-w-7xl mx-auto">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Persons</h1>
            </div>

            <!-- Search input -->
            <div class="py-6 relative text-sm text-gray-800 col-span-3">
                <div
                    class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
                >
                    <MagnifyingGlass />
                </div>

                <input
                    v-model="search"
                    type="text"
                    autocomplete="off"
                    placeholder="Search persons data..."
                    id="search"
                    class="block rounded-lg border-0 py-2 pl-10
                    text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400
                    focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 w-full"
                />
            </div>

            <!-- Persons Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
            >
                <div
                    v-for="person in persons.data"
                    :key="person.id"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition-shadow duration-300"
                >
                    <!-- Image -->
                    <div class="relative w-full h-48 bg-gray-100 rounded-t-xl overflow-hidden">
                        <img
                            v-if="person.imageUrl"
                            :src="person.imageUrl"
                            :alt="person.firstName + ' ' + person.lastName"
                            class="object-cover w-full h-full"
                        />
                        <div
                            v-else
                            class="flex items-center justify-center h-full text-gray-400"
                        >
                            No Image
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-1">
                            {{ (person.initials ? person.initials + ' ' : '') + person.lastName + ' ' + person.firstName }}
                        </h2>
                        <p class="text-sm text-gray-500 mb-2">
                            <span class="font-medium">Occupation:</span> {{ person.occupation }}
                        </p>
                        <p class="text-sm text-gray-500">
                            <span class="font-medium">Born:</span>
                            {{ person.birthDate }} in {{ person.birthPlace }}
                        </p>
                        <p class="text-sm text-gray-500 mb-2">
                            <span class="font-medium">Died:</span>
                            {{ person.deathDate }} in {{ person.deathPlace }}
                        </p>

                        <p
                            v-if="person.biography"
                            class="text-sm text-gray-700 line-clamp-3 mb-3"
                        >
                            {{ person.biography }}
                        </p>

                        <!-- Buttons -->
                        <div class="flex justify-between items-center mt-4">
                            <Link
                                :href="route('persons.edit', person.id)"
                                class="text-indigo-600 hover:text-indigo-900 text-sm font-medium"
                            >
                                Edit
                            </Link>
                            <button
                                @click="deletePerson(person.id)"
                                class="text-red-500 hover:text-red-700 text-sm font-medium"
                            >
                                Delete
                            </button>
                            <Link
                                :href="route('persons.show', person.id)"
                                class="text-green-600 hover:text-green-900 text-sm font-medium"
                            >
                                More
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination Controls -->
            <div class="p-6 max-w-7xl mx-auto">
                <PaginationBar
                    :meta="persons.meta"
                    :updatedPageNumber="updatedPageNumber"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
