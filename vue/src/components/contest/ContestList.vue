<template>
  <div class="overflow-x-auto w-full shadow rounded-lg">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>#</th>
          <th>Event</th>
          <th>Contest</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        <tr v-for="(item, index) in contests" :key="index">
          <th class="text-[11px] text-gray-600">
            {{ index + 1 }}
          </th>
          <td>
            <span class="text-sm font-bold">{{ item.event.event_name }}</span>
          </td>
          <td>
            <span class="text-sm font-bold">{{ item.contest_name }}</span>
          </td>

          <td>
            <span class="text-[12px]">{{
              $filters.moment(item.contest_date, "ll")
            }}</span>
          </td>
          <th>
            <button class="btn btn-ghost btn-xs">
              <router-link
                :to="{ name: 'ContestView', params: { id: item.id } }"
                class="text-[12px] text-orange-700 font-bold underline capitalize"
                >Edit</router-link
              >
            </button>

            <label
              for="criterias-modal"
              @click="contest = item"
              class="btn btn-ghost btn-xs text-[12px] text-cyan-700 font-bold underline capitalize"
              >Criterias</label
            >

            <label
              for="judges-modal"
              @click="contest = item"
              class="btn btn-ghost btn-xs text-[12px] text-green-500 font-bold underline capitalize"
              >Judges</label
            >

            <label
              for="contestants-modal"
              @click="contest = item"
              class="btn btn-ghost btn-xs text-[12px] text-violet-700 font-bold underline capitalize"
              >Contestants</label
            >
          </th>
        </tr>
      </tbody>
    </table>

    <!-- CRITERIAS MODAL -->
    <CriteriasModal :contest="contest" />

    <!-- JUDGES MODAL -->
    <JudgesModal :contest="contest" />

    <!-- CONTESTANTS MODAL -->
    <ContestantModal :contest="contest" />
  </div>
</template>
<script setup>
import store from "../../store";
import { ref, computed, watch } from "vue";
import CriteriasModal from "./CriteriasModal.vue";
import JudgesModal from "./JudgesModal.vue";
import ContestantModal from "./ContestantModal.vue";

const contests = computed(() => store.state.contests.data);
// const contests = computed(() => store.state.contests.data);
const contest = ref();
store.dispatch("getContests");

watch(
  () => contest,
  (newVal, oldVal) => {
    contest.value = newVal;
  }
);

function deleteContest(contest) {
  if (
    confirm(
      `Are you sure you want to delete this survey? Operation can't be undone!!`
    )
  ) {
    store.dispatch("deleteContest", contest.id).then(() => {
      store.dispatch("getcontests");
    });
  }
}

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  store.dispatch("getContests", { url: link.url });
}
</script>
