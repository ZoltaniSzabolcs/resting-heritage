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
                    placeholder="Search persons data..."
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
                    <th class="py-2 px-12 text-left">Birth date</th>
                    <th class="py-2 px-12 text-left">Death date</th>
                    <th class="py-2 px-4 text-left">Birth place</th>
                    <th class="py-2 px-4 text-left">Death place</th>
                    <th class="py-2 px-4 text-left">Biography</th>
                    <th class="py-2 px-4 text-left">Occupation</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="person in persons.data" :key="person.id" class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{
                            (person.initials ? person.initials : '')
                            + ' ' + person.lastName + ' ' + person.firstName
                        }}
                    </td>
                    <td class="py-2 px-4">{{ person.birthDate }}</td>
                    <td class="py-2 px-4">{{ person.deathDate }}</td>
                    <td class="py-2 px-4">{{ person.birthPlace }}</td>
                    <td class="py-2 px-4">{{ person.deathPlace }}</td>
                    <td class="py-2 px-4">{{ person.biography }}</td>
                    <td class="py-2 px-4">{{ person.occupation }}</td>
                    <td class="py-2 px-2">
                        <Link :href="route('persons.edit', person.id)"
                              class="px-2 text-indigo-600 hover:text-indigo-900">Edit
                        </Link>
                    </td>
                    <td class="py-2 px-2">
                        <Link @click="deletePerson(person.id)"
                              class="px-2 text-indigo-600 hover:text-indigo-900">
                            Delete
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>

            <!--         Pagination Controls-->
            <div class="p-6 max-w-7xl mx-auto">
                <PaginationBar
                    :meta="persons.meta"
                    :updatedPageNumber="updatedPageNumber"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
