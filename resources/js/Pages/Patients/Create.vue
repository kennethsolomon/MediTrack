<template>
  <div>
    <Head title="Create Patient" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/patients">Patients</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow ">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.first_name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First Name" />
          <text-input v-model="form.last_name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last Name" />
          <text-input v-model="form.middle_name" :error="form.errors.middle_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Middle Name" />
          <text-input v-model="form.suffix_name" :error="form.errors.suffix_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Suffix Name" />
          <select-input v-model="form.gender" :error="form.errors.gender" class="pb-8 pr-6 w-full lg:w-1/2" label="Gender">
            <option :value="null" />
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Female">Others</option>
          </select-input>
          <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
          <date-picker v-model="form.birth_date" label="Birthdate" class="pb-8 pr-6 w-full lg:w-1/2" />
          <div class="pb-8 pr-6 w-full lg:w-1/2">
            <label class="form-label" for="age">Age:</label>
            <input id="age" v-model="form.age" disabled class="form-input" />
          </div>
          <text-input v-model="form.place_of_birth" :error="form.errors.place_of_birth" class="pb-8 pr-6 w-full lg:w-1/2" label="Place of birth" />
          <text-input v-model="form.religion" :error="form.errors.religion" class="pb-8 pr-6 w-full lg:w-1/2" label="Religion" />
          <text-input v-model="form.nationality" :error="form.errors.nationality" class="pb-8 pr-6 w-full lg:w-1/2" label="Nationality" />
          <text-input v-model="form.civil_status" :error="form.errors.civil_status" class="pb-8 pr-6 w-full lg:w-1/2" label="Civil Status" />
          // Avatar
          // Status default to active No need to add just for reference
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Patient</loading-button>
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
import DatePicker from '@/Shared/DatePicker.vue'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    DatePicker,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        first_name: null,
        last_name: null,
        middle_name: null,
        suffix_name: null,
        gender: null,
        address: null,
        birth_date: [],
        age: 0,
        place_of_birth: null,
        religion: null,
        nationality: null,
        civil_status: null,
        avatar: null, // confirm if need to be deleted
        status: null, // automatic to Active in the backend
      }),
    }
  },
  watch:{
    'form.birth_date': function (newVal, oldVal){
      if(newVal != null){
        var today = new Date()
        var birthDate = new Date(newVal)
        var age = today.getFullYear() - birthDate.getFullYear()
        var m = today.getMonth() - birthDate.getMonth()
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--
        }
        this.form.age = age
      }
    },
  },
  methods: {
    async store() {
      await this.form.post('/patients', {
        onSuccess: () => this.form.reset(),
      })
    },
  },
}
</script>
