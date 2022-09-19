<template>
  <div
    class="flex p-2 my-4 bg-white rounded-lg shadow space-x-4 items-center justify-between"
  >
    <div class="flex gap-3 items-center">
      <span>Filter: </span>
      <div class="form-control">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Active</span>
          <input
            type="radio"
            name="active"
            class="radio radio-sm radio-primary"
            value="active"
            checked
          />
        </label>
      </div>
      <div class="form-control">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Inactive</span>
          <input
            type="radio"
            name="active"
            value="inactive"
            class="radio radio-sm radio-primary"
          />
        </label>
      </div>
      <div class="form-control">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Draft</span>
          <input
            type="radio"
            name="active"
            value="draft"
            class="radio radio-sm radio-primary"
          />
        </label>
      </div>
      <div class="form-control ml-2 pl-2 border-l border-gray-300">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Featured</span>
          <input
            type="checkbox"
            class="checkbox checkbox-sm checkbox-primary"
            value="featured"
          />
        </label>
      </div>
    </div>
    <div>
      <form method="GET">
        <div class="relative text-gray-600 focus-within:text-gray-400">
          <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            <button
              type="submit"
              class="p-1 focus:outline-none focus:shadow-outline"
            >
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="w-6 h-6"
              >
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </span>
          <input
            type="search"
            name="q"
            class="w-[300px] py-2 text-sm text-white bg-gray-100 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
            placeholder="Search for something"
            autocomplete="off"
          />
        </div>
      </form>
    </div>
  </div>
  <div class="overflow-x-auto w-full shadow rounded-lg">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>
            <label>
              <input type="checkbox" class="checkbox" />
            </label>
          </th>
          <th>Event</th>
          <th>Contest</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        <tr v-for="(item, index) in contests" :key="index">
          <th>
            <label>
              <input type="checkbox" class="checkbox" />
            </label>
          </th>
          <td>
            <span class="text-sm font-bold">{{ item.event.event_name }}</span>
          </td>
          <td>
            <span class="text-sm font-bold">{{ item.name }}</span>
          </td>

          <td>
            <span class="text-[12px]">{{ item.contest_date }}</span>
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
              class="btn btn-ghost btn-xs text-[12px] text-cyan-700 font-bold underline capitalize"
              >Criterias</label
            >

            <label
              for="judges-modal"
              class="btn btn-ghost btn-xs text-[12px] text-green-500 font-bold underline capitalize"
              >Judges</label
            >

            <label
              for="contestants-modal"
              class="btn btn-ghost btn-xs text-[12px] text-violet-700 font-bold underline capitalize"
              >Contestants</label
            >
          </th>
        </tr>
      </tbody>
      <!-- foot -->
      <tfoot>
        <tr>
          <th>
            <label>
              <input type="checkbox" class="checkbox" />
            </label>
          </th>
          <th>Event</th>
          <th>Contest</th>
          <th>Date</th>
          <th></th>
        </tr>
      </tfoot>
    </table>

    <!-- CRITERIAS MODAL -->
    <input type="checkbox" id="criterias-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box w-11/12 max-w-3xl relative">
        <label
          for="criterias-modal"
          class="btn btn-sm btn-circle absolute right-2 top-2"
          >✕</label
        >
        <h3 class="text-lg font-bold">Criterias</h3>
        <p class="py-4 flex flex-col justify-center items-center">
          <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>
              #
              </th>
              <th class="text-[12px]">Criteria</th>
              <th class="text-[12px]">Percentage</th>
              <th>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="font-bold">1</td>
              <td class="font-bold">Audience Impact</td>
              <td class="font-bold">10%</td>
              <td>
                <button class="btn btn-ghost btn-xs text-[12px] text-orange-500 font-bold underline capitalize">
                  edit
                </button>
                <button class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize">
                  delete
                </button>
              </td>
            </tr>
          </tbody>
          </table>
          <button
            class="btn btn-xs uppercase shadow mt-4 rounded btn-primary"
          >
            <mdicon name="plus" />&nbsp;Add Criteria
          </button>
        </p>
      </div>
    </div>

    <!-- JUDGES MODAL -->
    <input type="checkbox" id="judges-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box w-11/12 max-w-3xl relative">
        <label
          for="judges-modal"
          class="btn btn-sm btn-circle absolute right-2 top-2"
          >✕</label
        >
        <h3 class="text-lg font-bold">Judges</h3>
        <p class="py-4 flex flex-col justify-center items-center">
          <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>
              #
              </th>
              <th class="text-[12px]">Name</th>
              <th class="text-[12px]">Position</th>
              <th>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="font-bold">1</td>
              <td class="font-bold">Arcee Herdz</td>
              <td class="font-bold">member</td>
              <td>
                <button class="btn btn-ghost btn-xs text-[12px] text-orange-500 font-bold underline capitalize">
                  edit
                </button>
                <button class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize">
                  delete
                </button>
              </td>
            </tr>
          </tbody>
          </table>
          <button
            class="btn btn-xs uppercase shadow mt-4 rounded btn-primary"
          >
            <mdicon name="plus" />&nbsp;Add Judge
          </button>
        </p>
      </div>
    </div>

    <!-- CONTESTANTS MODAL -->
    <input type="checkbox" id="contestants-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box w-11/12 max-w-3xl relative">
        <label
          for="contestants-modal"
          class="btn btn-sm btn-circle absolute right-2 top-2"
          >✕</label
        >
        <h3 class="text-lg font-bold">Contestants</h3>
        <p class="py-4 flex flex-col justify-center items-center">
          <table class="table table-compact w-full">
          <!-- head -->
          <thead>
            <tr>
              <th>
              #
              </th>
              <th class="text-[12px]">Name</th>
              <th class="text-[12px]">Order</th>
              <th>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="font-bold">1</td>
              <td class="font-bold">Arcee Herdz</td>
              <td class="font-bold">1</td>
              <td>
                <button class="btn btn-ghost btn-xs text-[12px] text-orange-500 font-bold underline capitalize">
                  edit
                </button>
                <button class="btn btn-ghost btn-xs text-[12px] text-red-500 font-bold underline capitalize">
                  delete
                </button>
              </td>
            </tr>
          </tbody>
          </table>
          <button
            class="btn btn-xs uppercase shadow mt-4 rounded btn-primary"
          >
            <mdicon name="plus" />&nbsp;Add Contestant
          </button>
        </p>
      </div>
    </div>
  </div>
</template>
<script setup>
import store from "../../store";
import { computed } from "vue";

const contests = computed(() => store.state.contests.data);

store.dispatch("getContests");

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
