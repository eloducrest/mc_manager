<script setup lang="ts">
defineProps<{
  message?: string|null;
}>();
</script>

<template>
  <p v-if="message"
     class="mt-1 text-sm text-red-600 dark:text-red-500"
     v-text="message"></p>
</template>
