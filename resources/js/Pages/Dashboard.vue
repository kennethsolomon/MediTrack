<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

import TextInput from "@/Components/FormInputs/TextInput.vue";

const form_medicine = useForm({
    name: "",
});

function submit(route_name, form) {
    form_medicine.post(route(route_name), {
        onSuccess: () => (form_medicine.name = ""),
    });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit('medicine.store', form_medicine)">
                    <TextInput
                        id="medicine"
                        name="name"
                        type="text"
                        v-model="form_medicine.name"
                        placeholder="Medicine Name"
                        color="primary"
                        size="md"
                        autofocus
                    />
                    <div v-if="form_medicine.errors.password">
                        {{ form_medicine.errors.name }}
                    </div>

                    <button
                        type="submit"
                        :disabled="form_medicine.processing"
                        class="btn btn-active btn-primary"
                    >
                        Save
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
