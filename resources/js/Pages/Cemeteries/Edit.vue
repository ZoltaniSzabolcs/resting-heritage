<script setup>
import { route } from "ziggy-js";
import { useForm, Link, usePage } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";

defineProps({
    cemetery: {
        type: Object,
        required: true,
    }
})

let cemetery = usePage().props.cemetery.data

const form = useForm({
    name: cemetery.name,
    city: cemetery.city,
    description: cemetery.description,
})

function submit() {
    form.put(route('cemeteries.update', cemetery.id))
}
</script>

<template>
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

            <!-- Title -->
            <h1 class="text-2xl font-semibold mb-6">Update Cemetery</h1>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow p-6">
                <form @submit.prevent="submit" class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
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

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input
                            v-model="form.city"
                            id="city"
                            type="text"
                            :class="[
          'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
          form.errors.city
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
        ]"
                        />
                        <InputError :message="form.errors.city"/>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea
                            v-model="form.description"
                            id="description"
                            rows="3"
                            :class="[
          'mt-1 block w-full rounded-md shadow-sm sm:text-sm',
          form.errors.description
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500'
        ]"
                        />
                        <InputError :message="form.errors.description"/>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-2">
                        <Link
                            :href="route('cemeteries.index')"
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
