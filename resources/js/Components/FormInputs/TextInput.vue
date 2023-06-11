<script setup>
import { Field, Form, ErrorMessage } from "vee-validate";

import { computed, onMounted, ref } from "vue";

const isRequired = (value) => {
    if (value && value.trim()) {
        return true;
    }
    return "This is required";
};

const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },

    placeholder: {
        type: String,
        required: true,
    },

    color: {
        type: String,
        default: "primary",
    },

    size: {
        type: String,
        default: "md",
    },

    disabled: {
        type: Boolean,
        default: false,
    },
});

// Design
const sizeClass = computed(() => {
    return {
        xs: "input-xs",
        sm: "input-sm",
        md: "input-md",
        lg: "input-lg",
    }[props.size];
});

const colorClass = computed(() => {
    return {
        primary: "input-primary",
        secondary: "input-secondary",
        accent: "input-accent",
        info: "input-info",
        success: "input-success ",
        warning: "input-warning ",
        error: "input-error ",
    }[props.color];
});

// End Design

const input = ref(null);

defineEmits(["update:modelValue"]);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <Form class="bg-inherit border-0">
        <div class="flex flex-col">
            <Field
                name="field"
                :rules="isRequired"
                class="input input-bordered w-full max-w-xs"
                :placeholder="props.placeholder"
                :class="[sizeClass, colorClass]"
                :disabled="props.disabled"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
                ref="input"
            />
            <ErrorMessage name="field" />
        </div>
    </Form>
</template>
