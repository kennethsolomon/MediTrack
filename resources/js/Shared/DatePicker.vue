<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <vue-tailwind-datepicker :id="id" v-bind="{ ...$attrs, class: null }" v-model="selected" as-single placeholder="Date" :formatter="formatter" style="background-color: white; color: black" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
import VueTailwindDatepicker from 'vue-tailwind-datepicker'

export default {
  components: {
    VueTailwindDatepicker,
  },
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `date-picker-${uuid()}`
      },
    },
    error: String,
    label: String,
    modelValue: Array,
    formatter: {
      type: Object,
      default() {
        return {
          date: 'YYYY-MM-DD',
          month: 'MMM',
        }
      },
    },
  },
  emits: ['update:modelValue'],
  data() {
    return {
      selected: this.modelValue,
    }
  },
  watch: {
    selected(selected) {
      this.$emit('update:modelValue', selected)
    },
  },
}
</script>
