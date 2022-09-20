<template>
  <input type="checkbox" id="judges-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative" v-if="contest">
      <label
        for="judges-modal"
        class="btn btn-sm btn-circle absolute right-2 top-2"
        >✕</label
      >
      <h2 class="pb-4 text-2xl underline uppercase">
        {{ contest.contest_name }}
      </h2>
      <div class="text-sm breadcrumbs">
        <ul>
          <li>
            <a>{{ contest.event.event_name }}</a>
          </li>
          <li>
            <a>{{ contest.contest_name }}</a>
          </li>
          <li><a>Judges</a></li>
        </ul>
      </div>
      <div class="py-4 flex flex-col justify-center items-center">
        <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>#</th>
              <th class="text-[12px]">Judge</th>
              <th class="text-[12px]">Position</th>
              <th class="text-[12px]">Order</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(judge, index) in model.judges" :key="judge.id">
              <JudgeEditor
                :__data="judge"
                :index="index"
                @change="judgeChange"
                @addItem="addJudge()"
                @removeItem="deleteJudge"
              />
            </tr>
          </tbody>
        </table>
        <div v-if="!model.judges.length" class="text-center text-gray-600">
          You don't have any judges created
        </div>
      </div>
      <div class="py-4 flex justify-center gap-10 items-center">
        <button
          @click="addJudge()"
          class="btn btn-sm gap-1 lg:btn-wide w-[150px] uppercase shadow mt-4 rounded btn-primary"
        >
          <mdicon name="plus" />Add Judge
        </button>
        <button
          @click="saveJudges()"
          class="btn btn-sm lg:btn-wide w-[150px] gap-1 uppercase shadow mt-4 rounded btn-success"
        >
          <mdicon name="content-save" />Save
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import store from "../../store";
import { v4 as uuidv4 } from "uuid";
import { ref } from "vue";
import JudgeEditor from "./JudgeEditor.vue";

const props = defineProps({
  contest: Object,
});

// Create empty survey
let model = ref({
  judges: [],
});

function addJudge(index) {
  const newJudge = {
    id: uuidv4(),
    order: index,
    position: "",
  };

  model.value.judges.push(newJudge);
}

function judgeChange(judge) {
  model.value.judges = model.value.judges.map((q) => {
    if (q.id === judge.id) {
      return JSON.parse(JSON.stringify(judge));
    }
    return q;
  });
}

function deleteJudge(judge) {
  model.value.judges = model.value.judges.filter((q) => q !== judge);
}

function saveJudges() {
  const judges = { ...model.value };
  console.log(judges);
}
</script>
