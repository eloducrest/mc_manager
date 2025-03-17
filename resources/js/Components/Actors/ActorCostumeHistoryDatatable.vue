<script setup lang="ts">
import {headers} from "@/datatables/actorCostumesHistoryDatatable";
import {useActorsStore} from "@/stores/actors";
import { useUtils } from "@/composables/utils";
</script>

<template>
  <EasyDataTable
    table-class-name="customize-table"
    :headers="headers"
    :items="useActorsStore().selectedActor.past_costume_histories"
    alternating>
    <template #item-created_at="{ created_at }">
      <span v-text="useUtils().formatDate(created_at)"></span>
    </template>
    <template #item-returned_at="{ returned_at }">
      <span v-text="useUtils().formatDate(returned_at)"></span>
    </template>
  </EasyDataTable>
</template>
