<script setup>
import { computed } from "vue";

const props = defineProps({
    size: {
        type: String,
        default: "",
    },

    color: {
        type: String,
        default: "default",
    },

    disabled: {
        type: Boolean,
        default: false,
    },
});

const sizeClass = computed(() => {
    return {
        default: "",
        : "input-btn-primary",
        neutral: "input-btn-neutral",
        secondary: "input-btn-secondary",
        accent: "input-btn-accent",
        ghost: "input-btn-ghost",
        link: "input-btn-link",
    }[props.color];
});

const colorClass = computed(() => {
    return {
        default: "",
        primary: "input-btn-primary",
        neutral: "input-btn-neutral",
        secondary: "input-btn-secondary",
        accent: "input-btn-accent",
        ghost: "input-btn-ghost",
        link: "input-btn-link",
    }[props.color];
});
</script>
<template>
    <button class="btn btn-active" :class="[colorClass]"><slot /></button>
</template>
