<script setup>
import { route } from "ziggy-js";
import { useForm, Link, Form, usePage, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import CoordinatePicker from "@/Components/CoordinatePicker.vue";

defineProps({
    cemetery: {
        type: Object,
        required: true
    }
})

const form = useForm({
    cemetery_id: usePage().props.cemetery.id,
    name: '',
    location: {
        type: "Point",
        coordinates: [0, 0]
    }
})

function submit() {
    form.post(route('graves.store'))
}
</script>

<template>
    <Head title="Create grave" />

    <AuthenticatedLayout>
        <div class="max-w-4xl mx-auto p-6">
            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm text-gray-500">
                <ol class="list-reset flex">
                    <li>
                        <Link :href="route('graves.index')" class="hover:text-blue-600">Graves</Link>
                    </li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-700 font-semibold">Create</li>
                </ol>
            </nav>

            <!-- Title -->
            <h1 class="text-2xl font-semibold mb-6">Create Grave</h1>

            <h3 class="font-semibold mb-6"> You are adding a grave to {{ cemetery.name }}</h3>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow p-6">
                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Name -->
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

                    <CoordinatePicker label="Location" v-model="form.location"/>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2">
                        <Link
                            :href="route('graves.index')"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
