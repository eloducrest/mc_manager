import {LocationInterface} from "@/interfaces/LocationInterface";
import {router} from "@inertiajs/vue3";
import {useLocationsStore} from "@/stores/locations";
import {useHandleModalsStore} from "@/stores/handleModals";
import type { Header } from "vue3-easy-data-table";

export const headers: Header[] = [
  {text: "Code", value: "code", sortable: true},
  {text: "Nom", value: "name", sortable: true},
  {text: "Description", value: "description"},
  {text: "Costumes/Accessoires", value: "costumes"},
  {text: "Actions", value: "actions"},
];

export const table_actions = [
  {
    type: 'quick_view',
    method: (location: LocationInterface) => {
      useLocationsStore().selectedLocation = location;
      useHandleModalsStore().toggleModalQuickViewLocation();
    },
    title: 'Gestion rapide',
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
    title: 'Voir l\'emplacement',
    method: (location: LocationInterface) => {
      router.get(route('locations.show', location.id), {
        method: 'get',
      })
    },
    btn_class: 'hover:text-orange-700 cursor-pointer',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 24 24"><path fill="currentColor" d="M16.5 20h1v-4h-1zm.5-5q.2 0 .35-.15t.15-.35t-.15-.35T17 14t-.35.15t-.15.35t.15.35t.35.15M5 4v16zv5zm2 10h3.675q.275-.575.638-1.075t.812-.925H7zm0 4h3.075Q10 17.5 10 17t.075-1H7zm-2 4q-.825 0-1.412-.587T3 20V4q0-.825.588-1.412T5 2h8l6 6v2.3q-.475-.15-.975-.225T17 10V9h-5V4H5v16h5.675q.275.575.638 1.075t.812.925zm12-10q2.075 0 3.538 1.463T22 17t-1.463 3.538T17 22t-3.537-1.463T12 17t1.463-3.537T17 12"/></svg>`
  },
];

export const searchFields = ['code', 'name']
