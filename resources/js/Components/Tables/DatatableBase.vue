<script setup lang="ts">
import type {Header, Item} from "vue3-easy-data-table";

withDefaults(
  defineProps<{
    headers: Header[];
    hideFooter?: true | false;
    items: Item[];
  }>(),
  {
    hideFooter: false,
  }
);</script>

<template>
  <EasyDataTable
    table-class-name="customize-table"
    :headers="headers"
    :hide-footer="hideFooter"
    :items="items"
    empty-message="Aucune donnée disponible"
    alternating>
    <template v-for="(slot, name) in $slots" v-slot:[name]="slotProps">
      <slot :name="name" v-bind="slotProps"></slot>
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
