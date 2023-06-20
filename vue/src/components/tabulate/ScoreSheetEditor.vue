<template>
  <td class="text-right w-2/3">
    <label for="" class="uppercase mr-8 font-semibold"
      >{{ criteria.criteria_name }} (
      <span class="font-mono text-lg text-slate-500"
        >{{ criteria.percentage }}%</span
      >
      ):</label
    >
  </td>
  <td>
    <input
      @keypress="$filters.numericOnly($event)"
      @input="getInput(criteria.percentage)"
      @change="dataChange"
      @focusin="model.score == 0 ? (model.score = '') : null"
      @focusout="model.score == '' ? (model.score = 0) : null"
      v-model="model.score"
      type="text"
      class="mt-1 input input-bordered text-2xl input-sm text-center border-emerald-500 rounded-sm w-[75px] h-[40px] focus:outline-none"
    />
  </td>
</template>
<script setup>
import { ref, watch } from "vue";
import store from "../../store";

const props = defineProps({
  score_id: Number,
  score: Number,
  criteria: Object,
  contestant: Object,
  index: Number,
});

const emit = defineEmits(["change", "getCurrentScore"]);
const model = ref(JSON.parse(JSON.stringify(props)));
model.value.forUpdate = false;
model.value.score = model.value.score || 0;

watch(
  () => model.value.score,
  (newVal, oldVal) => {
    if (oldVal !== newVal) {
      // console.log(model.value);
      dataChange();
    }
  }
);
if (model.value.score_id !== null) {
  model.value.forUpdate = true;
  const data = model.value;
  emit("getCurrentScore", data);
}

const getInput = (maxInput) => {
  if (model.value.score > maxInput) {
    store.commit("notify", {
      type: "error",
      message:
        "You have exceeded maximum value for this criteria, Please try again",
    });
    model.value.score = "";
  }

  return;
};

// Emit the data change
function dataChange() {
  let data = model.value;
  // data.score = data.score == "" ? 0 : data.score;
  emit("change", data);
}
</script>
<style scoped>
.input {
  padding: 6px;
  font-size: 16px;
}
</style>
