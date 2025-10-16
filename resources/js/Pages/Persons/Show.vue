<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    person: {
        type: Object,
        required: true,
    },
})
const person = usePage().props.person.data;
</script>

<template>
    <Head :title="`${person.firstName} ${person.lastName}`"/>

    <AuthenticatedLayout>
        <div class="max-w-5xl mx-auto p-6 space-y-6">

            <!-- Person Card -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden flex flex-col md:flex-row">
                <!-- Image -->
                <div class="md:w-1/3">
                    <img
                        :src="person.imageUrl"
                        alt="Person image"
                        class="w-full h-full object-cover"
                    />
                </div>

                <!-- Info -->
                <div class="md:w-2/3 p-6 flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            {{ person.initials ? person.initials + ' ' : '' }}{{ person.lastName }} {{
                                person.firstName
                            }}
                        </h1>
                        <p class="text-lg text-indigo-600 mb-4">{{ person.occupation }}</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-gray-700">
                            <p>
                                <span class="font-semibold">Born:</span>
                                {{ person.birthDate }} — {{ person.birthPlace }}
                            </p>
                            <p>
                                <span class="font-semibold">Died:</span>
                                {{ person.deathDate }} — {{ person.deathPlace }}
                            </p>
                            <p>
                                <span class="font-semibold">Grave ID:</span>
                                {{ person.graveId }}
                            </p>
                        </div>

                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">Biography</h2>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                {{ person.biography }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <Link
                            :href="route('graves.show', person.graveId)"
                            class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition"
                        >
                            View Grave
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
