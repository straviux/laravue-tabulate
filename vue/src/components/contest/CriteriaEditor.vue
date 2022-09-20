<template>
  <td class="font-bold">{{ index + 1 }}</td>
  <td>
    <input
      type="text"
      :name="'criteria_' + model.data"
      v-model="model.critera"
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
  <td>
    <button
      @click="deleteCriteria()"
      class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
    >
      delete
    </button>
  </td>

  <!-- Criterias index -->
</template>
<script setup>
import { ref } from "@vue/reactivity";

const props = defineProps({
  criteria: Object,
  index: Number,
});

const emit = defineEmits(["change", "addCriteria", "deleteCriteria"]);
const model = ref(JSON.parse(JSON.stringify(props.criteria)));

// Emit the data change
function dataChange() {
  const data = model.value;
  emit("change", data);
}

function addCriteria() {
  emit("addCriteria", props.index + 1);
}

function deleteCriteria() {
  emit("deleteCriteria", props.criteria);
}
// const addCriteria = (index) => {
//   const newCriteria = {
//     criteria: "",
//     percentage: "",
//     order: null,
//   };

//   model.value.criterias.splice(index, 0, newCriteria);
// };
</script>
<style scoped>
.input {
  padding: 6px;
  font-size: 16px;
}
</style>
