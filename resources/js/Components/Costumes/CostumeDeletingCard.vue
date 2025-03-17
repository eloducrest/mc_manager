<script setup lang="ts">
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useAlertsStore} from "@/stores/alerts";

const deleteCostume = () => {
  useCostumestore().deleteCostume(useCostumestore().selectedCostume)
}
</script>

<template>
  <div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      Etes-vous sur de vouloir supprimer le costume :
      {{ useCostumestore().selectedCostume.name + ' : ' + useCostumestore().selectedCostume.number }} ?
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      Une fois le costume supprimé, toutes ses ressources et données seront définitivement effacées.
    </p>

    <div class="mt-6 flex justify-end">
      <SecondaryButton @click="useHandleModalsStore().toggleModalCostumeDeleting()">
        Annuler
      </SecondaryButton>

      <DangerButton class="ms-3"
                    @click="deleteCostume">
        Supprimer le costume
      </DangerButton>
    </div>
  </div>
</template>
