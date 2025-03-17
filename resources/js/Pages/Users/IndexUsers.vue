<script setup lang="ts">
import {onMounted, onUpdated} from "vue";
import {Head, usePage} from '@inertiajs/vue3';
import {useHandleModalsStore} from "@/stores/handleModals";
import {useUsersStore} from "@/stores/users";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreadcrumbDefault from "@/Components/Breadcrumbs/BreadcrumbDefault.vue";
import DeletingUser from "@/Components/Users/DeletingUser.vue";
import Modal from "@/Components/Modal/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ProfileCard from "@/Components/Users/ProfileCard.vue";
import UsersDatatable from "@/Components/Users/UsersDatatable.vue";
useUsersStore().setUsers(usePage().props.users);

onMounted(() => {
  useUsersStore().setUsers(usePage().props.users);
});
onUpdated(() => {
  useUsersStore().setUsers(usePage().props.users);
});
</script>

<template>
  <Head title="Utilisateurs de la plateforme"/>

  <AuthenticatedLayout>
    <BreadcrumbDefault :pageTitle="'Utilisateurs'"/>

    <div class="container">
      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="dataTable-search flex justify-between mb-4">
          <div class="relative h-fit">
            <input class="search block w-full min-w-90 max-w-max" v-model="useUsersStore().searchValue"
                   placeholder="Rechercher un utilisateur..." type="text">
            <button type="submit" class="absolute end-2.5 bottom-2.5" @click="useUsersStore().searchValue = ''">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512" width="16" height="16">
                <path
                  d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
              </svg>
            </button>
          </div>

          <div class="flex gap-4">
            <PrimaryButton class="flex items-center"
                           @click="useHandleModalsStore().is_open_modal_user = true; useUsersStore().isUpdate = false">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
              </svg>
              <span class="ml-2.5">Ajouter</span>
            </PrimaryButton>
          </div>
        </div>
        <users-datatable/>
      </div>
    </div>

    <Modal :show="useHandleModalsStore().is_open_modal_user_deleting"
           :min-height="'min-content'"
           @close="useHandleModalsStore().toggleModalUserDelete">
      <deleting-user/>
    </Modal>

    <Modal :show="useHandleModalsStore().is_open_modal_user"
           @close="useHandleModalsStore().toggleModalUser">
        <ProfileCard/>
    </Modal>
  </AuthenticatedLayout>
</template>
