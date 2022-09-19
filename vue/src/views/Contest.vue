<template>
  <div class="flex flex-col gap-10 p-7">
    <ContestMenu />
    <ContestList />
  </div>
</template>
<script setup>
import store from "../store";
import { computed } from "vue";
import ContestList from "../components/contest/ContestList.vue";
import ContestMenu from "../components/contest/ContestMenu.vue";

const events = computed(() => store.state.events);

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
