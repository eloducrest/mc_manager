<script setup lang="ts">
import {ref} from "vue";
import {Head, usePage} from "@inertiajs/vue3";
import {useAlertsStore} from "@/stores/alerts";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import CostumeAssignCostumeToActorCard from "@/Components/Costumes/CostumeAssignCostumeToActorCard.vue";
import CostumeCard from "@/Components/Costumes/CostumeCard.vue";
import CostumesDatatable from "@/Components/Costumes/CostumesDatatable.vue";
import CostumeDeletingCard from "@/Components/Costumes/CostumeDeletingCard.vue";
import CostumesFilters from "@/Components/Costumes/CostumesFilters.vue";
import CostumeIsToBeRepairedCard from "@/Components/Costumes/CostumeIsToBeRepairedCard.vue";
import CostumeReturnCard from "@/Components/Costumes/CostumeReturnCard.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import LightButton from "@/Components/LightButton.vue";
import Modal from "@/Components/Modal/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

useCostumestore().setCostumes(usePage().props.costumes)

const modalsStore = useHandleModalsStore();
const alertsStore = useAlertsStore();

const searchValue = ref('');
const filtering_options = ref({});

const filterCostume = (data) => {
  filtering_options.value = data;
  useCostumestore().filteringCostume(filtering_options.value, route('accessories.search'))
    .then((data) => {
    })
    .catch((e) => alertsStore.error('Une erreur est survenue lors de la recherche...'))
}
</script>

<template>
  <Head title="Les accessoires"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Les accessoire</h2>
    </template>
    <BreadcrumbDefault :pageTitle="'Accessoires'"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="dataTable-search flex justify-between mb-4">
          <div class="relative h-fit">
            <input class="search block w-full min-w-72 max-w-max" v-model="useCostumestore().searchValue"
                   placeholder="Rechercher un accessoire..." type="text">
            <button type="submit" class="absolute end-2.5 bottom-2.5" @click="useCostumestore().searchValue = ''">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512" width="16" height="16">
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
              </svg>
            </button>
          </div>
          <div class="flex gap-4">
            <PrimaryButton class="flex items-center"
                           @click="modalsStore.is_open_modal_costume = true; useCostumestore().isUpdate = false">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
              </svg>
              <span class="ml-2.5">Ajouter</span>
            </PrimaryButton>
            <dropdown>
              <template #trigger>
                <light-button class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="m21.6 23l-3.075-3.05q-.45.275-.962.413T16.5 20.5q-1.65 0-2.825-1.175T12.5 16.5t1.175-2.825T16.5 12.5t2.825 1.175T20.5 16.5q0 .575-.15 1.088t-.425.962L23 21.6zM5.5 20.5q-1.65 0-2.825-1.175T1.5 16.5t1.175-2.825T5.5 12.5t2.825 1.175T9.5 16.5t-1.175 2.825T5.5 20.5m0-2q.825 0 1.412-.587T7.5 16.5t-.587-1.412T5.5 14.5t-1.412.588T3.5 16.5t.588 1.413T5.5 18.5m11 0q.825 0 1.413-.587T18.5 16.5t-.587-1.412T16.5 14.5t-1.412.588T14.5 16.5t.588 1.413t1.412.587m-11-9q-1.65 0-2.825-1.175T1.5 5.5t1.175-2.825T5.5 1.5t2.825 1.175T9.5 5.5T8.325 8.325T5.5 9.5m11 0q-1.65 0-2.825-1.175T12.5 5.5t1.175-2.825T16.5 1.5t2.825 1.175T20.5 5.5t-1.175 2.825T16.5 9.5m-11-2q.825 0 1.413-.587T7.5 5.5t-.587-1.412T5.5 3.5t-1.412.588T3.5 5.5t.588 1.413T5.5 7.5m11 0q.825 0 1.413-.587T18.5 5.5t-.587-1.412T16.5 3.5t-1.412.588T14.5 5.5t.588 1.413T16.5 7.5m0-2"/>
                  </svg>
                  <span class="ml-2.5">Actions</span>
                </light-button>
              </template>
              <template #content>
                <dropdown-link href="#" class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                  </svg>
                  <span class="ml-2.5">Télécharger</span>
                </dropdown-link>
                <dropdown-link href="#" class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                  </svg>
                  <span class="ml-2.5">Importer</span>
                </dropdown-link>
              </template>
            </dropdown>
          </div>
        </div>

        <costumes-filters @change="filterCostume"></costumes-filters>

        <costumes-datatable></costumes-datatable>
      </div>
    </div>

    <Modal :show="modalsStore.is_open_modal_costume"
           @close="modalsStore.toggleModalCostume">
      <costume-card :settings="usePage().props.costumes_settings"></costume-card>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_assign_costume_to_actor"
           :min-height="'min-content'"
           @close="modalsStore.toggleModalCostumeAssignCostumeToActor">
      <costume-assign-costume-to-actor-card></costume-assign-costume-to-actor-card>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_return"
           @close="modalsStore.toggleModalCostumeReturn">
      <costume-return-card :settings="usePage().props.costumes_settings"></costume-return-card>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_deleting"
           :min-height="'min-content'"
           @close="modalsStore.toggleModalCostumeDeleting">
      <costume-deleting-card></costume-deleting-card>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_id_to_be_repair"
           @close="modalsStore.toggleModalCostumeIsToBeRepair">
      <costume-is-to-be-repaired-card :settings="usePage().props.costumes_settings"></costume-is-to-be-repaired-card>
    </Modal>

  </AuthenticatedLayout>
</template>
