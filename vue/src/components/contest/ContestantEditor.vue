<template>
  <td class="font-bold">{{ index + 1 }}</td>
  <td>
    <input
      type="text"
      :name="'data_1_' + model.data"
      v-model="model.contestant_name"
      @change="dataChange"
      :id="'data_1_' + model.data"
      class="mt-1 input input-bordered rounded-sm input-sm w-full shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td>
    <input
      type="text"
      :name="'data_2_' + model.id"
      v-model="model.order"
      @change="dataChange"
      :id="'data_2_' + model.id"
      class="mt-1 input input-bordered rounded-sm input-sm max-w-[80px] shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td>
    <button
      @click="removeItem()"
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
  __data: Object,
  index: Number,
});

const emit = defineEmits(["change", "addItem", "removeItem"]);
const model = ref(JSON.parse(JSON.stringify(props.__data)));

// Emit the data change
function dataChange() {
  const data = model.value;
  emit("change", data);
}

function addItem() {
  emit("addItem", props.index + 1);
}

function removeItem() {
  emit("removeItem", props.__data);
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
