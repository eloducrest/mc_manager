<script setup lang="ts">
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, usePage} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ToolTip from "@/Components/ToolTips/ToolTip.vue";
import {onMounted, ref} from "vue";
import Modal from "@/Components/Modal/Modal.vue";
import {useLocationsStore} from "@/stores/locations";
import {useHandleModalsStore} from "@/stores/handleModals";
import LocationCard from "@/Components/Locations/LocationCard.vue";
import {headers, table_actions, searchFields} from "@/datatables/locationsDatatable";

let searchValue = ref('');
const { locations } = usePage().props
const locationStore = useLocationsStore();
const modalsStore = useHandleModalsStore();

onMounted(() => {
  locationStore.setLocations(locations)
})
</script>

<template>
  <Head title="Les emplacement"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault pageTitle="Emplacements"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="dataTable-search flex justify-between mb-4">
          <div class="relative h-fit">
            <input class="search block w-full min-w-72 max-w-max"
                   v-model="searchValue"
                   placeholder="Rechercher un emplacement..." type="text">
            <button type="submit" class="absolute end-2.5 bottom-2.5" @click="">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512" width="16" height="16">
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
              </svg>
            </button>
          </div>
          <div class="flex gap-4">
            <PrimaryButton class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
              </svg>
              <span class="ml-2.5">Ajouter</span>
            </PrimaryButton>
          </div>
        </div>

        <EasyDataTable
          table-class-name="customize-table"
          :headers="headers"
          :items="locations"
          :search-value="searchValue"
          :search-field="searchFields"
          alternating>
          <template #item-costumes="{ costumes }">
                <span v-if="costumes"
                      v-text="costumes.length"></span>
            <span v-else>∅</span>
          </template>
          <template #item-actions="location">
            <div class="operation-wrapper flex items-center gap-x-3 pr-4">
              <template v-for="action in table_actions">
                <div :class="action.btn_class"
                     @click="action.method(location)">
                  <tool-tip :tooltiptext="action.title">
                    <template v-slot:tooltipable>
                      <span v-html="action.icon"></span>
                    </template>
                  </tool-tip>
                </div>
              </template>
            </div>
          </template>
        </EasyDataTable>

      </div>
    </div>

    <Modal :show="modalsStore.is_open_modal_quick_view_location"
           @close="modalsStore.toggleModalQuickViewLocation"
           max-width="6xl">
      <location-card></location-card>
    </Modal>

  </AuthenticatedLayout>
</template>

<style scoped>
.customize-table {
  --easy-table-header-font-size: 14px;
  --easy-table-header-item-padding: 10px 15px;

  --easy-table-body-row-font-size: 14px;
  --easy-table-body-item-padding: 10px 15px;

  --easy-table-body-row-hover-font-color: #2d3a4f;
}
</style>
