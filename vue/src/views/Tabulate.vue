<template>
  <div class="flex flex-col gap-10 p-7">
    <Tabulate />
  </div>
</template>
<script setup>
import store from "../store";
import { computed } from "vue";
import Tabulate from "../components/tabulate/Tabulate.vue";
import axiosClient from "../axios";

// const getContestByEvent = () => {
//   return axiosClient.get("/contest-by-event?event_id=1").then((res) => {
//     console.log(res);
//     return res;
//   });
// };

// getContestByEvent();
</script>
