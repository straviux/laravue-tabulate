<template>
  <div class="space-y-7 w-full">
    <h1 class="text-3xl">Task for Today</h1>
    <div class="flex flex-col space-y-4">
      <task v-for="(task, index) in tasks" :key="index" :task="task" />
    </div>
  </div>
</template>
<script setup>
import Task from "./Task.vue";
const tasks = [
  {
    name: "Mobile App",
    description: "Prepare Figma File",
    color: "color_1",
    active: true,
  },
  {
    name: "UX Wireframs",
    description: "Design UX Wireframes",
    color: "color_2",
    active: false,
  },
  {
    name: "Mobile App",
    description: "Research",
    color: "color_3",
    active: false,
  },
];
</script>
