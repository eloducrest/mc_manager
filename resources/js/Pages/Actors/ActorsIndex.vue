<script setup lang="ts">
import {Head, usePage} from "@inertiajs/vue3";
import {onMounted, onUpdated, ref} from "vue";
import {useActorsStore} from "@/stores/actors";
import {useHandleModalsStore} from "@/stores/handleModals";
import ActorCard from "@/Components/Actors/ActorCard.vue";
import ActorCostumesCard from "@/Components/Actors/ActorCostumesCard.vue";
import ActorsDatatable from "@/Components/Actors/ActorsDatatable.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import DeletingActor from "@/Components/Actors/DeletingActor.vue";
import Modal from "@/Components/Modal/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DropdownButton from "@/Components/Buttons/DropdownButton.vue";
import {ActorInterface} from "@/interfaces/ActorInterface";
import ImportsCard from "@/Components/ImportsCard.vue";

onMounted(() => {
  useActorsStore().setActors(usePage().props.actors as ActorInterface[])
})
onUpdated(() => {
  useActorsStore().setActors(usePage().props.actors as ActorInterface[])
})

const dropdownContent = [
  {
    name: 'Télécharger',
    route: route('exports.actors'),
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>'
  },
  {
    name: 'Importer',
    action: () => useHandleModalsStore().toggleModalImport(),
    icon: '<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg>'
  }
];
</script>

<template>
  <Head title="Les acteurs"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault :pageTitle="'Acteurs'"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="dataTable-search flex justify-between mb-4">
          <div class="relative h-fit">
            <input class="search block w-full min-w-90 max-w-max"
                   id="search-actor"
                   v-model="useActorsStore().searchValue"
                   placeholder="Rechercher un acteur..." type="text">
            <button type="submit" class="absolute end-2.5 bottom-2.5" @click="useActorsStore().searchValue = ''">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512" width="16" height="16">
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
              </svg>
            </button>
          </div>

          <div class="flex gap-4">
            <PrimaryButton class="flex items-center"
                           @click="useHandleModalsStore().is_open_modal_actor = true; useActorsStore().isUpdate = false">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
              </svg>
              <span class="ml-2.5">Ajouter</span>
            </PrimaryButton>

            <DropdownButton :contents="dropdownContent"/>
          </div>
        </div>

        <actors-datatable/>
      </div>
    </div>

    <Modal :show="useHandleModalsStore().is_open_modal_actor"
           @close="useHandleModalsStore().toggleModalActor">
      <actor-card/>
    </Modal>

    <Modal :show="useHandleModalsStore().is_open_modal_actor_handle_costumes"
           max-width="6xl" min-height="min-content"
           @close="useHandleModalsStore().toggleModalActorHandleCostumes">
      <actor-costumes-card/>
    </Modal>

    <Modal :show="useHandleModalsStore().is_open_modal_actor_delete"
           :min-height="'min-content'"
           @close="useHandleModalsStore().toggleModalActorDelete">
      <deleting-actor/>
    </Modal>

    <Modal :show="useHandleModalsStore().is_open_modal_import"
           @close="useHandleModalsStore().toggleModalImport">
      <ImportsCard title="Importer des acteurs" :route="route('imports.downloadExampleFile', {file: 'actors_import_example.xlsx'})"/>
    </Modal>
  </AuthenticatedLayout>
</template>
