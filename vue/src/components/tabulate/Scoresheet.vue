<template>
  <Loader v-if="currentJudgeLoading" />
  <div v-else class="bg-white p-4 rounded-lg">
    <div class="flex flex-col justify-start gap-2">
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
          <tr v-for="(contestant, index) in contestants" :key="index">
            <td class="font-mono">{{ contestant.order }}</td>
            <td class="text-lg font-mono">{{ contestant.contestant_name }}</td>
            <td class="font-mono font-bold text-lg">2</td>
            <td class="font-mono font-bold text-lg">42</td>
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
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <ScoresheetModal
    :contestants="contestants"
    :criterias="criterias"
    :contestant="model.contestant"
    :index="parseInt(judge_id)"
  />
</template>
<script setup>
import store from "../../store";
import { ref, computed, watch } from "vue";
import { useRoute } from "vue-router";
import ScoresheetModal from "./ScoresheetModal.vue";
import Loader from "../Loader.vue";

const route = useRoute();
const contest_id = route.params.contest_id;
const judge_id = route.params.judge_id;
const contestants = computed(() => store.state.contestants.data);
const judge = computed(() => store.state.currentJudge.data);
const model = ref({});
const currentJudgeLoading = computed(() => store.state.currentJudge.loading);
const criterias = computed(() => store.state.criterias.data);
store.dispatch("getCriterias", { id: contest_id });
store.dispatch("getContestants", { id: contest_id });
store.dispatch("getJudge", judge_id);
</script>
