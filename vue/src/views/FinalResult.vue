<template>
  <div class="flex flex-col gap-10 p-7">
    <h4 class="font-bold text-slate-600 text-2xl -mb-8 no-print">
      FINAL RESULT
    </h4>
    <div
      class="flex p-2 my-4 bg-white rounded-lg shadow items-center justify-between px-8 no-print"
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
        <button class="btn" @click="PrintElem">Print</button>
      </div>
    </div>
    <div
      class="shadow-lg flex bg-white rounded-lg flex-col justify-center items-center px-12 pb-12 print-div"
    >
      <div class="display-on-print">
        <div class="flex items-center justify-center mt-4 gap-4">
          <img src="../assets/moa_logo.png" class="w-[90px] h-[90px] ml-16" />
          <div class="text-center ml-8">
            <p class="text-lg">Republic of the Philippines</p>
            <p class="text-lg -mt-1">Province of Palawan</p>
            <p class="text-lg -mt-1">Municipality of Aborlan</p>
          </div>
          <img src="../assets/rakudan_banner.png" class="w-[168px] mt-4 ml-4" />
        </div>
      </div>

      <p class="text-2xl font-semibold text-center mt-2 uppercase">
        {{ model.contest.contest_name }}
      </p>
      <div class="display-on-print">
        <p class="uppercase text-center text-xl font-semibold">Final Result</p>
      </div>

      <table class="table table-compact mt-4" v-if="finalresult.length">
        <!-- head -->
        <thead class="text-center">
          <tr>
            <th class="text-left font-semibold w-[20%] text-[12px]">
              Contestant
            </th>
            <th
              class="text-[12px] font-semibold"
              v-for="(d, i) in finalresult[0].scores"
            >
              {{ d.judge_name }}
            </th>

            <th class="text-[12px] font-semibold w-[5%]">Total</th>
            <th class="text-[12px] font-semibold w-[5%]">Rank</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <tr v-for="(data, index) in finalresult">
            <td class="text-[12px] font-semibold uppercase text-left">
              {{ data.contestant }}
            </td>
            <td class="text-[14px] font-semibold" v-for="(d, i) in data.scores">
              {{ d.total }}
            </td>
            <td class="text-[14px] font-semibold">
              {{ data.grand_total.toFixed(2) }}
            </td>
            <td class="text-[16px] text-gray-700 font-bold">{{ data.rank }}</td>
          </tr>
        </tbody>
      </table>

      <div class="display-on-print">
        <div
          class="grid grid-cols-3 gap-12 place-content-center h-48 mt-12"
          v-if="finalresult[0]"
        >
          <div v-for="(d, i) in finalresult[0].scores" class="text-center">
            <p
              class="font-semibold underline"
              style="text-underline-offset: 6px"
            >
              {{ d.judge_name }}
            </p>
            <p>{{ d.judge_position }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
@media print {
  .table {
    margin-left: -16px !important;
  }
}
</style>
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

const PrintElem = () => {
  setTimeout(function () {
    window.print();
  }, 500);
  return false;
};
</script>
