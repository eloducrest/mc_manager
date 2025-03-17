<script setup lang="ts">
import {ref, onMounted} from "vue";
import {useActorsStore} from "@/stores/actors";
import {useAlertsStore} from "@/stores/alerts";
import {useCostumestore} from "@/stores/costumes";
import {useHandleModalsStore} from "@/stores/handleModals";
import 'vue-multiselect/dist/vue-multiselect.css'
import CardsModal from "@/Components/Cards/CardsModal.vue";
import Multiselect from "vue-multiselect";
import TagRemoveComponent from "@/Components/TagRemoveComponent.vue";
import {CostumeInterface} from "@/interfaces/CostumeInterface";
import {ActorInterface} from "@/interfaces/ActorInterface";
import {CostumeHistoryInterface} from "@/interfaces/CostumeHistoryInterface";
import {useForm} from "@inertiajs/vue3";

onMounted(() => {
  useCostumestore().getAvailableCostumes()
})

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
    route_name: 'actors.index' as RouteName,
    id: null
  })
});

const actor = ref<ActorInterface|null>(useActorsStore().selectedActor)

const form = ref<Array<CostumeHistoryInterface>>([]);
const formt = useForm([])

const selectedCostumes = ref<CostumeInterface[]>([]);
const total_amount_deposit = ref<number>(0);

const isEnoughDeposit = (index: number): boolean => {
  return selectedCostumes.value[index].deposit === form.value[index].amount_deposit
}

const selectCostume = (selectedOption: CostumeInterface) => {
  total_amount_deposit.value += selectedOption.deposit;
  form.value.push({
    costume_id: selectedOption.id,
    amount_deposit: null,
    take_condition: selectedOption.condition,
  });

}

const submitForm = () => {
  formt.transform((data) => ({
    ...data,
    actor_id: actor.value.id,
    costumes: form.value,
    redirect: props.redirect,
  }))
    .post(route('costume-histories.associateToActor'), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        formt.reset();
        useActorsStore().selectedActor.current_costumes.push(... selectedCostumes.value);
        useAlertsStore().success('Les costumes ont été associés à l\'acteur avec succès !');
        useHandleModalsStore().toggleModalActorAssignCostumeToActor()
      },
      onError: (e) => {
        console.log('error', e)
        useAlertsStore().error('Une erreur s\'est produite... Veuillez assigner le costume ultérieurement')
      },
  })
}
</script>

<template>
  <!-- ====== Assign Costume Section Start -->
  <cards-modal :close="useHandleModalsStore().toggleModalActorAssignCostumeToActor"
               :submit="submitForm">
    <template v-slot:title>
      {{ `Assigner un ou des costume(s) à ${actor.firstname} ${actor.lastname} ?` }}
    </template>
    <template v-slot:body>
      <div class="flex-1 space-y-4">
        <div class="px-4 pb-6 lg:pb-8 xl:pb-11.5">
          <div class="mt-4 actor-assign-costume-to-actor-modal">
            <multiselect v-model="selectedCostumes"
                         placeholder="Rechercher et ajouter un costume"
                         track-by="id"
                         label="name"
                         :searchable="true"
                         :close-on-select="true"
                         :multiple="true"
                         :hide-selected="true"
                         :internal-search="true"
                         :maxHeight="500"
                         :show-labels="false"
                         @select="(selectedOption: CostumeInterface) => selectCostume(selectedOption)"
                         :options="useCostumestore().availableCostumes">
              <template #tag="{ option, remove }">
                <tag-remove-component :label="`${option.number} / ${option.name}`"
                                      @remove="remove(option)"></tag-remove-component>
              </template>
              <template #option="props">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <img class="w-16 h-16 rounded-full option__image" :src="props.option.img_url"/>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="option__title text-sm font-medium text-gray-900 truncate dark:text-white">
                      {{ props.option.name }} <span class="text-xs text-gray-700">({{ props.option.condition }})</span>
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400"
                       v-text="`N° ${props.option.number}`">
                    </p>
                  </div>
                  <div class="text-xs font-semibold text-gray-700 text-right">
                    <p class="mb-4"
                       v-text="props.option.category.label"></p>
                    <p v-text="props.option.period.label"></p>
                    <p v-if="props.option.location?.code"
                       v-text="props.option.location.code"></p>
                  </div>
                </div>
              </template>
            </multiselect>
            <div class="my-10 w-full xl:w-2/3">
              <h2 class="mb-1 text-xl block font-medium text-black">
                Cautions <span class="text-sm">(laisser à 0 si pas de caution donnée)</span><span class="text-meta-1">*</span>
              </h2>
              <p class="mb-5"
                 v-text="`Montant total attendu : ${total_amount_deposit} €`"></p>
              <template v-for="(costume, index) in selectedCostumes">
                <div class="mb-5">
                  <label :for="`deposit-costume-${index}`"
                         class="text-black"
                         v-text="`${costume.name} : (caution attendue : ${costume.deposit} €)`"></label>
                  <input type="number"
                         :id="`deposit-costume-${index}`"
                         v-model="form[index].amount_deposit"
                         class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter"
                         :placeholder="`Caution costume : ${costume.name}`">
                  <p v-if="!isEnoughDeposit(index)"
                     class="text-sm text-orange-600 italic">Attention, le montant n'est pas celui attendu</p>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </template>
  </cards-modal>
  <!-- ====== Assign Costume Section End -->
</template>
