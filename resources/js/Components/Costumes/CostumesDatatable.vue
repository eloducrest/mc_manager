<script setup lang="ts">
import {useCostumestore} from "@/stores/costumes";
import {headers, table_actions, active_actions, searchFields} from "@/datatables/costumesDatatable";
import ToolTip from "@/Components/ToolTips/ToolTip.vue";
import {CostumeInterface} from "@/interfaces/CostumeInterface";

interface Props {
  costumes?: CostumeInterface[],
  exceptHeader?: string,
  activeActions?: string[]
}
const props = withDefaults(defineProps<Props>(), {
  costumes: () => useCostumestore().costumes,
  activeActions: () => active_actions
})
</script>

<template>
  <EasyDataTable
    table-class-name="customize-table"
    :headers="headers.filter(item => item.value !== props.exceptHeader)"
    :items="props.costumes"
    :search-value="useCostumestore().searchValue"
    alternating>
    <template #item-img_url="{ img_url }">
      <td>
        <img :src="img_url" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
      </td>
    </template>
    <template #item-number="{ number }">
      <span>{{ number }}</span>
    </template>
    <template #item-costume_sizes="{ size }">
                <span v-if="size"
                      v-text="size.name"></span>
      <span v-else>∅</span>
    </template>
    <template #item-is_available="{ current_costume_history, is_to_be_repaired }">
      <div v-if="is_to_be_repaired">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path fill="none" stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.252 14.407a6.823 6.823 0 0 1-6.532 1.776a2.016 2.016 0 0 0-1.95.487l-4.28 4.294a.974.974 0 0 1-1.385 0l-2.067-2.069a.976.976 0 0 1 0-1.385l4.28-4.284a1.952 1.952 0 0 0 .488-1.951a6.835 6.835 0 0 1 1.912-6.65a6.823 6.823 0 0 1 6.736-1.566l-2.925 2.927c-.75.752-1.112 2.342-.341 3.103l1.715 1.727c.76.761 2.35.41 3.11-.351l2.925-2.927a6.836 6.836 0 0 1-1.686 6.869"/></svg>
      </div>
      <div v-else class="h-4 w-4 rounded-full"
           :class="current_costume_history ? 'bg-red-600' : 'bg-green-600'"></div>
    </template>
    <template #item-actions="costume">
      <div class="operation-wrapper flex items-center gap-x-3 pr-4">
        <template v-for="action in table_actions">
          <template v-for="active in activeActions">
            <template v-if="action.type === active">
              <div v-if="action.type === 'return' && costume.current_costume_history && !costume.is_to_be_repaired"
                   :class="action.btn_class"
                   @click="action.method(costume)">
                <tool-tip :tooltiptext="action.title">
                  <template v-slot:tooltipable>
                    <span v-html="action.icon"></span>
                  </template>
                </tool-tip>
              </div>
              <div v-if="action.type === 'assign' && !costume.current_costume_history && !costume.is_to_be_repaired"
                   :class="action.btn_class"
                   @click="action.method(costume)">
                <tool-tip :tooltiptext="action.title">
                  <template v-slot:tooltipable>
                    <span v-html="action.icon"></span>
                  </template>
                </tool-tip>
              </div>
              <div v-if="action.type === 'repair' && !costume.current_costume_history && !costume.is_to_be_repaired"
                   :class="action.btn_class"
                   @click="action.method(costume)">
                <tool-tip :tooltiptext="action.title">
                  <template v-slot:tooltipable>
                    <span v-html="action.icon"></span>
                  </template>
                </tool-tip>
              </div>
              <div v-if="action.type !== 'return' && action.type !== 'assign' && action.type !== 'repair'"
                   :class="action.btn_class"
                   @click="action.method(costume)">
                <tool-tip :tooltiptext="action.title">
                  <template v-slot:tooltipable>
                    <span v-html="action.icon"></span>
                  </template>
                </tool-tip>
              </div>
            </template>
          </template>
        </template>
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
