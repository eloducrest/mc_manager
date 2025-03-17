<script setup lang="ts">
import { useUtils } from "@/composables/utils";
import {headers, table_actions} from "@/datatables/costumesHistoryDatatable";
import {useHandleModalsStore} from "@/stores/handleModals";
import {useActorsStore} from "@/stores/actors";
import ToolTip from "@/Components/ToolTips/ToolTip.vue";
import {useCostumestore} from "@/stores/costumes";

withDefaults(
    defineProps<{
        hideFooter?: true|false;
        alternating?: true|false;
        costumes: [];
        exceptHeaders?: string[];
    }>(),
    {
        hideFooter: false,
        alternating: true,
    }
);

const { formatDate } = useUtils();

const modalStore = useHandleModalsStore();
</script>

<template>
   <EasyDataTable
    table-class-name="customize-table"
    :headers="headers.filter(header => !exceptHeaders?.includes(header.value))"
    :hide-footer="hideFooter"
    :items="costumes"
    empty-message="Aucune donnée disponible"
    alternating>
    <template #item-actor_name="{ actor }">
        <a v-if="actor" :href="route('actors.view', actor.id)"
           class="text-blue-600 hover:underline"
           v-text="`${actor.firstname + ' ' + actor.lastname}`"></a>
    </template>
    <template #item-created_at="{ created_at }">
      <td v-text="formatDate(created_at)"></td>
    </template>
    <template #item-returned_at="{ returned_at }">
      <td v-text="returned_at ? formatDate(returned_at) : ''"></td>
    </template>
    <template #item-actions="{actor}">
      <template v-for="action in table_actions">
        <div :class="action.btn_class"
             @click="useActorsStore().setSelectedActor(actor); action.method(useCostumestore().selectedCostume)">
          <tool-tip :tooltiptext="action.title">
            <template v-slot:tooltipable>
              <span v-html="action.icon"></span>
            </template>
          </tool-tip>
        </div>
      </template>
    </template>
  </EasyDataTable>
</template>

<style scoped>
.customize-table {
  --easy-table-header-font-size: 14px;
  --easy-table-header-item-padding: 0px 5px;

  --easy-table-body-row-font-size: 14px;
  --easy-table-body-item-padding: 5px 5px;

  --easy-table-body-row-hover-font-color: #2d3a4f;
}
</style>
