<script setup lang="ts">
import {computed, ref} from "vue";
import axios from "axios";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import InputGroup from "@/Components/Forms/InputGroup.vue";
import Multiselect from "vue-multiselect";
import {ActorInterface} from "@/interfaces/ActorInterface";
import 'vue-multiselect/dist/vue-multiselect.css'
import {useForm} from "@inertiajs/vue3";
import {useCostumeHistories} from "@/composables/costume-histories";

type RouteName = 'actors.index' | 'actors.view' | 'costumes.index' | 'costumes.view'

interface RedirectProps {
  route_name: RouteName;
  id?: number | null;
}
interface Props {
  redirect?: RedirectProps;
};
interface Form {
  costumes: [
    {
      costume_id: number|null,
      amount_deposit: number,
      take_condition: string|null
    }
  ]
  actor_id: number|null,
  redirect: {
    route_name: string,
    id?: number|null,
  },
}

const props = withDefaults(defineProps<Props>(), {
  redirect: () => ({
    route_name: 'actors.index' as RouteName,
    id: null
  })
});

const {associateToActor} = useCostumeHistories();

const costume = useCostumestore().selectedCostume;
const actors = ref<ActorInterface[]>([]);
const selected_actor = ref(null);
const form = useForm<Form>({
  costumes: [
    {
      costume_id: costume?.id ?? null,
      amount_deposit: 0,
      take_condition: costume?.condition ?? null
    }
  ],
  actor_id: null,
  redirect: props.redirect,
})

const searchActors = (query: string) => {
  if (form.actor_id) return;

  axios.get(route('actors.search'), {
    params: {
      value: query
    }
  })
    .then(({data}) => {
      actors.value = data;
    })
    .catch((e) => {
      console.log(e)
    })
}

const multiselectLabel = (
  {firstname, lastname, email, tel}: {firstname: string, lastname: string, email: string, tel: string},
) => {
  return `${firstname + ' ' + lastname + ' ' + '(' + email + '/' + tel + ')'}`;
}

const isEnoughDeposit = (): boolean => {
  return costume?.deposit == form.costumes[0].amount_deposit;
}

const customErrorDepositMessage = computed(() => {
  return !isEnoughDeposit() ? 'Attention, le montant n\'est pas celui attendu':null
})

const submitForm = () => {
  associateToActor(form)
}
</script>

<template>
  <!-- ====== Assign Costume Section Start -->
  <cards-modal :close="useHandleModalsStore().toggleModalCostumeAssignCostumeToActor"
               :submit="submitForm">
    <template v-slot:title>
      <span v-text="`Assigner ${costume.name} à un acteur ?`"></span>
    </template>
    <template v-slot:body>
      <multiselect v-model="selected_actor"
                   placeholder="Rechercher et selectionner un acteur"
                   track-by="id"
                   :custom-label="multiselectLabel"
                   :searchable="true"
                   :internal-search="false"
                   @search-change="searchActors"
                   @select="(selectedOption: ActorInterface) => form.actor_id = selectedOption.id"
                   :options="actors"></multiselect>
      <p v-if="form.errors.actor_id"
         class="mt-1 text-sm text-red-600 dark:text-red-500"
         v-text="form.errors.actor_id"></p>

        <input-group custom-classes="my-5 w-full xl:w-1/2"
                     label='Caution déposée <span class="text-xs">(laisser à 0 si pas de caution donnée)</span>'
                     type="number"
                     placeholder="Caution déposée par l'acteur"
                     :required="true"
                     :has-error="!isEnoughDeposit()"
                     :error-message="customErrorDepositMessage"
                     v-model="form.costumes[0].amount_deposit"></input-group>
      <div>
        <h3 class="mb-2">Récapitulatif du costume : </h3>
        <p>Caution demandée : {{ costume.deposit + '€' }}</p>
        <p>Numéro : {{ costume.number }}</p>
        <p>Nom : {{ costume.name }}</p>
        <p>Etat du costume : {{ costume.condition }}</p>
      </div>

    </template>
  </cards-modal>
  <!-- ====== Assign Costume Section End -->
</template>
