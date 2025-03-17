<script setup lang="ts">
import {router} from "@inertiajs/vue3";
import {useCostumestore} from "@/stores/costumes";
import {CostumeInterface} from "@/interfaces/CostumeInterface";

export interface Props {
  searchValue?: string;
}

const props = defineProps<Props>();

const headers = [
  {text: "", value: "img_url"},
  {text: "Numéro", value: "number", sortable: true},
  {text: "Nom", value: "name", sortable: true},
  {text: "Disponible", value: "is_available"},
  {text: "Taille", value: "costume_sizes"},
  {text: "Etat", value: "condition", sortable: true},
  {text: "Genre", value: "gender", sortable: true},
  {text: "Période", value: "period.name", sortable: true},
  {text: "Catégorie", value: "category.name", sortable: true},
  {text: "Actions", value: "actions"},
];

const table_actions = [
  {
    type: 'quick_view',
    method: (costume: CostumeInterface) => {
      selected_costume = costume;
      is_open_modal_costume.value = true;
      isUpdate.value = true;
    },
    title: 'Modification rapide',
    btn_class: 'hover:text-green-700 cursor-pointer',
    icon: `<svg
            class="fill-current"
            width="22"
            height="22"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M8.99981 14.8219C3.43106 14.8219 0.674805 9.50624 0.562305 9.28124C0.47793 9.11249 0.47793 8.88749 0.562305 8.71874C0.674805 8.49374 3.43106 3.20624 8.99981 3.20624C14.5686 3.20624 17.3248 8.49374 17.4373 8.71874C17.5217 8.88749 17.5217 9.11249 17.4373 9.28124C17.3248 9.50624 14.5686 14.8219 8.99981 14.8219ZM1.85605 8.99999C2.4748 10.0406 4.89356 13.5562 8.99981 13.5562C13.1061 13.5562 15.5248 10.0406 16.1436 8.99999C15.5248 7.95936 13.1061 4.44374 8.99981 4.44374C4.89356 4.44374 2.4748 7.95936 1.85605 8.99999Z" fill="" />
            <path d="M9 11.3906C7.67812 11.3906 6.60938 10.3219 6.60938 9C6.60938 7.67813 7.67812 6.60938 9 6.60938C10.3219 6.60938 11.3906 7.67813 11.3906 9C11.3906 10.3219 10.3219 11.3906 9 11.3906ZM9 7.875C8.38125 7.875 7.875 8.38125 7.875 9C7.875 9.61875 8.38125 10.125 9 10.125C9.61875 10.125 10.125 9.61875 10.125 9C10.125 8.38125 9.61875 7.875 9 7.875Z" fill="" />
          </svg>`
  },
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
    type: 'assign',
    title: 'Assigner le costume à un acteur',
    method: (costume: CostumeInterface) => {
      selected_costume = costume;
      is_open_modal_assign.value = true;
    },
    btn_class: 'hover:text-blue-700 cursor-pointer',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="m16 11l2 2l4-4"/></g></svg>`
  },
  {
    type: 'return',
    title: 'L\'acteur retourne le costume ?',
    method: (costume: CostumeInterface) => {
      selected_costume = costume;
      is_open_modal_return.value = true;
    },
    btn_class: 'hover:text-blue-700 cursor-pointer',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 11h-6"/></g></svg>`
  },
  {
    type: 'delete',
    title: 'Supprimer le costume',
    method: (costume: CostumeInterface) => {
      selected_costume = costume;
      confirmingCostumeDeletion.value = true;
    },
    btn_class: 'hover:text-red-700 cursor-pointer',
    icon: `<svg
            class="fill-current"
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M13.7535 2.47502H11.5879V1.9969C11.5879 1.15315 10.9129 0.478149 10.0691 0.478149H7.90352C7.05977 0.478149 6.38477 1.15315 6.38477 1.9969V2.47502H4.21914C3.40352 2.47502 2.72852 3.15002 2.72852 3.96565V4.8094C2.72852 5.42815 3.09414 5.9344 3.62852 6.1594L4.07852 15.4688C4.13477 16.6219 5.09102 17.5219 6.24414 17.5219H11.7004C12.8535 17.5219 13.8098 16.6219 13.866 15.4688L14.3441 6.13127C14.8785 5.90627 15.2441 5.3719 15.2441 4.78127V3.93752C15.2441 3.15002 14.5691 2.47502 13.7535 2.47502ZM7.67852 1.9969C7.67852 1.85627 7.79102 1.74377 7.93164 1.74377H10.0973C10.2379 1.74377 10.3504 1.85627 10.3504 1.9969V2.47502H7.70664V1.9969H7.67852ZM4.02227 3.96565C4.02227 3.85315 4.10664 3.74065 4.24727 3.74065H13.7535C13.866 3.74065 13.9785 3.82502 13.9785 3.96565V4.8094C13.9785 4.9219 13.8941 5.0344 13.7535 5.0344H4.24727C4.13477 5.0344 4.02227 4.95002 4.02227 4.8094V3.96565ZM11.7285 16.2563H6.27227C5.79414 16.2563 5.40039 15.8906 5.37227 15.3844L4.95039 6.2719H13.0785L12.6566 15.3844C12.6004 15.8625 12.2066 16.2563 11.7285 16.2563Z" fill="" />
            <path d="M9.00039 9.11255C8.66289 9.11255 8.35352 9.3938 8.35352 9.75942V13.3313C8.35352 13.6688 8.63477 13.9782 9.00039 13.9782C9.33789 13.9782 9.64727 13.6969 9.64727 13.3313V9.75942C9.64727 9.3938 9.33789 9.11255 9.00039 9.11255Z" fill="" />
            <path d="M11.2502 9.67504C10.8846 9.64692 10.6033 9.90004 10.5752 10.2657L10.4064 12.7407C10.3783 13.0782 10.6314 13.3875 10.9971 13.4157C11.0252 13.4157 11.0252 13.4157 11.0533 13.4157C11.3908 13.4157 11.6721 13.1625 11.6721 12.825L11.8408 10.35C11.8408 9.98442 11.5877 9.70317 11.2502 9.67504Z" fill="" />
            <path d="M6.72245 9.67504C6.38495 9.70317 6.1037 10.0125 6.13182 10.35L6.3287 12.825C6.35683 13.1625 6.63808 13.4157 6.94745 13.4157C6.97558 13.4157 6.97558 13.4157 7.0037 13.4157C7.3412 13.3875 7.62245 13.0782 7.59433 12.7407L7.39745 10.2657C7.39745 9.90004 7.08808 9.64692 6.72245 9.67504Z" fill="" />
          </svg>`
  }
];
</script>

