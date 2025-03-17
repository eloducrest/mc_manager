import {defineStore} from "pinia";
import { useToast } from "vue-toastification";
import AlertSuccess from "@/Components/Alerts/AlertSuccess.vue";
import AlertError from "@/Components/Alerts/AlertError.vue";
import AlertWarning from "@/Components/Alerts/AlertWarning.vue";

export const useAlertsStore = defineStore('alert', {
  state: () => ({
    toast: <any> useToast()
  }),
  actions: {
    success(message: string, icon: Boolean = true) {
      this.toast(
        {
          component: AlertSuccess,
          props: {
            message: message,
            icon: icon
          }
        },
        {
          timeout: 3000,
          icon: false,
          hideProgressBar: true,
        }
      );
    },

    error(message: string = 'Une erreur s\'est produite...', icon: Boolean = true) {
      this.toast(
        {
          component: AlertError,
          props: {
            message: message,
            icon: icon
          }
        },
        {
          timeout: 3000,
          icon: false,
          hideProgressBar: true,
        }
      );
    },

    warning(message: string, icon: Boolean = true) {
      this.toast(
        {
          component: AlertWarning,
          props: {
            message: message,
            icon: icon
          }
        },
        {
          timeout: 3000,
          icon: false,
          hideProgressBar: true,
        }
      );
    },
  }
})
