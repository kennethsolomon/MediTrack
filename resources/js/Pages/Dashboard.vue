<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
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
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in!
                    </div>
                    <div class="alert alert-info">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="stroke-current shrink-0 w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                        </svg>
                        <span>New software update available.</span>
                    </div>
                    <!-- Open the modal using ID.showModal() method -->
                    <button class="btn" onclick="my_modal_1.showModal()">
                        open modal
                    </button>
                    <dialog id="my_modal_1" class="modal">
                        <form method="dialog" class="modal-box">
                            <h3 class="font-bold text-lg">Hello!</h3>
                            <p class="py-4">
                                Press ESC key or click the button below to close
                            </p>
                            <div class="modal-action">
                                <!-- if there is a button in form, it will close the modal -->
                                <button class="btn">Close</button>
                            </div>
                        </form>
                    </dialog>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
