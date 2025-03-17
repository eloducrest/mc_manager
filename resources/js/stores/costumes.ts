import {defineStore} from 'pinia';
import {useAlertsStore} from "@/stores/alerts";
import axios from "axios";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import {useActorsStore} from "@/stores/actors";
import {useHandleModalsStore} from "@/stores/handleModals";
import {CostumeSettingsInterface} from "@/interfaces/CostumeSettingsInterface";
import {InertiaForm, router} from "@inertiajs/vue3";
import {Method} from "@inertiajs/core";

export interface CostumeState {
  costumes: CostumeInterface[];
  costumeSettings: CostumeSettingsInterface,
  availableCostumes: CostumeInterface[];
  selectedCostume: CostumeInterface;
  isUpdate: boolean;
  searchValue: string;
}

export const useCostumestore = defineStore('costumes', {
  state: (): CostumeState => ({
    costumes: [],
    costumeSettings: {} as CostumeSettingsInterface,
    availableCostumes: [],
    selectedCostume: {
      id: null,
      period_id: null,
      costumes_category_id: null,
      size_id: null,
      location_id: null,
      img_url: '',
      number: '',
      name: '',
      description: '',
      condition: '',
      gender: '',
      deposit: null,
      is_to_be_repaired: false,
      period: {},
      category: {},
      current_costume_history: {},
      inactive_costume_histories: [],
    } as CostumeInterface,
    isUpdate: false,
    searchValue: '',
  }),
  actions: {
    setCostumes(costumes: Array<CostumeInterface>) {
      this.costumes = costumes;
      return costumes;
    },
    setCostumeSettings(costumeSettings: []) {
      this.costumeSettings = costumeSettings;
    },
    setSelectedCostume(costume: CostumeInterface) {
      this.selectedCostume = costume;
      return costume;
    },
    resetSelectedCostume() {
      this.selectedCostume = {
        id: null,
        period_id: null,
        costumes_category_id: null,
        size_id: null,
        location_id: null,
        img_url: '',
        number: '',
        name: '',
        description: '',
        condition: '',
        gender: '',
        deposit: null,
        is_to_be_repaired: false,
        period: {},
        category: {},
        current_costume_history: {},
        inactive_costume_histories: [],
      }
    },
    replaceCostume(costume: CostumeInterface) {
      let index = this.costumes.findIndex(cost => cost.id === costume.id);
      this.costumes[index] = costume;
    },
    getAvailableCostumes() {
      axios.get(route('costumes.getAvailableCostumes'))
          .then(({data}) => {
            this.availableCostumes = data
          })
          .catch((e) => {
            useAlertsStore().error('Les costumes n\'ont pas pu être récupérés...')
          })
    },
    getActiveActorCostumes() {
      return this.selectedCostume.active_costume_history;
    },
    postCostume(form: InertiaForm<CostumeInterface>) {
      let method = this.isUpdate ? 'patch' : 'post';
      let endPoint = this.isUpdate ? route('costumes.update') : route('costumes.store');

      form.submit(<Method>method, endPoint, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          if (method === 'post') {
            useAlertsStore().success('Costume ajouté avec succès !');
          }
          if (method === 'patch' || method === 'put') {
            useAlertsStore().success('Costume mis à jour avec succès !');
          }
          useHandleModalsStore().toggleModalCostume(false);
        },
        onError: () => {
          if (form.errors) {
            useAlertsStore().error('Erreur(s) sur le formulaire')
          } else {
            useAlertsStore().error('Une erreur s\'est produite...')
          }
        },
      })
    },
    filteringCostume(filters_options: Array<any>) {
      axios.get(route('costumes.search'), {
        params: {
          filters: filters_options
        }
      })
        .then(({data}) => {
          this.costumes = data;
        })
        .catch((e) => {
          console.error(e);
        })
    },
    dissociateToActor(form: InertiaForm<any>) {
      form.post(route('costume-histories.dissociateToActor'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          useAlertsStore().success('Costume dissocié de l\'acteur avec succès !');
          useHandleModalsStore().toggleModalCostumeReturn();
        },
        onError: () => {
          useAlertsStore().error('Une erreur est survenue lors de la dissociation du costume...')
        }
      })
    },
    repairedCostume(form: any) {
      form.post(route('repairs.repaired'), {
        onSuccess: () => {
          useAlertsStore().success('Réparé avec succès !');
        },
        onFinish: () => {
          useHandleModalsStore().toggleModalRepairedCostume();
        },
        onError: (error) => {
          console.error(error)
          useAlertsStore().error('Une erreur s\'est produite... Veuillez mettre en réparation ultérieurement');
        }
      })
    },
    toBeRepairedCostume(form: InertiaForm<any>) {
      form.post(route('repairs.to-be-repaired'), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          useAlertsStore().success('Mis en réparation avec succès !');
          useHandleModalsStore().toggleModalCostumeIsToBeRepair();
        },
        onError: () => {
          useAlertsStore().error('Une erreur s\'est produite... Veuillez mettre en réparation ultérieurement');
        }
      })
    },
    deleteCostume(costume: CostumeInterface = useCostumestore().selectedCostume) {
      router.delete(route('costumes.delete', costume), {
        onSuccess: () => {
          useHandleModalsStore().toggleModalCostumeDeleting();
          useAlertsStore().success('Costume supprimé avec succès !');
        },
        onError: () => {
          useAlertsStore().error('Une erreur est survenue. Impossible de supprimer le costume');
        }
      });
    },
  }
})