<template>
  <EasyDataTable
    table-class-name="customize-table"
    :headers="headers"
    :items="useCostumestore().costumes"
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
    <template #item-costume_sizes="{ size }">
                <span v-if="size"
                      v-text="size.name"></span>
      <span v-else>∅</span>
    </template>
    <template #item-is_available="{ active_actor, is_to_be_repaired }">
      <div v-if="is_to_be_repaired">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.252 14.407a6.823 6.823 0 0 1-6.532 1.776a2.016 2.016 0 0 0-1.95.487l-4.28 4.294a.974.974 0 0 1-1.385 0l-2.067-2.069a.976.976 0 0 1 0-1.385l4.28-4.284a1.952 1.952 0 0 0 .488-1.951a6.835 6.835 0 0 1 1.912-6.65a6.823 6.823 0 0 1 6.736-1.566l-2.925 2.927c-.75.752-1.112 2.342-.341 3.103l1.715 1.727c.76.761 2.35.41 3.11-.351l2.925-2.927a6.836 6.836 0 0 1-1.686 6.869"/></svg>
      </div>
      <div v-else class="h-4 w-4 rounded-full"
           :class="active_actor?.length > 0 ? 'bg-red-600' : 'bg-green-600'"></div>
    </template>
    <template #item-actions="costume">
      <div class="operation-wrapper flex items-center gap-x-3">
        <template v-for="action in table_actions">
          <div v-if="action.type === 'return' && costume.active_actor.length > 0"
               :title="action.title"
               :class="action.btn_class"
               v-html="action.icon"
               @click="action.method(costume)"></div>
          <div v-if="action.type === 'assign' && costume.active_actor.length == 0 && !costume.is_to_be_repaired"
               :title="action.title"
               :class="action.btn_class"
               v-html="action.icon"
               @click="action.method(costume)"></div>
          <div v-if="action.type !== 'return' && action.type !== 'assign'"
               :title="action.title"
               :class="action.btn_class"
               v-html="action.icon"
               @click="action.method(costume)"></div>
        </template>
      </div>
    </template>
  </EasyDataTable>
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
