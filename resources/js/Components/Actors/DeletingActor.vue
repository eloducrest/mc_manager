<script setup lang="ts">
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useActorsStore} from "@/stores/actors";
import {useAlertsStore} from "@/stores/alerts";
import {useHandleModalsStore} from "@/stores/handleModals";

const deleteActor = () => {
  useActorsStore().deleteActor({
    data: useActorsStore().selectedActor,
    preserveState: false,
    preserveScroll: false,
    onSuccess: () => {
      useAlertsStore().success('Acteur supprimé avec succès !');
      useHandleModalsStore().toggleModalActorDelete()
    },
    onError: (errors: any) => {
      console.error(errors)
      useAlertsStore().error('Une erreur s\'est produite... Veuillez ajouter l\`acteur ultérieurement')
    },
  })
}
</script>

<template>
  <div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      Etes-vous sur de vouloir supprimer l'acteur :
      <span v-text="useActorsStore().selectedActor?.firstname + ' : ' + useActorsStore().selectedActor?.lastname"></span> ?
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      Une fois l'acteur supprimé, toutes ses ressources et données seront définitivement effacées.
    </p>

    <div class="mt-6 flex justify-end">
      <SecondaryButton @click="useHandleModalsStore().toggleModalActorDelete()">
        Annuler
      </SecondaryButton>

      <DangerButton class="ms-3"
                    @click="deleteActor">
        Supprimer l'acteur
      </DangerButton>
    </div>
  </div>
</template>
