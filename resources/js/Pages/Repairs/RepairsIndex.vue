<script setup lang="ts">
import {Head, router, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import Modal from "@/Components/Modal/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useHandleModalsStore} from "@/stores/handleModals";
import RepairedCostumeCard from "@/Components/Repairs/RepairedCostumeCard.vue";
import {useCostumestore} from "@/stores/costumes";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import {ref} from "vue";
import ToolTip from "@/Components/ToolTips/ToolTip.vue";

const headers = [
  {text: "", value: "img_url"},
  {text: "Numéro", value: "number", sortable: true},
  {text: "Nom", value: "name", sortable: true},
  {text: "Disponible", value: "is_available"},
  {text: "Etat", value: "condition", sortable: true},
  {text: "Commentaire", value: "comments", sortable: true},
  {text: "Actions", value: "actions"},
];

const modalStore = useHandleModalsStore();
const costumeStore = useCostumestore();
const table_actions = [
  {
    type: 'view',
    title: 'Voir le costume',
    method: (costume: CostumeInterface) => {
      router.get(route('costumes.view', costume), {
        method: 'get',
      })
    },
    btn_class: 'hover:text-orange-700 cursor-pointer',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M16.5 20h1v-4h-1zm.5-5q.2 0 .35-.15t.15-.35t-.15-.35T17 14t-.35.15t-.15.35t.15.35t.35.15M5 4v16zv5zm2 10h3.675q.275-.575.638-1.075t.812-.925H7zm0 4h3.075Q10 17.5 10 17t.075-1H7zm-2 4q-.825 0-1.412-.587T3 20V4q0-.825.588-1.412T5 2h8l6 6v2.3q-.475-.15-.975-.225T17 10V9h-5V4H5v16h5.675q.275.575.638 1.075t.812.925zm12-10q2.075 0 3.538 1.463T22 17t-1.463 3.538T17 22t-3.537-1.463T12 17t1.463-3.537T17 12"/></svg>`
  },
  {
    type: 'view',
    title: 'Marquer comme réparé',
    method: (costume: CostumeInterface) => {
      modalStore.toggleModalRepairedCostume();
      costumeStore.setSelectedCostume(costume);
    },
    btn_class: 'hover:text-orange-700 cursor-pointer',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>`
  },
];

let searchValue = ref<string>('');
</script>

<template>
  <Head title="Les réparations"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault :pageTitle="'Réparations'"/>
    <p class="mb-6 font-semibold text-base text-gray-600 leading-tight">
      Toutes les réparations des costumes et des accessoires
    </p>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="dataTable-search flex justify-between mb-4">
          <div class="relative h-fit">
            <input class="search block w-full min-w-90 max-w-max" v-model="searchValue"
                   placeholder="Rechercher un costume/accessoire..." type="text">
            <button type="submit" class="absolute end-2.5 bottom-2.5" @click="searchValue = ''">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512" width="16" height="16">
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
              </svg>
            </button>
          </div>

          <div class="flex gap-4">
            <PrimaryButton class="flex items-center"
                           @click="">
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
          :items="usePage().props.repairs"
          :search-value="searchValue"
          alternating>
          <template #item-img_url="{ img_url }">
            <td>
              <img :src="img_url" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
            </td>
          </template>
          <template #item-number="{ number }">
            <span>{{ number }}</span>
          </template>
          <template #item-is_available="{ active_costume_history, is_to_be_repaired }">
            <div v-if="is_to_be_repaired">
              <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.252 14.407a6.823 6.823 0 0 1-6.532 1.776a2.016 2.016 0 0 0-1.95.487l-4.28 4.294a.974.974 0 0 1-1.385 0l-2.067-2.069a.976.976 0 0 1 0-1.385l4.28-4.284a1.952 1.952 0 0 0 .488-1.951a6.835 6.835 0 0 1 1.912-6.65a6.823 6.823 0 0 1 6.736-1.566l-2.925 2.927c-.75.752-1.112 2.342-.341 3.103l1.715 1.727c.76.761 2.35.41 3.11-.351l2.925-2.927a6.836 6.836 0 0 1-1.686 6.869"/></svg>
            </div>
            <div v-else class="h-4 w-4 rounded-full"
                 :class="active_costume_history ? 'bg-red-600' : 'bg-green-600'"></div>
          </template>
          <template #item-comments="{ active_repair_histories }">
            <span v-if="active_repair_histories"
                  v-text="active_repair_histories.repair_comment"></span>
            <span v-else>∅</span>
          </template>
          <template #item-actions="costume">
            <div class="operation-wrapper flex items-center gap-x-3">
              <template v-for="action in table_actions">
                <div :class="action.btn_class"
                     @click="action.method(costume)">
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

    <Modal :show="modalStore.is_open_modal_repaired_costume"
           @close="modalStore.toggleModalRepairedCostume">
      <repaired-costume-card :settings="usePage().props.costumes_settings"></repaired-costume-card>
    </Modal>
  </AuthenticatedLayout>
</template>

<style scoped>
.customize-table {
  --easy-table-header-font-size: 14px;
  --easy-table-header-item-padding: 0px 5px;

  --easy-table-body-row-font-size: 14px;
  --easy-table-body-item-padding: 5px 5px;

  --easy-table-body-row-hover-font-color: #2d3a4f;
}
</style>
