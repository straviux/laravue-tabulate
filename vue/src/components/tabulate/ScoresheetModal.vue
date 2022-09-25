<template>
  <div v-if="contestant" class="z-20">
    <input
      type="checkbox"
      id="scoresheet-modal"
      v-model="modal_toggle"
      class="modal-toggle"
    />
    <div class="modal">
      <div class="modal-box w-[550px] max-w-3xl relative">
        <label
          @click="resetModal()"
          for="scoresheet-modal"
          class="btn btn-sm btn-circle absolute right-2 top-2"
          >✕</label
        >

        <div class="flex items-end gap-3 py-3 border-b-8">
          <span class="font-semibold text-2xl uppercase text-slate-800">{{
            contestant.contestant_name
          }}</span
          ><span class="text-slate-600 italic text-normal uppercase"
            >contestant # {{ contestant.order }}</span
          >
          {{ contestant.order }}
        </div>
        <table class="table w-full">
          <tr
            v-if="contestant.scores !== undefined"
            v-for="(data, index) in contestant.scores"
            :class="index !== criterias.length - 1 ? 'border-b' : ''"
          >
            <ScoreSheetEditor
              :key="data.score_id"
              :score="data.score || 0"
              :score_id="data.score_id || null"
              :criteria="{
                criteria_name: data.criteria_name,
                criteria_id: data.criteria_id,
                percentage: data.criteria_percentage,
              }"
              :contestant="{
                contestant_name: data.contestant_name,
                order: data.order,
                contestant_id: data.contestant_id,
              }"
              :index="index"
              @change="dataChange"
              @getCurrentScore="getCurrentScore"
            />
          </tr>
          <tr
            v-else
            v-for="(criteria, index) in criterias"
            :class="index !== criterias.length - 1 ? 'border-b' : ''"
          >
            <ScoreSheetEditor
              :key="index"
              :score="0"
              :score_id="null"
              :criteria="{
                criteria_name: criteria.criteria_name,
                criteria_id: criteria.id,
                percentage: criteria.percentage,
              }"
              :contestant="currContestant"
              :index="index"
              @change="dataChange"
            />
          </tr>
        </table>
        <div
          class="modal-action flex items-center justify-between pt-6 border-t-8"
        >
          <div class="space-x-3 flex items-center">
            <button
              @click="prevContestant()"
              class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
            >
              <mdicon name="arrow-left" width="16" />Previous
            </button>
            <button
              @click="nextContestant()"
              class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
            >
              Next<mdicon name="arrow-right" width="16" />
            </button>
          </div>
          <div class="flex items-center">
            <button
              @click="saveScore()"
              class="btn btn-sm bg-emerald-600 text-white w-[120px] gap-2 outline-none border-none rounded text-[12px] shadow"
            >
              Save <mdicon name="content-save-outline" width="20" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, watch, computed } from "vue";
import { useRoute } from "vue-router";
import { v4 as uuidv4 } from "uuid";
import store from "../../store";
import ScoreSheetEditor from "./ScoreSheetEditor.vue";
const props = defineProps({
  criterias: Object,
  contestant: Object,
  contestants: Object,
  index: Number,
  forUpdate: Boolean,
});

const route = useRoute();
const judge_id = route.params.judge_id;
const contest_id = route.params.contest_id;
const model = ref({ scoreSheet: [] });
const modal_toggle = ref();
const currContestant = ref({});
const score = computed(() => store.state.currentScore.data);
model.value.forUpdate = false;

const emit = defineEmits(["closeModal", "changeContestant", "refreshData"]);
// currContestant.val = props.contestant
//   ? JSON.parse(JSON.stringify(props.contestant))
//   : null;

watch(
  () => modal_toggle.value,
  (newVal, oldVal) => {
    if (modal_toggle.value && props.contestant) {
      currContestant.val = props.contestant;
      store.dispatch("getScore", {
        judge_id: judge_id,
        contestant_id: props.contestant.contestant_id,
      });
    } else {
      store.state.currentScore.data = [];
    }
  }
);

const resetModal = () => {
  emit("closeModal");
  model.value.scoreSheet = [];
  model.value.forUpdate = false;
};

const dataChange = (data) => {
  model.value.forUpdate = data.forUpdate;

  if (
    model.value.scoreSheet.length < props.criterias.length &&
    !model.value.forUpdate
  ) {
    const newSheet = {
      uuid: uuidv4(),
      criteria_id: data.criteria.criteria_id,
      score: data.score,
    };
    model.value.scoreSheet.push(newSheet);
    return;
  } else {
    model.value.scoreSheet = model.value.scoreSheet.map((q) => {
      if (q.id === data.score_id) {
        return {
          id: data.score_id,
          criteria_id: data.criteria.criteria_id,
          score: data.score,
        };
      }
      // return q;
      return {
        id: q.id,
        criteria_id: data.criteria.criteria_id,
        score: q.score,
      };
    });
  }
};

const getCurrentScore = (data) => {
  const scoreSheet = {
    id: data.score_id,
    criteria_id: data.criteria.criteria_id,
    score: data.score,
  };
  model.value.scoreSheet.push(scoreSheet);
};

const nextContestant = () => {
  const _contestants = JSON.parse(JSON.stringify(props.contestants));
  const _contestants_count = _contestants.length;
  const currentContestant = currContestant.val;
  let currentIndex = _contestants.findIndex(
    (x) => x.order === currentContestant.order
  );
  console.log(currentIndex);

  if (currentIndex !== _contestants_count) {
    if (currentIndex == _contestants_count - 1) return;
    currContestant.val = _contestants[currentIndex + 1];
    store.dispatch("getScore", {
      judge_id: judge_id,
      contestant_id: currContestant.val.contestant_id,
    });

    emit("changeContestant", currContestant.val);
  }
  return;
  // console.log(currContestant.val);
};

const prevContestant = () => {
  const _contestants = JSON.parse(JSON.stringify(props.contestants));
  const _contestants_count = _contestants.length;
  const currentContestant = currContestant.val;
  let currentIndex = _contestants.findIndex(
    (x) => x.order === currentContestant.order
  );
  if (currentIndex >= 0) {
    if (currentIndex === 0) return;
    currContestant.val = _contestants[currentIndex - 1];
    store.dispatch("getScore", {
      judge_id: judge_id,
      contestant_id: currContestant.val.contestant_id,
    });
    emit("changeContestant", currContestant.val);
  }
  return;
};

const saveScore = () => {
  const contestantScore = {
    contestant_id: props.contestant.contestant_id,
    contest_id: contest_id,
    judge_id: judge_id,
    scores: JSON.parse(JSON.stringify(model.value.scoreSheet)),
  };

  store
    .dispatch("saveScore", {
      scores: contestantScore,
      forUpdate: model.value.forUpdate,
    })
    .then(({ data }) => {
      model.value.scoreSheet = [];
      model.value.forUpdate = false;
      emit("refreshData");
      store.dispatch("getScore", {
        judge_id: contestantScore.judge_id,
        contestant_id: contestantScore.contestant_id,
      });
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

document.addEventListener(
  "paste",
  (evt) => {
    evt.preventDefault();
  },
  false
);
</script>
