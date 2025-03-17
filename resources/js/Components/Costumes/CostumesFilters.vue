<script setup lang="ts">
import Multiselect from "vue-multiselect";
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import {useCostumestore} from "@/stores/costumes";
import MultiSwitch from "@/Components/Forms/MultiSwitch.vue";

type FilteringOptions = {
  periods: [] | null;
  sizes: [] | null;
  categories: [] | null;
  genders: [] | null;
  state: 'all' | 'unavailable' | 'repaired';
};

const emit = defineEmits(['change']);

const initial_filtering_options = (): FilteringOptions => ({
  periods: [],
  sizes: [],
  categories: [],
  genders: [],
  state: 'all'
});

const selectedFilters = ref<FilteringOptions>(initial_filtering_options());

const updateState = (value) => {
  selectedFilters.value.state = value;
  emit('change', selectedFilters.value);
}

const resetFilters = () => {
  selectedFilters.value = initial_filtering_options();
  emit('change', selectedFilters.value);
}
</script>

<template>
  <div class="mb-5">
    <div class="dataTable-search grid grid-cols-4 gap-x-8 gap-y-4 mb-4">
      <div class="col-span-4">
        <multi-switch :state="selectedFilters.state"
                      @change="updateState"></multi-switch>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Genres</label>
        <multiselect id="gender"
                     :options="useCostumestore().costumeSettings.genders"
                     v-model="selectedFilters.genders"
                     placeholder="Séléctionner un genre"
                     track-by="name"
                     label="name"
                     :multiple="true"
                     :close-on-select="true"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', selectedFilters)"
                     @select="emit('change', selectedFilters)"></multiselect>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Tailles</label>
        <multiselect :options="useCostumestore().costumeSettings.sizes"
                     v-model="selectedFilters.sizes"
                     placeholder="Séléctionner une taille"
                     track-by="id"
                     label="name"
                     :multiple="true"
                     :close-on-select="true"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', selectedFilters)"
                     @select="emit('change', selectedFilters)"></multiselect>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Périodes</label>
        <multiselect :options="useCostumestore().costumeSettings.periods"
                     v-model="selectedFilters.periods"
                     placeholder="Séléctionner une période"
                     track-by="id"
                     label="name"
                     :multiple="true"
                     :close-on-select="true"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', selectedFilters)"
                     @select="emit('change', selectedFilters)"></multiselect>
      </div>

      <div class="flex flex-col w-full">
        <label class="typo__label">Catégories</label>
        <multiselect :options="useCostumestore().costumeSettings.categories"
                     v-model="selectedFilters.categories"
                     placeholder="Séléctionner une catégory"
                     track-by="id"
                     label="name"
                     :multiple="true"
                     :close-on-select="true"
                     :clear-on-select="false"
                     :searchable="false"
                     @remove="emit('change', selectedFilters)"
                     @select="emit('change', selectedFilters)"></multiselect>
      </div>
    </div>
    <div>
      <div @click="resetFilters" class="text-sm italic hover:underline cursor-pointer">Supprimer les filtres</div>
    </div>
  </div>
</template>
