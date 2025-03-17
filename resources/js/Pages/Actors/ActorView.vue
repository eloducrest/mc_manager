<script setup lang="ts">
import {onMounted, onUpdated, ref} from "vue";
import {Head, usePage} from "@inertiajs/vue3";
import {useActorsStore} from "@/stores/actors";
import {useHandleModalsStore} from "@/stores/handleModals";
import ActorCard from "@/Components/Actors/ActorCard.vue";
import ActorCostumeHistoryDatatable from "@/Components/Actors/ActorCostumeHistoryDatatable.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import CostumesDatatable from "@/Components/Costumes/CostumesDatatable.vue";
import Modal from "@/Components/Modal/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import LightButton from "@/Components/LightButton.vue";
import ActorAssignCostumesToActorCard from "@/Components/Actors/ActorAssignCostumesToActorCard.vue";
import CostumeReturnCard from "@/Components/Costumes/CostumeReturnCard.vue";
import {ActorInterface} from "@/interfaces/ActorInterface";

onUpdated(() => {
  actorStore.setSelectedActor(usePage().props.actor as ActorInterface)
})

const actorStore = useActorsStore();
const modalStore = useHandleModalsStore();
const historyRefEl = ref<HTMLElement | null>(null);
actorStore.setSelectedActor(usePage().props.actor as ActorInterface);

const updateActor = (): void => {
  actorStore.isUpdate = true;
  useHandleModalsStore().toggleModalActor()
}
</script>

<template>
  <Head :title="`Acteur : ${actorStore.selectedActor.firstname} ${actorStore.selectedActor.lastname}`"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault :pageTitle="`Fiche acteur : ${actorStore.selectedActor.firstname} ${actorStore.selectedActor.lastname}`"
                       :pageLabel="`${actorStore.selectedActor.firstname} ${actorStore.selectedActor.lastname}`"
                       :links="[{route: route('actors.index'), label: 'Acteurs'}]"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mx-auto flex flex-col items-center rounded-xl px-4 py-4 text-center md:flex-row md:items-start md:text-left">
          <div class="">
            <p class="text-2xl font-medium text-gray-800"
               v-text="`${actorStore.selectedActor.firstname} ${actorStore.selectedActor.lastname}`"></p>
            <p class="mb-4 text-sm font-medium text-gray-600"
               v-text="actorStore.selectedActor.email"></p>
            <p class="mb-4 text-sm font-medium text-gray-600"
               v-text="actorStore.selectedActor.tel"></p>
            <div class="flex space-x-2">
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Adresse</p>
                <p class="text-xl font-medium text-gray-600">
                  <span class="block" v-text="actorStore.selectedActor.address"></span>
                  <span class="block" v-text="`${actorStore.selectedActor.zip_code} ${actorStore.selectedActor.city}`"></span>
                </p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Bénévole ?</p>
                <p class="text-xl font-medium text-gray-600" v-text="actorStore.selectedActor.is_volunteer ? 'Oui' : 'Non'"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Taille</p>
                <p class="text-xl font-medium text-gray-600 uppercase" v-text="actorStore.selectedActor.size ?? 'N.C'"></p>
              </div>
              <div class="flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Taille chaussure</p>
                <p class="text-xl font-medium text-gray-600" v-text="actorStore.selectedActor.size ?? 'N.C'"></p>
              </div>
            </div>
            <div class="mb-3"></div>
            <div class="flex space-x-2">
              <PrimaryButton class="flex items-center"
                             @click="useHandleModalsStore().toggleModalActorAssignCostumeToActor()">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                  <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
                </svg>
                <span class="ml-2.5">Ajouter des costumes</span>
              </PrimaryButton>
              <LightButton class="flex items-center"
                             @click="updateActor">
                <span>Modifier l'acteur</span>
              </LightButton>
            </div>
          </div>
        </div>
      </div>

      <div id="tet" class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
           ref="historyRefEl">
        <h2>COSTUMES ACTUELLEMENT DETENUS</h2>
        <costumes-datatable :costumes="actorStore.selectedActor.current_costumes"
                            except-header="is_available"
                            :active-actions="['view', 'return']"/>
      </div>

      <div id="test" class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
           ref="historyRefEl">
        <h2>HISTORIQUE DES COSTUMES</h2>
        <actor-costume-history-datatable></actor-costume-history-datatable>
      </div>
    </div>

    <Modal :show="modalStore.is_open_modal_actor"
           @close="modalStore.toggleModalActor">
      <actor-card redirect="actors.view"></actor-card>
    </Modal>

    <Modal :show="modalStore.is_open_modal_actor_assign_costume_to_actor"
           min-height="min-content"
           @close="modalStore.toggleModalActorAssignCostumeToActor">
      <actor-assign-costumes-to-actor-card redirect="actors.view"></actor-assign-costumes-to-actor-card>
    </Modal>

    <Modal :show="modalStore.is_open_modal_costume_return"
           @close="modalStore.toggleModalCostumeReturn">
      <costume-return-card redirect="actors.view"></costume-return-card>
    </Modal>
  </AuthenticatedLayout>
</template>
