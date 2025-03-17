import type { Header } from "vue3-easy-data-table";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import {useHandleModalsStore} from "@/stores/handleModals";
import {useCostumestore} from "@/stores/costumes";

export const headers: Header[] = [
  {text: "Acteur", value: "actor_name", sortable: true},
  {text: "Caution laissée", value: "amount_deposit", sortable: true},
  {text: "Etat de récupération", value: "take_condition", sortable: true},
  {text: "Etat de retour", value: "return_condition", sortable: true},
  {text: "Caution rendue", value: "amount_returned_deposit", sortable: true},
  {text: "Réparation", value: "is_to_be_repaired", sortable: true},
  {text: "Récupéré le", value: "created_at", sortable: true},
  {text: "Retourné le", value: "returned_at", sortable: true},
  {text: "Actions", value: "actions"},
];

export const table_actions = [
  {
    type: 'return',
    title: 'L\'acteur retourne le costume ?',
    method: (costume: CostumeInterface) => {
      useCostumestore().selectedCostume = costume;
      useHandleModalsStore().toggleModalCostumeReturn();
    },
    btn_class: 'hover:text-blue-700 cursor-pointer',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 11h-6"/></g></svg>`
  }
]
