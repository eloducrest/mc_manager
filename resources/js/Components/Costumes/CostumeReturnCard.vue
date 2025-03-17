<script setup lang="ts">
import {computed} from "vue";
import {useActorsStore} from "@/stores/actors";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import CheckboxTwo from "@/Components/Forms/Checkboxes/CheckboxTwo.vue";
import InputGroup from "@/Components/Forms/InputGroup.vue";
import SelectGroupTwo from "@/Components/Forms/SelectGroup/SelectGroupTwo.vue";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import 'vue-multiselect/dist/vue-multiselect.css'
import {useForm} from "@inertiajs/vue3";
import TextareaGroup from "@/Components/Forms/TextareaGroup.vue";

type RouteName = 'actors.index' | 'actors.view' | 'costumes.index' | 'costumes.view'

interface RedirectProps {
  route_name: RouteName;
  id?: number | null;
}
interface Props {
  redirect?: RedirectProps;
};
const props = withDefaults(defineProps<Props>(), {
  redirect: () => ({
    route_name: 'actors.index' as RouteName,
    id: null
  })
});

const modalStore = useHandleModalsStore();
const costumeStore = useCostumestore();
const costume: CostumeInterface = costumeStore.selectedCostume;
const actor = costume.associated_actor ?? useActorsStore().selectedActor;

const form = useForm({
  costume_id: costume?.id,
  actor_id: actor?.id,
  amount_returned_deposit: 0,
  return_condition: '',
  is_to_be_repaired: false,
  comments: '',
  redirect: props.redirect,
})

const optionsConditions = computed(() => {
  return costumeStore.costumeSettings.conditions.map((condition) => {
    return {
      value: condition,
      label: condition
    }
  });
})

const submitForm = () => {
  costumeStore.dissociateToActor(form)
}
</script>

<template>
  <!-- ====== Return Costume Section Start -->
  <cards-modal :close="modalStore.toggleModalCostumeReturn"
               :submit="submitForm">
    <template v-slot:title>
      {{ `${actor.firstname} ${actor.lastname} rend le costume ${costume.name}` }}
    </template>
    <template v-slot:body>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <img :src="costume.img_url" alt="">
        </div>
        <div>
          <p v-text="costume.name"
             class="mb-10 text-xl font-medium text-black"></p>
          <p class="text-lg text-black">
            <span class="font-medium">Période : </span>
            <span v-text="costume.period.label"></span>
          </p>
          <p class="mb-10 text-lg text-black">
            <span class="font-medium">Catégorie : </span>
            <span v-text="costume.category.label"></span>
          </p>
          <p v-text="`Caution réelle : ${costume.deposit}`"
             class="mb-15 text-lg font-medium text-black"></p>
          <p class="text-lg font-medium text-black"
             v-text="`Caution déposée : ${costume.current_costume_history.amount_deposit + ' €'}`"></p>
        </div>
      </div>
      <div class="my-5 flex flex-col gap-6 xl:flex-row">
        <input-group custom-classes="w-full xl:w-1/2"
                     label='Caution rendue <span class="text-xs">(laisser à 0 si pas de caution rendue)</span>'
                     type="text"
                     placeholder="Caution à rendre"
                     :required="true"
                     v-model="form.amount_returned_deposit"/>

        <select-group-two custom-classes="w-full xl:w-1/2"
                          label="Etat"
                          :required="true"
                          :options="optionsConditions"
                          v-model="form.return_condition"/>
      </div>

      <checkbox-two custom-classes="mb-4.5 w-full xl:w-1/2"
                    label="Envoyer en réparation ?"
                    v-model="form.is_to_be_repaired"/>

      <div class="my-5 w-full">
        <textarea-group custom-classes="w-full"
                        label="Remarques"
                        placeholder="Ajouter des remarques"
                        :required="false"
                        v-model="form.comments"/>
      </div>
    </template>
  </cards-modal>
  <!-- ====== Assign Costume Section End -->
</template>
