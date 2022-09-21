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
          <tbody v-if="isDataLoading">
            <tr>
              <th colspan="4" class="pt-4">
                <Loader :is-full-screen="false" />
              </th>
            </tr>
          </tbody>
          <tbody v-else>
            <tr
              v-for="(criteria, index) in criterias"
              :key="index"
              v-show="editRow !== criteria.uuid"
            >
              <th></th>
              <th class="text-[12px]">{{ criteria.criteria_name }}</th>
              <th class="text-[12px]">{{ criteria.percentage }}</th>
              <th class="text-[12px]">{{ criteria.order }}</th>
              <th>
                <div v-if="!newForm">
                  <button
                    @click="editCriteria(criteria)"
                    class="btn btn-ghost btn-xs text-[12px] text-orange-500 font-bold underline capitalize"
                  >
                    Edit
                  </button>

                  <button
                    @click="deleteSavedCriteria(criteria)"
                    class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
                  >
                    delete
                  </button>
                </div>
              </th>
            </tr>
            <tr
              v-if="criterias.length"
              v-for="(criteria, index) in model.criterias"
              :key="criteria.id"
            >
              <CriteriaEditor
                :for-update="forUpdate"
                :criteria="criteria"
                :index="index"
                @change="criteriaChange"
                @deleteCriteria="deleteCriteria"
                @updateCriteria="updateCriteria"
                @cancelUpdate="cancelUpdate"
              />
            </tr>

            <tr v-show="!criterias.length">
              <td colspan="4" class="pt-8 text-center text-gray-600">
                You don't have any criterias created for this contest
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div
        class="py-4 flex justify-center gap-10 items-center"
        v-if="formCount + 1 && !forUpdate"
      >
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
import Loader from "../Loader.vue";

const props = defineProps({
  contest: Object,
});

const newForm = ref(false);
const forUpdate = ref(false);
const editRow = ref();
const formCount = ref(0);
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
const model = ref({
  criterias: [],
});

// Get criterias from store
const isDataLoading = computed(() => store.state.criterias.loading);
const criterias = computed(() => store.state.criterias.data);

const addCriteria = (index) => {
  formCount.value += 1;
  forUpdate.value = false;
  newForm.value = true;
  const newCriteria = {
    uuid: uuidv4(),
    order: "",
    percentage: "",
    contest_id: props.contest.id,
  };
  model.value.criterias.push(newCriteria);
};

const editCriteria = (c) => {
  editRow.value = c.uuid;
  forUpdate.value = true;

  const currentCriteria = {
    uuid: c.uuid,
    order: c.order,
    percentage: c.percentage,
    contest_id: c.contest.id,
    criteria_name: c.criteria_name,
  };
  console.log(c);
  model.value.criterias.push(currentCriteria);
};

const criteriaChange = (criteria) => {
  model.value.criterias = model.value.criterias.map((q) => {
    if (q.uuid === criteria.uuid) {
      return JSON.parse(JSON.stringify(criteria));
    }
    return q;
  });
};

const deleteCriteria = (criteria) => {
  console.log(formCount.value);
  if (formCount.value && formCount.value !== 1) {
    formCount.value -= 1;
    newForm.value = false;
  } else {
    newForm.value = true;
  }
  model.value.criterias = model.value.criterias.filter((q) => q !== criteria);
};

const cancelUpdate = (criteria) => {
  editRow.value = null;
  forUpdate.value = false;
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

const updateCriteria = (criteria) => {
  store
    .dispatch("updateCriteria", criteria)
    .then(({ data }) => {
      store.commit("notify", {
        type: "success",
        message: "Contest data was successfully updated",
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
