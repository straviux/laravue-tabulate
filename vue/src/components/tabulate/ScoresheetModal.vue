<template>
  <div v-if="contestant" class="z-20">
    <input type="checkbox" id="scoresheet-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box w-[550px] max-w-3xl relative">
        <label
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
        </div>
        <table class="table w-full">
          <tr
            v-for="(criteria, index) in criterias"
            :class="index !== criterias.length - 1 ? 'border-b' : ''"
          >
            <ScoreSheetEditor
              :criteria="criteria"
              :contestant="contestant"
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
              class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
            >
              <mdicon name="arrow-left" width="16" />Previous
            </button>
            <button
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
const model = ref({ scoreSheet: [] });
const score = computed(() => store.state.currentScore.data);

watch(
  () => props.contestant,
  (newVal, oldVal) => {
    if (props.contestant) {
      store.dispatch("getScore", {
        judge_id: judge_id,
        contestant_id: props.contestant.id,
      });
    }
  }
);
// store.dispatch("getScore", {
//   judge_id: judge_id,
//   contestant_id: props.contestant.id,
// });

const dataChange = (data) => {
  let hasNewVal = false;
  model.value.scoreSheet = model.value.scoreSheet.map((q) => {
    if (q.criteria_id === data.criteria.id) {
      hasNewVal = true;
      return {
        criteria_id: data.criteria.id,
        score: data.score,
      };
    }
    return q;
  });
  if (hasNewVal) {
    return;
  }
  const scoreSheet = {
    criteria_id: data.criteria.id,
    score: data.score,
  };
  model.value.scoreSheet.push(scoreSheet);
};

const saveScore = () => {
  const contestantScore = {
    contestant_id: props.contestant.id,
    contest_id: props.contestant.contest.id,
    judge_id: judge_id,
    scores: JSON.parse(JSON.stringify(model.value.scoreSheet)),
  };

  store
    .dispatch("saveScore", contestantScore)
    .then(({ data }) => {
      model.value.criterias = [];
      store.dispatch("getScore", {
        judge_id: props.judge_id.id,
        contestant_id: props.contestant.id,
      });
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

document.addEventListener(
  "paste",
  (evt) => {
    evt.preventDefault();
  },
  false
);
// const model = ref(JSON.parse(JSON.stringify(props.criterias)));
</script>
