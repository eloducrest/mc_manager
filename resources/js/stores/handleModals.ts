import {defineStore} from 'pinia';
import {useCostumestore} from "@/stores/costumes";
import {useActorsStore} from "@/stores/actors";

export const useHandleModalsStore = defineStore('modals', {
  state: () => ({
    // COSTUMES
    is_open_modal_costume: false,
    is_open_modal_costume_assign_costume_to_actor: false,
    is_open_modal_costume_return: false,
    is_open_modal_repaired_costume: false,
    is_open_modal_costume_id_to_be_repair: false,
    is_open_modal_costume_deleting: false,

    // LOCATIONS
    is_open_modal_quick_view_location: false,

    // ACTORS
    is_open_modal_actor: false,
    is_open_modal_actor_handle_costumes: false,
    is_open_modal_actor_assign_costume_to_actor: false,
    is_open_modal_actor_delete: false,

    // USERS
    is_open_modal_user: false,
    is_open_modal_user_deleting: false,

    // IMPORTS
    is_open_modal_import: false,
  }),
  actions: {
    // COSTUMES
    toggleModalCostume(reset = false) {
      this.is_open_modal_costume = !this.is_open_modal_costume;
      if (reset) {
        this.resetCostume(this.is_open_modal_costume);
      }
    },
    toggleModalCostumeAssignCostumeToActor(reset = false) {
      this.is_open_modal_costume_assign_costume_to_actor = !this.is_open_modal_costume_assign_costume_to_actor;
      if (reset) {
        this.resetCostume(this.is_open_modal_costume_assign_costume_to_actor);
      }
    },
    toggleModalCostumeReturn() {
      this.is_open_modal_costume_return = !this.is_open_modal_costume_return;
      this.resetCostume(this.is_open_modal_costume_return);
    },
    toggleModalRepairedCostume() {
      this.is_open_modal_repaired_costume = !this.is_open_modal_repaired_costume;
    },
    toggleModalCostumeIsToBeRepair() {
      this.is_open_modal_costume_id_to_be_repair = !this.is_open_modal_costume_id_to_be_repair;
      this.resetCostume(this.is_open_modal_costume_id_to_be_repair);
    },
    toggleModalCostumeDeleting() {
      this.is_open_modal_costume_deleting = !this.is_open_modal_costume_deleting;
      this.resetCostume(this.is_open_modal_costume_deleting);
    },
    resetCostume(modal: boolean) {
      if (!modal)
        useCostumestore().resetSelectedCostume();
    },

    // LOCATIONS
    toggleModalQuickViewLocation() {
      this.is_open_modal_quick_view_location = !this.is_open_modal_quick_view_location;
    },

    // ACTORS
    toggleModalActor() {
      this.is_open_modal_actor = !this.is_open_modal_actor;
      this.resetActor(this.is_open_modal_actor);
    },
    toggleModalActorHandleCostumes() {
      this.is_open_modal_actor_handle_costumes = !this.is_open_modal_actor_handle_costumes;
      this.resetActor(this.is_open_modal_actor_handle_costumes);
    },
    toggleModalActorAssignCostumeToActor() {
      this.is_open_modal_actor_assign_costume_to_actor = !this.is_open_modal_actor_assign_costume_to_actor;
    },
    toggleModalActorDelete() {
      this.is_open_modal_actor_delete = !this.is_open_modal_actor_delete;
      this.resetActor(this.is_open_modal_actor_delete);
    },
    resetActor(modal: boolean) {
      if (!modal)
        useActorsStore().resetSelectedActor();
    },

    // USERS
    toggleModalUser() {
      this.is_open_modal_user = !this.is_open_modal_user;
    },
    toggleModalUserDelete() {
      this.is_open_modal_user_deleting = !this.is_open_modal_user_deleting;
    },

    // IMPORTS
    toggleModalImport() {
      this.is_open_modal_import = !this.is_open_modal_import;
    },
  }
})
