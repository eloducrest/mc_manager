<script setup lang="ts">
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import 'vue-multiselect/dist/vue-multiselect.css'
import {useForm, usePage} from "@inertiajs/vue3";

type RouteName = 'actors.index' | 'actors.view' | 'costumes.index' | 'costumes.view'

interface RedirectProps {
  route_name: RouteName;
  id?: number | null;
}
interface Props {
  redirect?: RedirectProps;
}

const props = withDefaults(defineProps<Props>(), {
  redirect: () => ({
    route_name: 'costumes.index' as RouteName,
    id: null
  })
});

const modalStore = useHandleModalsStore();
const costume = useCostumestore().selectedCostume;

const form = useForm({
  costume_id: costume?.id,
  condition_before_repair: '',
  repair_comment: '',
  redirect: props.redirect,
})

const submitForm = () => {
  useCostumestore().toBeRepairedCostume(form);
}
</script>

<template>
  <!-- ====== Return Costume Section Start -->
  <cards-modal :close="modalStore.toggleModalCostumeIsToBeRepair"
               :submit="submitForm">
    <template v-slot:title>
      {{`${costume.type} ${costume.number} : ${costume.name} en réparation ?`}}
    </template>

    <template v-slot:body>
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
          <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Etat :
          </label>
          <div class="relative z-20 bg-white dark:bg-form-input">
            <select v-model="form.condition_before_repair"
                    class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input" :class="isOptionSelected ?? 'text-black dark:text-white'" @change="isOptionSelected = true">
              <option v-for="condition in usePage().props.costume_settings.conditions"
                      :value="condition"
                      class="text-body">
                {{ condition }}
              </option>
            </select>
          </div>
        </div>

        <div class="my-5 w-full">
          <label class="mb-3 block text-sm font-medium text-black dark:text-white">
            Commentaires pour la réparation :
          </label>
          <textarea rows="6" v-model="form.repair_comment"
                    placeholder="Ajouter des remarques"
                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
        </div>
    </template>
  </cards-modal>
  <!-- ====== Assign Costume Section End -->
</template>
