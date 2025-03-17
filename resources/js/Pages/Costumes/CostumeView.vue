<script setup lang="ts">
import {computed, onMounted, onUpdated, ref, useTemplateRef} from "vue";
import {Head, usePage} from "@inertiajs/vue3";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import {useUtils} from "@/composables/utils";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import CostumeCard from "@/Components/Costumes/CostumeCard.vue";
import CostumeHistoryDatatable from "@/Components/Costumes/CostumeHistoryDatatable.vue";
import Modal from "@/Components/Modal/Modal.vue";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import LightButton from "@/Components/LightButton.vue";
import DarkButton from "@/Components/Buttons/DarkButton.vue";
import CostumeAssignCostumeToActorCard from "@/Components/Costumes/CostumeAssignCostumeToActorCard.vue";
import CostumeReturnCard from "@/Components/Costumes/CostumeReturnCard.vue";
import DangerButton from "@/Components/DangerButton.vue";
import CostumeDeletingCard from "@/Components/Costumes/CostumeDeletingCard.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";

const costumeStore = useCostumestore();
costumeStore.setSelectedCostume(usePage().props.costume as CostumeInterface)

onMounted(() => {
  costumeStore.setSelectedCostume(usePage().props.costume as CostumeInterface)
})

onUpdated(() => {
  costumeStore.setSelectedCostume(usePage().props.costume as CostumeInterface)
})

const modalStore = useHandleModalsStore();
const historyRefEl = useTemplateRef('historyRefEl');
const {scrollToRef} = useUtils();

const currentCostumeHistory = computed(() => {
  return costumeStore.selectedCostume.current_costume_history ? [costumeStore.selectedCostume.current_costume_history] : []
})

const canBeAssociateToActor = computed(() => {
  return !costumeStore.selectedCostume.is_to_be_repaired
    && !costumeStore.selectedCostume.current_costume_history;
});
</script>

<template>
  <Head :title="`Costume : ${costumeStore.selectedCostume.name}`"/>

  <AuthenticatedLayout>

    <BreadcrumbDefault :pageTitle="'Fiche costume : ' + costumeStore.selectedCostume.name"
                       :pageLabel="costumeStore.selectedCostume.name"
                       :links="[{route: route('costumes.index'), label: 'Costumes'}]"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mb-8 flex justify-end items-center">
          <div class="font-bold mr-auto flex items-center gap-3 text-xl text-red-500"
               v-if="costumeStore.selectedCostume.is_to_be_repaired">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
              <path fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M19.252 14.407a6.823 6.823 0 0 1-6.532 1.776a2.016 2.016 0 0 0-1.95.487l-4.28 4.294a.974.974 0 0 1-1.385 0l-2.067-2.069a.976.976 0 0 1 0-1.385l4.28-4.284a1.952 1.952 0 0 0 .488-1.951a6.835 6.835 0 0 1 1.912-6.65a6.823 6.823 0 0 1 6.736-1.566l-2.925 2.927c-.75.752-1.112 2.342-.341 3.103l1.715 1.727c.76.761 2.35.41 3.11-.351l2.925-2.927a6.836 6.836 0 0 1-1.686 6.869"/>
            </svg>
            Costume en réparation
          </div>
          <div class="font-bold mr-auto flex items-center gap-3 text-xl text-red-500"
               v-if="costumeStore.selectedCostume.current_costume_history">
            <div data-v-805c2598="" class="h-4 w-4 rounded-full bg-red-600"></div>
            Costume non disponible
          </div>
          <primary-button @click="costumeStore.isUpdate = true; modalStore.toggleModalCostume()"
                          class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></g></svg>
            <span class="ml-2 5">Modifier le costume</span>
          </primary-button>
          <light-button v-if="canBeAssociateToActor"
                        @click="modalStore.toggleModalCostumeAssignCostumeToActor"
                        class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 448 512">
              <path
                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
            </svg>
            <span class="ml-2.5">Associer à un acteur</span>
          </light-button>
          <dark-button class="flex items-center"
                       @click="scrollToRef(historyRefEl)">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
              <path fill="#ffffff"
                    d="M75 75L41 41C25.9 25.9 0 36.6 0 57.9L0 168c0 13.3 10.7 24 24 24l110.1 0c21.4 0 32.1-25.9 17-41l-30.8-30.8C155 85.5 203 64 256 64c106 0 192 86 192 192s-86 192-192 192c-40.8 0-78.6-12.7-109.7-34.4c-14.5-10.1-34.4-6.6-44.6 7.9s-6.6 34.4 7.9 44.6C151.2 495 201.7 512 256 512c141.4 0 256-114.6 256-256S397.4 0 256 0C185.3 0 121.3 28.7 75 75zm181 53c-13.3 0-24 10.7-24 24l0 104c0 6.4 2.5 12.5 7 17l72 72c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-65-65 0-94.1c0-13.3-10.7-24-24-24z"/>
            </svg>
            <span class="ml-2 5">Voir l'historique</span>
          </dark-button>
          <danger-button @click="useHandleModalsStore().toggleModalCostumeDeleting()">
            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z" fill=""></path>
              <path d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z" fill=""></path>
              <path d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z" fill=""></path>
              <path d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z" fill=""></path>
            </svg>
            <span class="ml-2.5">Supprimer</span>
          </danger-button>
