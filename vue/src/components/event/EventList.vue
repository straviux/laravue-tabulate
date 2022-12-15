<template>
  <!-- <div
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
  </div> -->
  <div class="overflow-x-auto w-full shadow rounded-lg">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>#</th>
          <th>Event</th>
          <th>Description</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        <tr v-for="(item, index) in events" :key="index">
          <th class="text-[11px] text-gray-600">
            {{ index + 1 }}
          </th>
          <td>
            <span class="text-sm font-bold">{{ item.event_name }}</span>
          </td>
          <td>
            <span class="text-sm font-bold">{{ item.event_description }}</span>
          </td>
          <td>
            <span class="text-[12px]">{{ item.event_date }}</span>
          </td>
          <th>
            <button class="btn btn-ghost btn-xs">
              <router-link
                :to="{ name: 'EventView', params: { id: item.id } }"
                class="text-[11px] text-orange-700 font-bold underline capitalize"
                >Edit</router-link
              >
            </button>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script setup>
import store from "../../store";
import { computed } from "vue";

const events = computed(() => store.state.events.data);

store.dispatch("getEvents");

function deleteEvent(event) {
  if (
    confirm(
      `Are you sure you want to delete this survey? Operation can't be undone!!`
    )
  ) {
    store.dispatch("deleteEvent", event.id).then(() => {
      store.dispatch("getevents");
    });
  }
}

function getForPage(ev, link) {
  ev.preventDefault();
  if (!link.url || link.active) {
    return;
  }

  store.dispatch("getEvents", { url: link.url });
}
</script>
