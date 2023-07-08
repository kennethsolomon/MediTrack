<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
    <p class="mb-8 leading-normal">Hey there! Welcome to Ping CRM, a demo app designed to help illustrate how <a class="text-indigo-500 hover:text-orange-600 underline" href="https://inertiajs.com">Inertia.js</a> works.</p>
  </div>
  <!-- <vue-tailwind-datepicker v-model="dateValue" as-single placeholder="Date" :formatter="formatter" style="background-color: white; color: black" /> -->


  <date-picker v-model="dateValue" label="test" />
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import DatePicker from '@/Shared/DatePicker.vue'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'

export default {
  components: {
    Head,
    VueTailwindDatepicker,
    DatePicker,
  },
  layout: Layout,
  data() {
    return {
      dateValue: [],
    }
  },
}
</script>