<!--
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
                <dropdown-link href="#" class="flex items-center hover:bg-primary hover:text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 512 512">
                    <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z"/>
                  </svg>
                  <span class="ml-2.5">Modifier</span>
                </dropdown-link>
                <dropdown-link href="#" class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                  </svg>
                  <span class="ml-2.5">Associer à un acteur</span>
                </dropdown-link>
                <dropdown-link href="#" class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="M11 16V7.85l-2.6 2.6L7 9l5-5l5 5l-1.4 1.45l-2.6-2.6V16zm-5 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/>
                  </svg>
                  <span class="ml-2.5">Supprimer</span>
                </dropdown-link>
              </template>
            </dropdown>
-->
        </div>
        <div class="mx-auto flex flex-col items-center text-center md:flex-row md:items-start md:text-left">
          <div class="mb-4 md:mr-6 md:mb-0">
            <img class="rounded-lg object-cover md:w-56"
                 :src="costumeStore.selectedCostume.img_url" alt=""/>
          </div>
          <div class="flex-1">
            <p class="text-2xl font-medium text-gray-700"
               v-text="costumeStore.selectedCostume.number + ' : ' + costumeStore.selectedCostume.name"></p>
            <p class="mb-4 text-sm font-medium text-gray-500"
               v-text="costumeStore.selectedCostume.description ?? 'Aucune description'"></p>
            <div class="mb-4 flex space-x-2 justify-between">
              <div class="flex-1 flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">État</p>
                <p class="text-xl font-medium text-gray-600" v-text="costumeStore.selectedCostume.condition"></p>
              </div>
              <div class="flex-1 flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Genre</p>
                <p class="text-xl font-medium text-gray-600" v-text="costumeStore.selectedCostume.gender"></p>
              </div>
              <div class="flex-1 flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Taille</p>
                <p class="text-xl font-medium text-gray-600 uppercase"
                   v-text="costumeStore.selectedCostume.size?.name ?? 'N.C'"></p>
              </div>
              <div class="flex-1 flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Période</p>
                <p class="text-xl font-medium text-gray-600"
                   v-text="costumeStore.selectedCostume.period?.name ?? 'N.C'"></p>
              </div>
              <div class="flex-1 flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Catégorie</p>
                <p class="text-xl font-medium text-gray-600"
                   v-text="costumeStore.selectedCostume.category?.name ?? 'N.C'"></p>
              </div>
              <div class="flex-1 flex flex-col items-center rounded-xl bg-gray-100 px-4 py-2">
                <p class="text-sm font-medium text-gray-500">Caution</p>
                <p class="text-xl font-medium text-gray-600"
                   v-text="costumeStore.selectedCostume.deposit ? costumeStore.selectedCostume.deposit + ' €' : 'N.C'"></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <h2 class="mb-4">DÉTENTEUR ACTUEL</h2>
        <costume-history-datatable :costumes="currentCostumeHistory"
                                   :except-headers="['return_condition', 'amount_returned_deposit', 'is_to_be_repaired', 'returned_at']"
                                   :hide-footer="true"/>
      </div>

      <div id="test" class="mt-5 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
           ref="historyRefEl">
        <h2 class="mb-4">HISTORIQUE DES ACTEURS</h2>
        <costume-history-datatable :costumes="costumeStore.selectedCostume.inactive_costume_histories"
                                   :except-headers="['actions']"/>
      </div>
    </div>

    <Modal :show="modalStore.is_open_modal_costume"
           @close="modalStore.toggleModalCostume">
      <costume-card :redirect="{route_name:'costumes.view', id:costumeStore.selectedCostume.id}"/>
    </Modal>

    <Modal :show="modalStore.is_open_modal_costume_assign_costume_to_actor"
           :min-height="'min-content'"
           @close="modalStore.toggleModalCostumeAssignCostumeToActor">
      <costume-assign-costume-to-actor-card
        :redirect="{route_name: 'costumes.view', id:costumeStore.selectedCostume.id}"/>
    </Modal>

    <Modal :show="modalStore.is_open_modal_costume_return"
           @close="modalStore.toggleModalCostumeReturn">
      <costume-return-card :redirect="{route_name: 'costumes.view', id: useCostumestore().selectedCostume.id}"/>
    </Modal>

    <Modal :show="modalStore.is_open_modal_costume_deleting"
           :min-height="'min-content'"
           @close="modalStore.toggleModalCostumeDeleting">
      <costume-deleting-card></costume-deleting-card>
    </Modal>

  </AuthenticatedLayout>
</template>
