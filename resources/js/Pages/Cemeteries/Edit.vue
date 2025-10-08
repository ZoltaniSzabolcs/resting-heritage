<script setup>
import { route } from "ziggy-js";
import { useForm, Link, usePage, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import CoordinatePicker from "@/Components/CoordinatePicker.vue";

defineProps({
    cemetery: {
        type: Object,
        required: true,
    }
})

const cemetery = usePage().props.cemetery.data

const form = useForm({
    name: cemetery.name,
    city: cemetery.city,
    description: cemetery.description,
    entrance: cemetery.entrance || { type: "Point", coordinates: [null, null] },
    center: cemetery.center || { type: "Point", coordinates: [null, null] },
})

function submit() {
    form.put(route('cemeteries.update', cemetery.id))
}
</script>

<template>
    <Head title="Edit cemetery" />

    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-6">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li>
                        <Link :href="route('cemeteries.index')" class="hover:text-blue-600">Cemeteries</Link>
                    </li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-700 font-semibold">Update</li>
                </ol>
            </nav>

            <h1 class="text-2xl font-semibold mb-6">Update Cemetery</h1>

            <div class="bg-white rounded-lg shadow p-6">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Basic fields -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input v-model="form.name" type="text"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm focus:border-blue-500 focus:ring-blue-500" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input v-model="form.city" type="text"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm focus:border-blue-500 focus:ring-blue-500" />
                        <InputError :message="form.errors.city" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea v-model="form.description" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        <InputError :message="form.errors.description" />
                    </div>

                    <!-- Coordinate pickers -->
                    <CoordinatePicker label="Entrance" v-model="form.entrance" />
                    <CoordinatePicker label="Center" v-model="form.center" />

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2">
                        <Link :href="route('cemeteries.index')"
                              class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                            Cancel
                        </Link>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition disabled:opacity-50"
                                :disabled="form.processing">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
