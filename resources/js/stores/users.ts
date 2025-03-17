import {defineStore} from 'pinia';
import {InertiaForm, router} from '@inertiajs/vue3'
import {useAlertsStore} from "@/stores/alerts";
import {useHandleModalsStore} from "@/stores/handleModals";
import {UserInterface} from "@/interfaces/UserInterface";
import {Method} from "@inertiajs/core";

export const useUsersStore = defineStore('users', {
  state: () => ({
    users: [] as UserInterface[],
    selectedUser: {} as UserInterface,
    isUpdate: false,
    searchValue: '',
  }),
  actions: {
    postUser(form: InertiaForm<UserInterface>): void {
      let method: string  = this.isUpdate ? 'patch' : 'post';
      let endPoint: string= this.isUpdate ? route('users.update') : route('users.store');

      form.submit(<Method>method, endPoint, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          if (method === 'post') {
            useAlertsStore().success('Utilisateur ajouté avec succès !');
          }
          if (method === 'patch' || method === 'put') {
            useAlertsStore().success('Utilisateur mis à jour avec succès !')
          }
          useHandleModalsStore().toggleModalUser()
        },
        onError: () => {
          useAlertsStore().error('Une erreur s\'est produite... Veuillez ajouter l\`utilisateur ultérieurement')
        }
      });
    },
    deleteUser(): void {
      router.delete(route('users.delete', this.selectedUser), {
        onSuccess: () => {
          useHandleModalsStore().toggleModalUserDelete();
          useAlertsStore().success('Utilisateur supprimé avec succès !');
        },
        onError: () => {
          useAlertsStore().error('Une erreur est survenue. Impossible de supprimer l\'utilisateur');
        }
      })
    },
    setUsers(users: UserInterface[]): UserInterface[] {
      this.users = users;
      return users;
    },
  }
})
