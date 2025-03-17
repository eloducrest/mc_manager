import { defineStore } from 'pinia';
import { usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import {useAlertsStore} from "@/stores/alerts";
import {useSidebarStore} from "@/stores/sidebar";

const page = usePage()

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: <any> page.props.auth.user,
    returnUrl: null,
  }),
  actions: {
    login(form: any) {
      try {
        form.post(route('login'), {
          onSuccess: () => {
            this.user = page.props.auth.user;
          },
          onFinish: () => {
            form.reset('password');
            useSidebarStore().page = 'Dashboard'

          },
          onError: () => {
            console.log('error !!!')
          }
        });
      } catch (error) {
        console.log(error);
      }
    },

    async update(form: any) {
      try {
        form.patch(route('profile.update'), {
          onSuccess: () => {
            this.user = page.props.auth.user;
            useAlertsStore().success('Profil mis à jour !')
          },
        })
      } catch (error) {
        console.log(error);
      }
    },

    logout() {
      router.post(route('logout'))
      this.user = null;
    }
  }
})
