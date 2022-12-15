<template>
  <div class="flex flex-col gap-10 p-7">
    <h4 class="font-bold text-slate-600 text-2xl -mb-8">FINAL RESULT</h4>
    <div
      class="flex p-2 my-4 bg-white rounded-lg shadow items-center justify-between px-8"
    >
      <div class="flex gap-12 items-center">
        <span>Event: </span>
        <div class="form-control w-[250px] -ml-8">
          <select
            class="select select-sm select-bordered w-full"
            v-model="model.event_id"
          >
            <option
              v-for="({ id, event_name }, index) in events"
              :key="index"
              :value="id"
              required
              class="text-lg"
            >
              {{ event_name }}
            </option>
          </select>
        </div>

        <span>Contest: </span>
        <div class="form-control w-[250px] -ml-8">
          <select
            class="select select-sm select-bordered w-full"
            @change="getFinalresult"
            v-model="model.contest"
          >
            <option
              v-for="(contest, index) in contests"
              :key="index"
              :value="contest"
              required
              class="text-lg"
            >
              {{ contest["contest_name"] }}
            </option>
          </select>
        </div>
      </div>
      <div class="flex gap-3 items-center -ml-24"></div>
      <div>
        <button class="btn" @click="getFinalresult">Print</button>
      </div>
    </div>
    <div
      class="shadow-lg flex bg-white rounded-lg flex-col justify-center items-center"
    >
      <!-- <pre>{{ finalresult }}</pre> -->
      <table class="table w-full -mt-4" v-if="finalresult.length">
        <!-- head -->
        <thead class="text-center">
          <tr>
            <th class="text-left w-[20%] text-[14px]">Contestant</th>
            <th class="text-[14px]" v-for="(d, i) in finalresult[0].scores">
              {{ d.judge_name }}
            </th>

            <th class="text-[14px] w-[5%]">Total</th>
            <th class="text-[14px] w-[5%]">Rank</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr v-for="(data, index) in finalresult">
            <td class="text-[16px] font-semibold uppercase text-left">
              {{ data.contestant }}
            </td>
            <td class="text-[18px] font-semibold" v-for="(d, i) in data.scores">
              {{ d.total }}
            </td>
            <td class="font-bold">{{ data.grand_total.toFixed(2) }}</td>
            <td class="font-bold">{{ data.rank }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
import { ref, watch, computed } from "vue";
import store from "../store";
import Loader from "../components/Loader.vue";

const model = ref({
  event_id: "",
  judge_id: "",
  contest: "",
});

const events = computed(() => store.state.events.data);
const contestsLoading = computed(() => store.state.contests.loading);
const contests = computed(() => store.state.contests.data);
const finalresult = computed(() => store.state.results.data);
// const judges = ref({});

store.dispatch("getEvents");

watch(
  () => model.value.event_id,
  (newVal, oldVal) => {
    store.dispatch("getContestsByEvent", model.value.event_id);
  }
);

const getFinalresult = () => {
  // console.log(model.value.contest);
  store.dispatch("getFinalResult", model.value.contest.id);
};
</script>
