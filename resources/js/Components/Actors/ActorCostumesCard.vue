<script setup lang="ts">
import 'vue-multiselect/dist/vue-multiselect.css'
import {useActorsStore} from "@/stores/actors";
import {useHandleModalsStore} from "@/stores/handleModals";
import ActorAssignCostumesToActorCard from "@/Components/Actors/ActorAssignCostumesToActorCard.vue";
import CardsModal from "@/Components/Cards/CardsModal.vue";
import Modal from "@/Components/Modal/Modal.vue";
import CostumeReturnCard from "@/Components/Costumes/CostumeReturnCard.vue";
import CostumesDatatable from "@/Components/Costumes/CostumesDatatable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ActorInterface} from "@/interfaces/ActorInterface";

const actor: ActorInterface = useActorsStore().selectedActor
const modalsStore = useHandleModalsStore();
</script>

<template>
  <!-- ====== Actor Costumes Section Start -->
  <cards-modal :close="modalsStore.toggleModalActorHandleCostumes">
    <template v-slot:title>
      {{ `Gestion rapide des costume de ${actor.firstname } ${actor.lastname}` }}
    </template>
    <template v-slot:body>
      <div class="flex-1 space-y-4">
        <PrimaryButton class="flex items-center"
                       @click="modalsStore.toggleModalActorAssignCostumeToActor()">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/>
          </svg>
          <span class="ml-2.5">Ajouter un costume</span>
        </PrimaryButton>
        <div class="my-8">
          <p class="text-base font-semibold text-gray-700">Les costumes de l'acteur : </p>
        </div>
        <costumes-datatable :costumes="actor.current_costumes"
                            except-header="is_available"
                            :active-actions="['view', 'return']"/>
      </div>
    </template>
  </cards-modal>
  <!-- ====== Assign Costume Section End -->

  <Modal :show="modalsStore.is_open_modal_actor_assign_costume_to_actor"
         max-width="6xl" min-height="lg"
         @close="modalsStore.toggleModalActorAssignCostumeToActor">
    <actor-assign-costumes-to-actor-card/>
  </Modal>

  <Modal :show="modalsStore.is_open_modal_costume_return"
         @close="modalsStore.toggleModalCostumeReturn">
    <costume-return-card/>
  </Modal>

</template>
