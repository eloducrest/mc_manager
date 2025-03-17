<script setup lang="ts">
import {headers, table_actions} from "@/datatables/usersDatatable";
import ToolTip from "@/Components/ToolTips/ToolTip.vue";
import {useUsersStore} from "@/stores/users";
</script>

<template>
  <EasyDataTable
    table-class-name="customize-table"
    :headers="headers"
    :items="useUsersStore().users"
    :search-value="useUsersStore().searchValue"
    alternating>
    <template #item-actions="user">
      <div class="operation-wrapper flex items-center gap-x-3">
        <div v-for="action in table_actions"
             :class="action.btn_class"
             @click="action.method(user)">
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
