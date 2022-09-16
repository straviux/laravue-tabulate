<template>
  <div class="flex flex-col gap-10 p-7">
    <!-- <hello-bar /> -->
    <current-projects />
    <div class="grid grid-cols-12 grid-rows-2 gap-10">
      <task-for-today class="row-span-2 col-span-12 md:col-span-6" />

      <statistics class="row-span-1 col-span-12 md:col-span-6" />

      <pro-plan class="row-span-1 col-span-12 md:col-span-6" />
    </div>
  </div>
</template>
<script setup>
import HelloBar from "../../components/admin/HelloBar.vue";
import CurrentProjects from "../../components/admin/dashboard/CurrentProjects.vue";
import TaskForToday from "../../components/admin/dashboard/TaskForToday.vue";
import Statistics from "../../components/admin/dashboard/Statistics.vue";
import ProPlan from "../../components/admin/dashboard/ProPlan.vue";
</script>
