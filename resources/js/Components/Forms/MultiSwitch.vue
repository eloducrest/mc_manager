<script setup lang="ts">
import {ref, watch} from "vue";

const props = withDefaults(
  defineProps<{
    state?: 'all' | 'unavailable' | 'repaired';
  }>(),
  {
    state: 'all',
  }
);

const emit = defineEmits<{
  (event: 'change', value: 'all' | 'unavailable' | 'repaired'): void;
}>();

const picked = ref(props.state)

watch(() => props.state, (newValue) => {
  picked.value = newValue;
});

watch(picked, (newValue) => {
  emit('change', newValue)
});
</script>

<template>
<div class="flex items-center">
  <div class="inline-flex overflow-hidden border border-gray-200 rounded-lg">
    <label for="all" class="cursor-pointer">
      <input type="radio" id="all"
             name="status"
             value="all"
             class="sr-only peer"
             v-model="picked"
             :checked="picked === 'all'">
      <span class="relative inline-flex items-center h-full py-2 pr-3 space-x-2 text-sm pl-7 peer-checked:bg-blue-200">
        <span class="before:w-2 before:h-2 before:bg-blue-500 before:rounded-full before:absolute before:top-[14px] before:left-3">Tous</span>
      </span>
    </label>
    <label for="unavailable" class="cursor-pointer">
      <input type="radio" id="unavailable"
             name="status"
             value="unavailable"
             class="sr-only peer"
             v-model="picked"
             :checked="picked === 'unavailable'">
      <span class="relative inline-flex items-center h-full py-2 pr-3 space-x-2 text-sm pl-7 peer-checked:bg-red-200">
        <span class="before:w-2 before:h-2 before:bg-red-500 before:rounded-full before:absolute before:top-[14px] before:left-3">Indisponible</span>
      </span>
    </label>
    <label for="repaired" class="cursor-pointer">
      <input type="radio" id="repaired"
             name="status"
             value="repaired"
             class="sr-only peer"
             v-model="picked"
             :checked="picked === 'repaired'">
      <span class="relative inline-flex items-center h-full py-2 pr-3 space-x-2 text-sm pl-7 peer-checked:bg-orange-200">
        <span class="before:w-2 before:h-2 before:bg-orange-500 before:rounded-full before:absolute before:top-[14px] before:left-3">Réparation</span>
      </span>
    </label>
  </div>
</div>
</template>
