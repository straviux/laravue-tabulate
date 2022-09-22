<template>
  <input type="checkbox" id="contestants-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative" v-if="contest">
      <label
        @click="resetModal()"
        for="contestants-modal"
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
          <li><a>Contestants</a></li>
        </ul>
      </div>
      <div class="py-4 flex flex-col justify-center items-center">
        <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>#</th>
              <th class="text-[12px]">Contestant</th>
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
              v-for="(contestant, index) in contestants"
              :key="index"
              v-show="editRow !== contestant.uuid"
            >
              <th class="text-[10px] text-gray-500">{{ index + 1 }}.</th>
              <th class="text-[12px]">{{ contestant.contestant_name }}</th>
              <th class="text-[12px]">{{ contestant.order }}</th>
              <th>
                <div v-if="!forUpdate && !newForm">
                  <button
                    @click="editData(contestant)"
                    class="btn btn-ghost btn-xs text-[12px] text-orange-500 font-bold underline capitalize"
                  >
                    Edit
                  </button>

                  <button
                    @click="deleteSavedData(contestant)"
                    class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
                  >
                    delete
                  </button>
                </div>
              </th>
            </tr>
            <tr
              v-for="(contestant, index) in model.contestants"
              :key="contestant.id"
            >
              <ContestantEditor
                :for-update="forUpdate"
                :contestant="contestant"
                :index="index"
                @change="dataChange"
                @deleteData="deleteData"
                @updateData="updateData"
                @cancelUpdate="cancelUpdate"
              />
            </tr>

            <tr v-show="!contestants.length">
              <td colspan="4" class="pt-8 text-center text-gray-600">
                You don't have any contestants created for this contest
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div
        class="py-4 flex justify-center gap-10 items-center"
        v-if="!forUpdate"
      >
        <button
          @click="addContestant()"
          class="btn btn-sm gap-1 lg:btn-wide w-[150px] uppercase shadow mt-4 rounded btn-primary"
        >
          <mdicon name="plus" />Add Contestant
        </button>
        <button
          v-if="model.contestants.length"
          @click="saveContestants()"
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
import ContestantEditor from "./ContestantEditor.vue";
import Loader from "../Loader.vue";

const props = defineProps({
  contest: Object,
});

const newForm = ref(false);
const forUpdate = ref(false);
const editRow = ref();
// watch if props has been updated
watch(
  () => props.contest,
  (newVal, oldVal) => {
    if (props.contest) {
      store.dispatch("getContestants", { id: props.contest.id });
    }
  }
);

// Create empty contestant array
const model = ref({
  contestants: [],
});

const resetModal = () => {
  model.value.contestants = [];
};
// Get contestants from store
const isDataLoading = computed(() => store.state.contestants.loading);
const contestants = computed(() => store.state.contestants.data);

const addContestant = (index) => {
  forUpdate.value = false;
  newForm.value = true;
  const newData = {
    uuid: uuidv4(),
    order: "",
    contest_id: props.contest.id,
  };
  model.value.contestants.push(newData);
};

const editData = (c) => {
  editRow.value = c.uuid;
  forUpdate.value = true;

  const currentData = {
    id: c.id,
    uuid: c.uuid,
    order: c.order,
    contest_id: c.contest.id,
    contestant_name: c.contestant_name,
  };
  // console.log(c);
  model.value.contestants.push(currentData);
};

const dataChange = (contestant) => {
  model.value.contestants = model.value.contestants.map((q) => {
    if (q.uuid === contestant.uuid) {
      return JSON.parse(JSON.stringify(contestant));
    }
    return q;
  });
};

const deleteData = (contestant) => {
  newForm.value = true;
  model.value.contestants = model.value.contestants.filter(
    (q) => q !== contestant
  );

  if (!model.value.contestants.length) {
    newForm.value = false;
  }
};

const cancelUpdate = (contestant) => {
  editRow.value = null;
  forUpdate.value = false;
  model.value.contestants = model.value.contestants.filter(
    (q) => q !== contestant
  );
};

const deleteSavedData = (contestant) => {
  console.log(contestant.id);
  if (
    confirm(
      `Are you sure you want to delete this survey? Operation can't be undone!!`
    )
  ) {
    store.dispatch("deleteContestant", contestant.id).then((res) => {
      store.dispatch("getContestants", { id: props.contest.id });
    });
  }
};

const saveContestants = () => {
  const _contestants = { ...model.value };

  store
    .dispatch("saveContestants", _contestants)
    .then(({ data }) => {
      model.value.contestants = [];
      store.dispatch("getContestants", { id: props.contest.id });
      store.commit("notify", {
        type: "success",
        message: "Data was successfully saved",
      });
      newForm.value = false;
    })
    .catch((err) => {
      store.commit("notify", {
        type: "error",
        message: "Something went wrong, please try again or contact your admin",
      });
    });
};

const updateData = (contestant) => {
  store
    .dispatch("updateContestant", contestant)
    .then(({ data }) => {
      store.dispatch("getContestants", { id: props.contest.id });
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
