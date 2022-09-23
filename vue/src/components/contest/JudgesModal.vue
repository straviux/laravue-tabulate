<template>
  <input type="checkbox" id="judges-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative" v-if="contest">
      <label
        @click="resetModal()"
        for="judges-modal"
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
          <li><a>Judges</a></li>
        </ul>
      </div>
      <div class="py-4 flex flex-col justify-center items-center">
        <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>#</th>
              <th class="text-[12px]">Judge</th>
              <th class="text-[12px]">Position</th>
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
              v-for="(judge, index) in judges"
              :key="index"
              v-show="editRow !== judge.uuid"
            >
              <th class="text-[10px] text-gray-500">{{ index + 1 }}.</th>
              <th class="text-[12px]">{{ judge.judge_name }}</th>
              <th class="text-[12px]">{{ judge.position }}</th>
              <th class="text-[12px]">{{ judge.order }}</th>
              <th>
                <div v-if="!forUpdate && !newForm">
                  <button
                    @click="editData(judge)"
                    class="btn btn-ghost btn-xs text-[12px] text-orange-500 font-bold underline capitalize"
                  >
                    Edit
                  </button>

                  <button
                    @click="deleteSavedData(judge)"
                    class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize"
                  >
                    delete
                  </button>
                </div>
              </th>
            </tr>
            <tr v-for="(judge, index) in model.judges" :key="judge.id">
              <JudgeEditor
                :for-update="forUpdate"
                :judge="judge"
                :index="index"
                @change="dataChange"
                @deleteData="deleteData"
                @updateData="updateData"
                @cancelUpdate="cancelUpdate"
              />
            </tr>

            <tr v-show="!judges.length">
              <td colspan="4" class="pt-8 text-center text-gray-600">
                You don't have any judges created for this contest
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
          @click="addJudge()"
          class="btn btn-sm gap-1 lg:btn-wide w-[150px] uppercase shadow mt-4 rounded btn-primary"
        >
          <mdicon name="plus" />Add Judge
        </button>
        <button
          v-if="model.judges.length"
          @click="savejudges()"
          class="btn btn-sm lg:btn-wide w-[150px] bg-green-600 text-white gap-1 uppercase shadow mt-4 rounded btn-success"
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
import JudgeEditor from "./JudgeEditor.vue";
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
      store.dispatch("getJudges", { id: props.contest.id });
    }
  }
);

// Create empty judge array
const model = ref({
  judges: [],
});

const resetModal = () => {
  model.value.judges = [];
};
// Get judges from store
const isDataLoading = computed(() => store.state.judges.loading);
const judges = computed(() => store.state.judges.data);

const addJudge = (index) => {
  forUpdate.value = false;
  newForm.value = true;
  const newData = {
    uuid: uuidv4(),
    order: "",
    position: "",
    contest_id: props.contest.id,
  };
  model.value.judges.push(newData);
};

const editData = (c) => {
  editRow.value = c.uuid;
  forUpdate.value = true;

  const currentData = {
    id: c.id,
    uuid: c.uuid,
    order: c.order,
    position: c.position,
    contest_id: c.contest.id,
    judge_name: c.judge_name,
  };
  // console.log(c);
  model.value.judges.push(currentData);
};

const dataChange = (judge) => {
  model.value.judges = model.value.judges.map((q) => {
    if (q.uuid === judge.uuid) {
      return JSON.parse(JSON.stringify(judge));
    }
    return q;
  });
};

const deleteData = (judge) => {
  newForm.value = true;
  model.value.judges = model.value.judges.filter((q) => q !== judge);

  if (!model.value.judges.length) {
    newForm.value = false;
  }
};

const cancelUpdate = (judge) => {
  editRow.value = null;
  forUpdate.value = false;
  model.value.judges = model.value.judges.filter((q) => q !== judge);
};

const deleteSavedData = (judge) => {
  if (
    confirm(
      `Are you sure you want to delete this survey? Operation can't be undone!!`
    )
  ) {
    store.dispatch("deleteJudge", judge.id).then(() => {
      store.dispatch("getJudges", { id: props.contest.id });
    });
  }
};

const savejudges = () => {
  const _judges = { ...model.value };

  store
    .dispatch("saveJudges", _judges)
    .then(({ data }) => {
      model.value.judges = [];
      store.dispatch("getJudges", { id: props.contest.id });
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

const updateData = (judge) => {
  // console.log(judge);
  // return;
  store
    .dispatch("updateJudge", judge)
    .then(({ data }) => {
      store.dispatch("getJudges", { id: props.contest.id });
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
