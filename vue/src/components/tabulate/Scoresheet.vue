<template>
  <Loader v-if="currentJudgeLoading" />
  <div v-else class="bg-white p-4 rounded-lg">
    <h1 class="text-3xl uppercase font-semibold text-gray-600">
      Tabulating System
    </h1>
    <div class="mt-8 flex flex-col justify-start gap-2">
      <div class="text-sm breadcrumbs">
        <ul>
          <li>
            <a>{{ judge.event_name }}</a>
          </li>
          <li>
            <a>{{ judge.contest_name }}</a>
          </li>
          <li><a>Scoresheet</a></li>
        </ul>
      </div>
      <div class="flex items-end gap-3 py-4">
        <span class="font-semibold text-2xl uppercase text-slate-800">{{
          judge.judge_name
        }}</span>
        <span class="text-slate-600 italic text-normal uppercase">#Judge</span
        ><span class="text-slate-600 italic text-normal uppercase"
          >#{{ judge.position }}</span
        >
      </div>
    </div>
    <!-- <pre>{{ jscores }}</pre> -->
    <div class="overflow-x-auto w-full shadow rounded-lg">
      <table class="table w-full">
        <!-- head -->
        <thead>
          <tr>
            <th>#</th>
            <th>Contestant</th>
            <th>Score</th>
            <th>Rank</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(contestant, index) in contestants.sort(orderBy('order'))"
            :key="index + 10"
          >
            <td class="font-mono">{{ contestant.order }}</td>
            <td class="text-lg font-mono">{{ contestant.contestant_name }}</td>
            <td class="font-mono font-bold text-lg">
              {{ contestant.total || 0 }}
            </td>
            <td class="font-mono font-bold text-lg">
              {{ contestant.rank || `N/A` }}
            </td>
            <td>
              <div>
                <label
                  for="scoresheet-modal"
                  @click="openModal(contestant)"
                  class="font-mono btn btn-ghost btn-xs text-[16px] text-orange-500 font-bold underline capitaliz"
                  >Score</label
                >
              </div>
            </td>
          </tr>
          <!-- <tr v-else v-for="(contestant, index) in contestants" :key="index">
            <td class="font-mono">{{ contestant.order }}</td>
            <td class="text-lg font-mono">{{ contestant.contestant_name }}</td>
            <td class="font-mono font-bold text-lg">0</td>
            <td class="font-mono font-bold text-lg">N/A</td>
            <td>
              <div>
                <label
                  for="scoresheet-modal"
                  @click="model.contestant = contestant"
                  class="font-mono btn btn-ghost btn-xs text-[16px] text-orange-500 font-bold underline capitaliz"
                  >Score</label
                >
              </div>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
  <!-- <pre>{{ scores }}</pre> -->
  <ScoresheetModal
    :contestants="contestants"
    :criterias="criterias"
    :contestant="model.contestant"
    @changeContestant="changeContestant"
    @closeModal="refreshData"
    @refreshData="refreshData"
  />
</template>
<script setup>
import store from "../../store";
import { ref, computed, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import ScoresheetModal from "./ScoresheetModal.vue";
import Loader from "../Loader.vue";

const route = useRoute();
const router = userRouter();
const contest_id = route.params.contest_id;
const judge_id = route.params.judge_id;
const contestants = computed(() => store.state.contestants.data);
const judge = computed(() => store.state.currentJudge.data);
const model = ref({});
const currentJudgeLoading = computed(() => store.state.currentJudge.loading);
const criterias = computed(() => store.state.criterias.data);

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
store.dispatch("getCriterias", { id: contest_id });
store.dispatch("getContestantsByJudge", {
  contest_id: contest_id,
  judge_id: judge_id,
});
store.dispatch("getJudge", judge_id);
watch(
  () => store.state.contestants.data,
  (newVal, oldVal) => {
    model.value.contestants = newVal;
  }
);
const openModal = (contestant) => {
  model.value.contestant = contestant;
};
const refreshData = () => {
  store.dispatch("getContestantsByJudge", {
    contest_id: contest_id,
    judge_id: judge_id,
  });
  router.go(router.currentRoute);
};

const changeContestant = (data) => {
  store.dispatch("getContestantsByJudge", {
    contest_id: contest_id,
    judge_id: judge_id,
  });
  model.value.contestant = data;
};
</script>
