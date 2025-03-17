<script setup lang="ts">
import Multiselect from "vue-multiselect";
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";

const emit = defineEmits(['change']);

let filtering_options = ref({
  periods: null,
  sizes: null,
  categories: null,
  genders: null
});

const initial_filtering_options = () => (
  {
    periods: null,
    sizes: null,
    categories: null,
    genders: null
  }
);

const formData = ref(initial_filtering_options());

const resetFilters = () => {
  formData.value = initial_filtering_options();
  emit('change', formData.value);
}
</script>

<template>
  <div class="mb-5">
    <div class="dataTable-search grid grid-cols-4 gap-8 mb-4">
      <div class="flex flex-col w-full">
        <label class="typo__label">Genres</label>
        <multiselect :options="usePage().props.costumes_settings.genders"
                     v-model="formData.genders"
                     placeholder="Séléctionner un genre"
                     track-by="name"
                     label="name"
                     :multiple="true"
                     :close-on-select="false"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', formData)"
                     @select="emit('change', formData)"></multiselect>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Tailles</label>
        <multiselect :options="usePage().props.costumes_settings.sizes"
                     v-model="formData.sizes"
                     placeholder="Séléctionner une taille"
                     track-by="id"
                     label="name"
                     :multiple="true"
                     :close-on-select="false"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', formData)"
                     @select="emit('change', formData)"></multiselect>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Périodes</label>
        <multiselect :options="usePage().props.costumes_settings.periods"
                     v-model="formData.periods"
                     placeholder="Séléctionner une période"
                     track-by="id"
                     label="name"
                     :multiple="true"
                     :close-on-select="false"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', formData)"
                     @select="emit('change', formData)"></multiselect>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Catégories</label>
        <multiselect :options="usePage().props.costumes_settings.categories"
                     v-model="formData.categories"
                     placeholder="Séléctionner une catégory"
                     track-by="id"
                     label="name"
                     :multiple="true"
                     :close-on-select="false"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', formData)"
                     @select="emit('change', formData)"></multiselect>
      </div>
    </div>
    <div>
      <div @click="resetFilters" class="text-sm italic hover:underline cursor-pointer">Supprimer les filtres</div>
    </div>
  </div>
</template>
