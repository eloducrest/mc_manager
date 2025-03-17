import type { Header } from "vue3-easy-data-table";

export const headers: Header[] = [
  {text: "Costume", value: "costume.name", sortable: true},
  {text: "Numéro", value: "costume.number", sortable: true},
  {text: "Etat de récupération", value: "take_condition", sortable: true},
  {text: "Etat de retour", value: "return_condition", sortable: true},
  {text: "Caution donnée", value: "amount_deposit", sortable: true},
  {text: "Caution rendue", value: "amount_returned_deposit", sortable: true},
  {text: "Réparation", value: "is_to_be_repaired", sortable: true},
  {text: "Récupéré le", value: "created_at", sortable: true},
  {text: "Retourné le", value: "returned_at", sortable: true},
];
