<template>
  <input type="checkbox" id="contestants-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-11/12 max-w-3xl relative" v-if="contest">
      <label
        for="contestants-modal"
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
          <li><a>Contestants</a></li>
        </ul>
      </div>
      <div class="py-4 flex flex-col justify-center items-center">
        <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>#</th>
              <th class="text-[12px]">Contestant</th>
              <th class="text-[12px]">Order</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(contestant, index) in model.contestants"
              :key="contestant.id"
            >
              <ContestantEditor
                :__data="contestant"
                :index="index"
                @change="dataChange"
                @addItem="addItem()"
                @removeItem="removeItem"
              />
            </tr>
          </tbody>
        </table>
        <div v-if="!model.contestants.length" class="text-center text-gray-600">
          You don't have any contestants created
        </div>
      </div>
      <div class="py-4 flex justify-center gap-10 items-center">
        <button
          @click="addItem()"
          class="btn btn-sm gap-1 lg:btn-wide w-[150px] uppercase shadow mt-4 rounded btn-primary"
        >
          <mdicon name="plus" />Add Contestant
        </button>
        <button
          @click="saveItem()"
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
import ContestantEditor from "./ContestantEditor.vue";

const props = defineProps({
  contest: Object,
});

// Create empty survey
let model = ref({
  contestants: [],
});

function addItem(index) {
  const newItem = {
    id: uuidv4(),
    order: index,
  };

  model.value.contestants.push(newItem);
}

function dataChange(contestant) {
  model.value.contestants = model.value.contestants.map((q) => {
    if (q.id === contestant.id) {
      return JSON.parse(JSON.stringify(contestant));
    }
    return q;
  });
}

function removeItem(item) {
  model.value.contestants = model.value.contestants.filter((q) => q !== item);
}

function saveItem() {
  const items = { ...model.value };
  console.log(items);
}
</script>
