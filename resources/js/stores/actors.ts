import {defineStore} from 'pinia';
import {InertiaForm, router, usePage} from '@inertiajs/vue3'
import axios from "axios";
import {ActorInterface} from "@/interfaces/ActorInterface";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import {useAlertsStore} from "@/stores/alerts";
import {useHandleModalsStore} from "@/stores/handleModals";
import {CostumeHistoryInterface} from "@/interfaces/CostumeHistoryInterface";
import { Method } from '@inertiajs/core';

export interface ActorState {
  actors: ActorInterface[],
  selectedActor: ActorInterface,
  isUpdate: boolean,
  searchValue: string,
}
export const useActorsStore = defineStore('actors', {
  state: (): ActorState => ({
    actors: [],
    selectedActor: {
      id: null,
      lastname: '',
      firstname: '',
      email: '',
      tel: '',
      address: '',
      zip_code: '',
      city: '',
      is_volunteer: false,
      size: '',
      shoe_size: '',
      costumes: [] as CostumeInterface[],
      current_costumes: [] as CostumeInterface[],
      past_costume_histories: [] as CostumeInterface[]
    } as ActorInterface,
    isUpdate: false,
    searchValue: '',
  }),
  actions: {
    setActors(actors: ActorInterface[]): ActorInterface[] {
      this.actors = actors;
      return actors;
    },
    setSelectedActor(actor: ActorInterface): ActorInterface {
      this.selectedActor = actor
      return actor;
    },
    resetSelectedActor() {
      this.selectedActor = {
        id: null,
        lastname: '',
        firstname: '',
        email: '',
        tel: '',
        address: '',
        zip_code: '',
        city: '',
        is_volunteer: false,
        size: '',
        shoe_size: '',
        costumes: [] as CostumeInterface[]
      } as ActorInterface
    },
    postActor(form: InertiaForm<ActorInterface>) {
      let method  = this.isUpdate ? 'patch' : 'post';
      let endPoint= this.isUpdate ? route('actors.update') : route('actors.store');

      form.submit(<Method>method, endPoint, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          if (method === 'post') {
            useAlertsStore().success('Acteur ajouté avec succès !');
          }
          if (method === 'patch' || method === 'put') {
            useAlertsStore().success('Acteur mis à jour avec succès !')
          }
          useHandleModalsStore().toggleModalActor()
        },
        onError: (errors: any) => {
          useAlertsStore().error('Une erreur s\'est produite... Veuillez ajouter l\`acteur ultérieurement')
        },
      })
    },
    deleteActor(option: object) {
      router.delete(route('actors.delete'), option)
    },
  }
})
