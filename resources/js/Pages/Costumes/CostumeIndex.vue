<script setup lang="ts">
import {onMounted, onUpdated} from "vue";
import {Head, usePage} from "@inertiajs/vue3";
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
import Modal from "@/Components/Modal/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import DropdownButton from "@/Components/Buttons/DropdownButton.vue";

onMounted(() => {
  costumesStore.setCostumes(usePage().props.costumes as CostumeInterface[])
})
onUpdated(() => {
  costumesStore.setCostumes(usePage().props.costumes as CostumeInterface[])
})

const modalsStore = useHandleModalsStore();
const costumesStore = useCostumestore();

const filterCostume = (data) => {
  costumesStore.filteringCostume(data)
}

const dropdownContent = [
  {
    name: 'Télécharger',
    route: route('exports.costumes'),
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>'
  },
  {
    name: 'Importer',
    action: () => console.log('ok'),
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>'
  }
];
</script>

<template>
  <Head title="Les costumes"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault pageTitle="Costumes"
                       :page-title-badge="costumesStore.costumes.length"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="dataTable-search flex justify-between mb-4">
          <div class="relative h-fit">
            <input class="search block w-full min-w-72 max-w-max" v-model="costumesStore.searchValue"
                   placeholder="Rechercher un costume..." type="text">
            <button type="submit" class="absolute end-2.5 bottom-2.5" @click="costumesStore.searchValue = ''">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512" width="16" height="16">
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
              </svg>
            </button>
          </div>
          <div class="flex gap-4">
            <PrimaryButton class="flex items-center"
                           @click="modalsStore.is_open_modal_costume = true; costumesStore.isUpdate = false">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
              </svg>
              <span class="ml-2.5">Ajouter</span>
            </PrimaryButton>
            <DropdownButton :contents="dropdownContent"/>
          </div>
        </div>

        <costumes-filters @change="filterCostume"/>

        <costumes-datatable :costumes="costumesStore.costumes"/>
      </div>
    </div>

    <Modal :show="modalsStore.is_open_modal_costume"
           @close="modalsStore.toggleModalCostume">
      <costume-card/>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_assign_costume_to_actor"
           :min-height="'min-content'"
           @close="modalsStore.toggleModalCostumeAssignCostumeToActor">
      <costume-assign-costume-to-actor-card :redirect="{route_name: 'costumes.index'}"/>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_return"
           @close="modalsStore.toggleModalCostumeReturn">
      <costume-return-card :redirect="{route_name: 'costumes.index'}"/>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_deleting"
           :min-height="'min-content'"
           @close="modalsStore.toggleModalCostumeDeleting">
      <costume-deleting-card/>
    </Modal>

    <Modal :show="modalsStore.is_open_modal_costume_id_to_be_repair"
           @close="modalsStore.toggleModalCostumeIsToBeRepair">
      <costume-is-to-be-repaired-card/>
    </Modal>

  </AuthenticatedLayout>
</template>
