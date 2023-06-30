<template>
  <div>
    <Head :title="`${form.name}`" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/medicines">Medicines</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="medicine.deleted_at" class="mb-6" @restore="restore"> This medicine has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!medicine.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete medicine</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update medicine</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import { tools } from '@/Helpers/tools.js'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    // Sample usage of toolt.js
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    medicine: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.medicine.name,
      }),
    }
  },
  mounted() {
    // Sample usage of tools.js
    console.log(tools.toSlug(this.medicine.name))
  },
  methods: {
    update() {
      this.form.put(`/medicines/${this.medicine.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this medicine?')) {
        this.$inertia.delete(`/medicines/${this.medicine.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this medicine?')) {
        this.$inertia.put(`/medicines/${this.medicine.id}/restore`)
      }
    },
  },
}
</script>
