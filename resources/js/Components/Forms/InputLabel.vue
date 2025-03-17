<script setup lang="ts">
defineProps<{
    label: string;
    required: boolean
}>();
</script>

<template>
    <label class="block font-medium text-sm text-black dark:text-gray-300 mb-3">
        <span v-html="label"></span>
        <span v-if="required" class="text-meta-1">*</span>
    </label>
</template>
