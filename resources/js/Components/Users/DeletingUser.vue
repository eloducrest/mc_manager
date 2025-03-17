<script setup lang="ts">
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useHandleModalsStore} from "@/stores/handleModals";
import {useUsersStore} from "@/stores/users";

const deleteUser = () => {
  useUsersStore().deleteUser();
}
</script>

<template>
  <div class="p-6">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      Etes-vous sur de vouloir supprimer l'utilisateur :
      <span v-text="useUsersStore().selectedUser?.firstname + ' : ' + useUsersStore().selectedUser?.lastname"></span> ?
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
      Une fois l'utilisateur supprimé, toutes ses ressources et données seront définitivement effacées.
    </p>

    <div class="mt-6 flex justify-end">
      <SecondaryButton @click="useHandleModalsStore().toggleModalUserDelete()">
        Annuler
      </SecondaryButton>

      <DangerButton class="ms-3"
                    @click="deleteUser">
        Supprimer l'utilisateur
      </DangerButton>
    </div>
  </div>
</template>
