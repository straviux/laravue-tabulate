<template>
  <input type="checkbox" id="criterias-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative" v-if="contest">
      <label
        for="criterias-modal"
        class="btn btn-sm btn-circle absolute right-2 top-2"
        >✕</label
      >
      <h2 class="pb-4 text-2xl underline uppercase">{{ contest.name }}</h2>
      <div class="text-sm breadcrumbs">
        <ul>
          <li>
            <a>{{ contest.event.event_name }}</a>
          </li>
          <li>
            <a>{{ contest.name }}</a>
          </li>
          <li><a>Criteria</a></li>
        </ul>
      </div>
      <div class="py-4 flex flex-col justify-center items-center">
        <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>#</th>
              <th class="text-[12px]">Criteria</th>
              <th class="text-[12px]">Percentage</th>
              <th class="text-[12px]">Order</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(criteria, index) in criterias" :key="index">
              <th></th>
              <th class="text-[12px]">{{ criteria.criteria_name }}</th>
              <th class="text-[12px]">{{ criteria.percentage }}</th>
              <th class="text-[12px]">Order</th>
              <th></th>
            </tr>
            <tr v-for="(criteria, index) in model.criterias" :key="criteria.id">
              <CriteriaEditor
                :criteria="criteria"
                :index="index"
                @change="criteriaChange"
                @addCriteria="addCriteria()"
                @deleteCriteria="deleteCriteria"
              />
            </tr>
          </tbody>
        </table>
        <div v-if="!model.criterias.length" class="text-center text-gray-600">
          You don't have any criterias created
        </div>
      </div>
      <div class="py-4 flex justify-center gap-10 items-center">
        <button
          @click="addCriteria()"
          class="btn btn-sm gap-1 lg:btn-wide w-[150px] uppercase shadow mt-4 rounded btn-primary"
        >
          <mdicon name="plus" />Add Criteria
        </button>
        <button
          @click="saveCriterias()"
          class="btn btn-sm lg:btn-wide w-[150px] gap-1 uppercase shadow mt-4 rounded btn-success"
        >
          <mdicon name="content-save" />Save
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import store from "../../store";
import { v4 as uuidv4 } from "uuid";
import { computed, ref, watch } from "vue";
import CriteriaEditor from "./CriteriaEditor.vue";

const props = defineProps({
  contest: Object,
});

// Create empty survey
let model = ref({
  criterias: [],
});
const criterias = computed(() => store.state.criterias.data);
store.dispatch("getCriterias");
function addCriteria(index) {
  const newCriteria = {
    id: uuidv4(),
    order: index,
    percentage: "",
    contest_id: props.contest.id,
  };

  model.value.criterias.push(newCriteria);
}

function criteriaChange(criteria) {
  model.value.criterias = model.value.criterias.map((q) => {
    if (q.id === criteria.id) {
      return JSON.parse(JSON.stringify(criteria));
    }
    return q;
  });
}

function deleteCriteria(criteria) {
  model.value.criterias = model.value.criterias.filter((q) => q !== criteria);
}

// function saveCriterias() {
//   const criterias = { ...model.value };
//   console.log(criterias);
// }

const saveCriterias = () => {
  const criterias = { ...model.value };
  console.log(criterias);
  store
    .dispatch("saveCriterias", criterias)
    .then(({ data }) => {
      store.commit("notify", {
        type: "success",
        message: "Data was successfully saved",
      });
    })
    .catch((err) => {
      store.commit("notify", {
        type: "error",
        message: "Something went wrong, please try again or contact your admin",
      });
    });
};
</script>
