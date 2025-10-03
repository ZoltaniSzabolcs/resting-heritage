<script setup>
import { route } from "ziggy-js";
import { useForm, Link, usePage, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";

defineProps({
    grave: {
        type: Object,
        required: true,
    }
})

let grave = usePage().props.grave.data

const form = useForm({
    cemeteryId: grave.cemeteryId,
    name: grave.name,
    location: {
        type: "Point",
        coordinates: grave.location.coordinates
    },
})

function submit() {
    form.put(route('graves.update', grave.id))
}
</script>

<template>
    <Head title="Edit grave" />

    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-6">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li>
                        <Link :href="route('graves.index')" class="hover:text-blue-600">Graves</Link>
                    </li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-700 font-semibold">Update</li>
                </ol>
            </nav>

            <!-- Title -->
            <h1 class="text-2xl font-semibold mb-6">Update Grave</h1>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow p-6">
                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Plot Number -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Plot Number</label>
                        <input
                            v-model="form.name"
                            id="name"
                            type="text"
                            :class="[
          'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
          form.errors.name
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
        ]"
                        />
                        <InputError :message="form.errors.name"/>
                    </div>

                    <!-- Longitude -->
                    <div>
                        <label for="location.coordinates[0]" class="block text-sm font-medium text-gray-700">Longitude</label>
                        <input
                            v-model="form.location.coordinates[0]"
                            id="location.coordinates[0]"
                            type="text"
                            :class="[
          'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
          form.errors.name
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
        ]"
                        />
                        <InputError :message="form.errors.location"/>
                    </div>

                    <!-- Latitude -->
                    <div>
                        <label for="location.coordinates[1]" class="block text-sm font-medium text-gray-700">Latitude</label>
                        <input
                            v-model="form.location.coordinates[1]"
                            id="location.coordinates[1]"
                            type="text"
                            :class="[
          'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
          form.errors.name
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
        ]"
                        />
                        <InputError :message="form.errors.location"/>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2">
                        o
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
