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
            model.contestant.contestant_name
          }}</span
          ><span class="text-slate-600 italic text-normal uppercase"
            >contestant # {{ model.contestant.order }}</span
          >
        </div>
        <form id="score-sheet" @submit.prevent="saveScore">
          <table class="table w-full">
            <tr
              v-if="
                model.contestant.scores.length &&
                model.contestant.scores.length == criterias.length
              "
              v-for="(data, index) in model.contestant.scores.sort(
                orderBy('criteria_name')
              )"
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
                :contestant="model.contestant"
                :index="index"
                @change="dataChange"
              />
            </tr>
            <tr>
              <td class="text-right w-2/3">
                <span class="uppercase mr-8 font-bold text-slate-600 font-mono"
                  >Total:</span
                >
              </td>
              <td>
                <span class="ml-6 text-xl font-bold text-slate-600">{{
                  total
                }}</span>
              </td>
            </tr>
          </table>
          <div
            class="modal-action flex items-center justify-between pt-6 border-t-8"
          >
            <div class="space-x-3 flex items-center">
              <button
                @click.prevent="prevContestant()"
                class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
              >
                <mdicon name="arrow-left" width="16" />Previous
              </button>
              <button
                @click.prevent="nextContestant()"
                class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
              >
                Next<mdicon name="arrow-right" width="16" />
              </button>
            </div>
            <div class="flex items-center">
              <button
                type="submit"
                class="btn btn-sm bg-emerald-600 text-white w-[120px] gap-2 outline-none border-none rounded text-[12px] shadow"
              >
                Save <mdicon name="content-save-outline" width="20" />
              </button>
            </div>
          </div>
        </form>
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
const model = ref({ scoreSheet: [], contestant: {}, forUpdate: false });
const modal_toggle = ref();
const total = computed(() => {
  let result = 0;
  if (model.value.scoreSheet.length) {
    for (let i = 0; model.value.scoreSheet.length > i; i++) {
      result += parseFloat(model.value.scoreSheet[i].score);
    }
  } else {
    result = model.value.contestant.total;
  }
  return result;
});

const emit = defineEmits(["closeModal", "changeContestant", "refreshData"]);
watch(
  () => props.contestant,
  (newVal, oldVal) => {
    model.value.contestant = newVal;
    console.log(newVal);
  }
);
watch(
  () => props.contestants,
  (newVal, oldVal) => {
    let currentIndex = newVal.findIndex(
      (x) => x.order === model.value.contestant.order
    );
    model.value.contestant = newVal[currentIndex];
    //reset
  }
);
watch(
  () => modal_toggle.value,
  (newVal, oldVal) => {
    if (modal_toggle.value && props.contestant) {
      model.value.contestant = props.contestant;
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
  model.value.forUpdate = true;
  model.value.scoreSheet.push(scoreSheet);
};

const nextContestant = () => {
  const _contestants = JSON.parse(JSON.stringify(props.contestants));
  const _contestants_count = _contestants.length;
  const currentContestant = model.value.contestant;
  let currentIndex = _contestants.findIndex(
    (x) => x.order === currentContestant.order
  );

  if (currentIndex !== _contestants_count) {
    if (currentIndex == _contestants_count - 1) return;
    const nextContestant = _contestants[currentIndex + 1];
    emit("changeContestant", nextContestant);
  }
  model.value.scoreSheet = [];
  return;
};

const prevContestant = () => {
  const _contestants = JSON.parse(JSON.stringify(props.contestants));
  const currentContestant = model.value.contestant;
  let currentIndex = _contestants.findIndex(
    (x) => x.order === currentContestant.order
  );
  if (currentIndex >= 0) {
    if (currentIndex === 0) return;
    const nextContestant = _contestants[currentIndex - 1];
    emit("changeContestant", nextContestant);
  }
  model.value.scoreSheet = [];
  return;
};

const saveScore = (event) => {
  event.preventDefault();
  const form = document.getElementById("score-sheet");
  for (const element of form.elements) {
    console.log(element.value);
    if (element.type === "text") {
      if (!element.value || element.value == 0) {
        store.commit("notify", {
          type: "error",
          message: "You must fill out all fields before saving..",
        });
        return false;
      }
    }
  }
  console.log(model.value.forUpdate);
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
      store.dispatch("getScore", {
        judge_id: contestantScore.judge_id,
        contestant_id: contestantScore.contestant_id,
      });
      store.commit("notify", {
        type: "success",
        message: "Data was successfully saved",
      });
      model.value.scoreSheet = [];

      emit("refreshData");
    })
    .catch((err) => {
      store.commit("notify", {
        type: "error",
        message: "Something went wrong, please try again or contact your admin",
      });
    });
};

const orderBy = (property) => {
  var sortOrder = 1;
  if (property[0] === "-") {
    sortOrder = -1;
    property = property.substr(1);
  }
  return function (a, b) {
    /* next line works with strings and numbers,
     * and you may want to customize it to your needs
     */
    var result =
      a[property] < b[property] ? -1 : a[property] > b[property] ? 1 : 0;
    return result * sortOrder;
  };
};

document.addEventListener(
  "paste",
  (evt) => {
    evt.preventDefault();
  },
  false
);
</script>
