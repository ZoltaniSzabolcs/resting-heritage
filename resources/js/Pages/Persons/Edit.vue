<script setup>
import { useForm, Link, usePage, Head } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from '@/Components/InputError.vue'

defineProps({
    person: {
        type: Object,
        required: true
    }
})

const person = usePage().props.person.data

const form = useForm({
    id: person.id,
    graveId: person.graveId,
    first_name: person.firstName,
    last_name: person.lastName,
    initials: person.initials,
    birth_date: person.birthDate,
    death_date: person.deathDate,
    birth_place: person.birthPlace,
    death_place: person.deathPlace,
    biography: person.biography,
    occupation: person.occupation,
    image_url: person.imageUrl
})

function submit() {
    form.put(route('persons.update', person.id))
}
</script>

<template>
    <Head title="Edit person" />

    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-6">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li>
                        <Link :href="route('persons.index')" class="hover:text-blue-600">Persons</Link>
                    </li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-700 font-semibold">Edit</li>
                </ol>
            </nav>

            <!-- Title -->
            <h1 class="text-2xl font-semibold mb-6">Edit Person</h1>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow p-6">
                <form @submit.prevent="form.put(route('persons.update', person.id))" class="space-y-4">

                    <!-- First name -->
                    <div>
                        <label for class="block text-sm font-medium text-gray-700">First Name</label>
                        <input v-model="form.first_name" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.first_name"/>
                    </div>

                    <!-- Last name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input v-model="form.last_name" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.last_name"/>
                    </div>

                    <!-- Initials -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Initials</label>
                        <input v-model="form.initials" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.initials"/>
                    </div>

                    <!-- Birth date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                        <input v-model="form.birth_date" type="date"
                               :class="[
              'mt-1 block rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.birth_date"/>
                    </div>

                    <!-- Death date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Death Date</label>
                        <input v-model="form.death_date" type="date"
                               :class="[
              'mt-1 block rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.death_date"/>
                    </div>

                    <!-- Birth place -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Birth Place</label>
                        <input v-model="form.birth_place" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.birth_place"/>
                    </div>

                    <!-- Death place -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Death Place</label>
                        <input v-model="form.death_place" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.death_place"/>
                    </div>

                    <!-- Occupation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Occupation</label>
                        <input v-model="form.occupation" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.occupation"/>
                    </div>

                    <!-- Biography -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biography</label>
                        <textarea v-model="form.biography" rows="4"
                                  :class="[
          'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
          form.errors.description
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
        ]"/>
                        <InputError :message="form.errors.biography"/>
                    </div>

                    <!-- Image URL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image URL</label>
                        <input v-model="form.image_url" type="text"
                               :class="[
              'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
              form.errors.name
                ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
                : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
            ]"/>
                        <InputError :message="form.errors.image_url"/>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2">
                        <Link
                            :href="route('persons.index')"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
