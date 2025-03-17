<script setup lang="ts">
import {ref} from "vue";
import CostumeReturnCard from "@/Components/Costumes/CostumeReturnCard.vue";
import Modal from "@/Components/Modal/Modal.vue";
import ActorCostumeHistoryDatatable from "@/Components/Actors/ActorCostumeHistoryDatatable.vue";

const props = defineProps<{
  costumes: object;
  settings: object;
}>()

const is_open_modal_return_costume = ref<boolean>(false);
const actor_costume = ref<object | null>(null);

const openModal = (actor: object): void => {
  console.log('open modal')
  console.log(actor)
  is_open_modal_return_costume.value = true;
  actor_costume.value = actor;
}
const closeModal = (): void => {
  is_open_modal_return_costume.value = false;
}
</script>

<template>
  <actor-costume-history-datatable></actor-costume-history-datatable>

  <Modal :show="is_open_modal_return_costume"
         @close="closeModal">
    <costume-return-card :costume="props.costume"
                         :actor="actor_costume"
                         :settings="props.settings"
                         @close-modal="closeModal"></costume-return-card>
  </Modal>
</template>

