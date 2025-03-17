import {InertiaForm} from "@inertiajs/vue3";
import {useAlertsStore} from "@/stores/alerts";
import {useHandleModalsStore} from "@/stores/handleModals";

export function useCostumeHistories() {

  const associateToActor = (form: InertiaForm<any>) => {
    form.post(route('costume-histories.associateToActor'), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        useAlertsStore().success('Costume associé à l\'acteur avec succès !');
        useHandleModalsStore().toggleModalCostumeAssignCostumeToActor(false);
      },
      onError: () => {
        if (form.errors) {
          useAlertsStore().error('Erreur(s) sur le formulaire');
        } else {
          useAlertsStore().error('Une erreur s\'est produite... Veuillez assigner le costume ultérieurement')
        }
      },
    });
  }

  const isEnoughDepositAssociate = () => {

  }

  return {
    associateToActor,
    isEnoughDepositAssociate
  }
}
