<template>
  <td class="font-bold"></td>
  <td>
    <input
      type="text"
      :name="'criteria_' + model.data"
      v-model="model.criteria_name"
      @change="dataChange"
      :id="'criteria_' + model.data"
      class="mt-1 input input-bordered rounded-sm input-sm w-full shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td>
    <input
      type="text"
      :name="'criteria_percentage_' + model.id"
      v-model="model.percentage"
      @change="dataChange"
      :id="'criteria_percentage_' + model.id"
      class="mt-1 input input-bordered rounded-sm input-sm max-w-[80px] shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td>
    <input
      type="text"
      :name="'criteria_order_' + model.id"
      v-model="model.order"
      @change="dataChange"
      :id="'criteria_order_' + model.id"
      class="mt-1 input input-bordered rounded-sm input-sm max-w-[80px] shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td v-if="!forUpdate">
    <button
      @click="deleteCriteria()"
      class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
    >
      cancel
    </button>
  </td>
  <td v-else>
    <button
      @click="updateCriteria()"
      class="btn btn-ghost btn-xs text-[12px] text-green-500 font-bold underline capitalize"
    >
      update
    </button>
    <button
      @click="cancelUpdate()"
      class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
    >
      cancel
    </button>
  </td>

  <!-- Criterias index -->
</template>
<script setup>
import { ref } from "@vue/reactivity";

const props = defineProps({
  criteria: Object,
  index: Number,
  forUpdate: Boolean,
});

const emit = defineEmits([
  "change",
  "deleteCriteria",
  "updateCriteria",
  "cancelUpdate",
]);
const model = ref(JSON.parse(JSON.stringify(props.criteria)));

// Emit the data change
function dataChange() {
  const data = model.value;
  emit("change", data);
}

function deleteCriteria() {
  emit("deleteCriteria", props.criteria);
}

function updateCriteria() {
  emit("updateCriteria", props.criteria);
}
function cancelUpdate() {
  emit("cancelUpdate", props.criteria);
}
</script>
<style scoped>
.input {
  padding: 6px;
  font-size: 16px;
}
</style>
