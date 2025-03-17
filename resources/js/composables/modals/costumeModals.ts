import {ref} from "vue";

export function useCostumeModals() {

  const is_open_modal_costume = ref(false);
  const toggleModalCostume = () => {
    is_open_modal_costume.value = !is_open_modal_costume.value;
  }

  const is_open_modal_costume_return = ref(false);
  const toggleModalCostumeReturn = () => {
    is_open_modal_costume_return.value = !is_open_modal_costume_return.value;
  }

  const is_open_modal_costume_assign_costume_to_actor = ref(false);
  const toggleModalCostumeAssignCostumeToActor = () => {
    is_open_modal_costume_assign_costume_to_actor.value = !is_open_modal_costume_assign_costume_to_actor.value;
  }

  return {
    is_open_modal_costume,
    toggleModalCostume,

    is_open_modal_costume_return,
    toggleModalCostumeReturn,

    is_open_modal_costume_assign_costume_to_actor,
    toggleModalCostumeAssignCostumeToActor
  }
}
