<script setup lang="ts">
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import {useForm} from "@inertiajs/vue3";

export interface Props {
  settings: object;
}
const props = defineProps<Props>();

const modalStore = useHandleModalsStore();
const costume = useCostumestore().selectedCostume;

const form = useForm({
  costume_id: costume?.id,
  condition_after_repair: '',
  resolved_comment: '',
})

const submitForm = () => {
  useCostumestore().repairedCostume(form)
}

</script>

<template>
  <!-- ====== Return Costume Section Start -->
  <div class="fixed inset-0 transform transition-all" @click="modalStore.toggleModalRepairedCostume()">
    <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"/>
  </div>

  <!-- Modal content -->
  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
    <!-- Modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b border-bodydark rounded-t dark:border-gray-600">
      <h3
        v-text="`Confirmer la réparation du costume ${costume.number} : ${costume.name}`"
        class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
      <button @click="modalStore.toggleModalRepairedCostume()"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
    </div>
    <!-- Modal body -->
    <div class="p-4 md:p-5 space-y-4">
      <div class="px-4 pb-6 lg:pb-8 xl:pb-11.5">
        <div class="mt-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <img :src="costume.img_url" alt="">
            </div>
            <div class="flex flex-col justify-between">
              <p v-text="costume.name"
                 class="text-xl font-medium text-black"></p>
              <p class="text-lg text-black">
                <span class="font-medium">Période : </span>
                <span v-text="costume.period.label"></span>
              </p>
              <p class="text-lg text-black">
                <span class="font-medium">Catégorie : </span>
                <span v-text="costume.category.label"></span>
              </p>
            </div>
          </div>

          <div class="my-5 w-full">
            <p class="mb-3 block text-sm font-medium text-black dark:text-white">
              Commentaires laissés pour les réparations :
            </p>
            <div class="w-full rounded-lg px-5 py-3 font-normal text-black outline-none transition">
              <p v-text="costume.active_repair_histories?.repair_comment ?? 'Aucun commentaire laissé pour cette réparation'"></p>
            </div>
          </div>

          <form id="repaired_form" @submit.prevent="submitForm">
            <div class="my-5 w-full">
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Etat après réparation :
              </label>
              <div class="relative z-20 bg-white dark:bg-form-input">
                <select v-model="form.condition_after_repair"
                        class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input" :class="isOptionSelected ?? 'text-black dark:text-white'" @change="isOptionSelected = true">
                  <option v-for="condition in props.settings.conditions"
                          :value="condition"
                          class="text-body">
                    {{ condition }}
                  </option>
                </select>
              </div>
            </div>

            <div class="my-5 w-full">
              <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                Résolutions apportées :
              </label>
              <textarea rows="6" v-model="form.resolved_comment"
                        placeholder="Ajouter des remarques"
                        class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
            </div>
          </form>
        </div>
      </div>

    </div>
    <!-- Modal footer -->
    <div class="flex items-center p-4 md:p-5 border-t border-bodydark rounded-b dark:border-gray-600">
      <button type="submit"
              form="repaired_form"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Valider
      </button>
      <button @click="modalStore.toggleModalRepairedCostume()"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
        Annuler
      </button>
    </div>
  </div>
  <!-- ====== Assign Costume Section End -->
</template>
