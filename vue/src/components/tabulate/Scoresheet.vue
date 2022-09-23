<template>
  <div class="bg-white p-4 rounded-lg">
    <div class="flex flex-col justify-start gap-2">
      <div class="text-sm breadcrumbs">
        <ul>
          <li>
            <a>Event</a>
          </li>
          <li>
            <a>Contest</a>
          </li>
          <li><a>Scoresheet</a></li>
        </ul>
      </div>
      <h3 class="text-xl font-bold mb-4">Judge Name</h3>
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
  <ScoresheetFormModal />
</template>
<script setup>
import store from "../../store";
import { ref, computed, watch } from "vue";
import { useRoute } from "vue-router";
import ScoresheetFormModal from "./ScoresheetFormModal.vue";

const route = useRoute();
const contest_id = route.params.contest_id;
const judge_id = route.params.judge_id;
const contestants = computed(() => store.state.contestants.data);
store.dispatch("getContestants", { id: contest_id });
</script>
