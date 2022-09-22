<template>
  <td class="font-bold"></td>
  <td>
    <input
      type="text"
      :name="'input_1_' + model.id"
      v-model="model.contestant_name"
      @change="dataChange"
      :id="'input_1_' + model.id"
      class="mt-1 input input-bordered rounded-sm input-sm w-full shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td>
    <input
      type="text"
      :name="'input_3_' + model.id"
      v-model="model.order"
      @change="dataChange"
      :id="'input_3_' + model.id"
      class="mt-1 input input-bordered rounded-sm input-sm max-w-[80px] shadow-sm sm:text-sm focus:outline-none px-2 py-1"
    />
  </td>
  <td v-if="!forUpdate">
    <button
      @click="deleteData()"
      class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
    >
      cancel
    </button>
  </td>
  <td v-else>
    <button
      @click="updateData()"
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

  <!-- judges index -->
</template>
<script setup>
import { ref } from "@vue/reactivity";

const props = defineProps({
  contestant: Object,
  index: Number,
  forUpdate: Boolean,
});

const emit = defineEmits([
  "change",
  "deleteData",
  "updateData",
  "cancelUpdate",
]);
const model = ref(JSON.parse(JSON.stringify(props.contestant)));

// Emit the data change
function dataChange() {
  const data = model.value;
  emit("change", data);
}

function deleteData() {
  emit("deleteData", props.contestant);
}

function updateData() {
  emit("updateData", props.contestant);
}
function cancelUpdate() {
  emit("cancelUpdate", props.contestant);
}
</script>
<style scoped>
.input {
  padding: 6px;
  font-size: 16px;
}
</style>
