<script setup lang="ts">
import {headers, table_actions} from "@/datatables/actorsDatatable";
import ToolTip from "@/Components/ToolTips/ToolTip.vue";
import {useActorsStore} from "@/stores/actors";
</script>

<template>
  <EasyDataTable
    table-class-name="customize-table"
    :headers="headers"
    :items="useActorsStore().actors"
    :search-value="useActorsStore().searchValue"
    alternating>
    <template #item-is_volunteer="{ is_volunteer }">
      <span v-text="is_volunteer ? 'Oui' : 'Non'"></span>
    </template>
    <template #item-actions="actor">
      <div class="operation-wrapper flex items-center gap-x-3">
        <div v-for="action in table_actions"
             :class="action.btn_class"
             @click="action.method(actor)">
          <tool-tip :tooltiptext="action.title">
            <template v-slot:tooltipable>
              <span v-html="action.icon"></span>
            </template>
          </tool-tip>
        </div>
      </div>
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
