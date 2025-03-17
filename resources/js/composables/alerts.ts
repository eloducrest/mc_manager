import AlertSuccess from "@/Components/Alerts/AlertSuccess.vue";
import AlertError from "@/Components/Alerts/AlertError.vue";
import AlertWarning from "@/Components/Alerts/AlertWarning.vue";
import {useToast} from "vue-toastification";

// by convention, composable function names start with "use"
export function useAlerts() {
  const toast = <any> useToast()

  function success(message: string, icon: Boolean = true) {
    toast(
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
  }

  function error(message: string = 'Une erreur s\'est produite...', icon: Boolean = true) {
    toast(
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
  }

  function warning(message: string, icon: Boolean = true) {
    toast(
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
  }

  // expose managed state as return value
  return { success, error, warning }
}
