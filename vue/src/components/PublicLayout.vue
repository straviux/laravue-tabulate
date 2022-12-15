<template>
  <div v-if="route.name === 'ShowTabulate'">
    <Loader v-if="contestsLoading" :is-full-screen="true" />
    <div v-else class="mt-5 md:col-span-2 md:mt-0 w-full md:w-[500px] mx-auto">
      <h1 class="mt-12 text-3xl uppercase font-semibold text-gray-600">
        Tabulating System
      </h1>
      <div class="mt-8 shadow sm:overflow-hidden sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
          <div class="flex justify-between">
            <h1 class="text-xl uppercase mb-2">Generate Scoresheet</h1>
            <!-- <router-link
                :to="{ name: 'Contest' }"
                class="underline text-blue-800"
                >Cancel</router-link
              > -->
          </div>
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Event</label
              >
              <select
                class="select select-bordered w-full mt-3"
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
          </div>
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Contest</label
              >
              <select
                class="select select-bordered w-full mt-3"
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

          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Judge</label
              >
              <select
                class="select select-bordered w-full mt-3"
                v-model="model.judge_id"
              >
                <option
                  v-for="({ id, judge_name }, index) in model.contest.judges"
                  :key="index"
                  :value="id"
                  required
                  class="text-lg"
                >
                  {{ judge_name }}
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
          <button
            @click="getScoreSheet()"
            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            Generate
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="max-w-5xl mx-auto py-12">
    <router-view></router-view>
  </div>
  <Notification class="z-30" />
</template>
<script setup>
import { ref, watch, computed } from "vue";
import { useRouter, useRoute } from "vue-router";
import { v4 as uuidv4 } from "uuid";
import store from "../store";
import Loader from "./Loader.vue";
import Notification from "./Notification.vue";

const model = ref({
  uuid: "",
  event_id: "",
  judge_id: "",
  contest: {},
});

const router = useRouter();
const route = useRoute();
const events = computed(() => store.state.events.data);
const contestsLoading = computed(() => store.state.contests.loading);
const contests = computed(() => store.state.contests.data);
// const judges = ref({});

store.dispatch("getEvents");

watch(
  () => model.value.event_id,
  (newVal, oldVal) => {
    store.dispatch("getContestsByEvent", model.value.event_id);
  }
);

const getScoreSheet = () => {
  model.value.uuid = uuidv4();
  console.log(model.value);
  router.push({
    name: "PublicScoresheetForm",
    params: {
      contest_id: model.value.contest.id,
      judge_id: model.value.judge_id,
    },
  });
};
</script>
<style scoped></style>
