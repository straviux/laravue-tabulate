<template>
  <input type="checkbox" id="criterias-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative" v-if="contest">
      <label
        for="criterias-modal"
        class="btn btn-sm btn-circle absolute right-2 top-2"
        >✕</label
      >
      <h2 class="pb-4 text-2xl underline uppercase">
        {{ contest.contest_name }}
      </h2>
      <div class="text-sm breadcrumbs">
        <ul>
          <li>
            <a>{{ contest.event.event_name }}</a>
          </li>
          <li>
            <a>{{ contest.contest_name }}</a>
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
              <th class="text-[12px]">{{ criteria.order }}</th>
              <th>
                <button
                  @click="deleteSavedCriteria(criteria)"
                  class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
                >
                  delete
                </button>
              </th>
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
        <div v-if="!criterias.length" class="mt-8 text-center text-gray-600">
          You don't have any criterias created for this contest
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
          v-if="model.criterias.length"
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

// watch if props has been updated
watch(
  () => props.contest,
  (newVal, oldVal) => {
    if (props.contest) {
      store.dispatch("getCriterias", { id: props.contest.id });
    }
  }
);

// Create empty criteria array
let model = ref({
  criterias: [],
});

// Get criterias from store
const criterias = computed(() => store.state.criterias.data);

const addCriteria = (index) => {
  const newCriteria = {
    uuid: uuidv4(),
    order: index,
    percentage: "",
    contest_id: props.contest.id,
  };
  model.value.criterias.push(newCriteria);
};

const criteriaChange = (criteria) => {
  console.log(criteria);
  model.value.criterias = model.value.criterias.map((q) => {
    if (q.uuid === criteria.uuid) {
      return JSON.parse(JSON.stringify(criteria));
    }
    return q;
  });
};

const deleteCriteria = (criteria) => {
  model.value.criterias = model.value.criterias.filter((q) => q !== criteria);
};

const deleteSavedCriteria = (criteria) => {
  if (
    confirm(
      `Are you sure you want to delete this survey? Operation can't be undone!!`
    )
  ) {
    store.dispatch("deleteCriteria", criteria.id).then(() => {
      store.dispatch("getCriterias", { id: props.contest.id });
      // criterias = criterias.filter((q) => q !== criteria);
    });
  }
};

const saveCriterias = () => {
  const criterias = { ...model.value };
  store
    .dispatch("saveCriterias", criterias)
    .then(({ data }) => {
      model.value.criterias = [];
      store.dispatch("getCriterias", { id: props.contest.id });
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
