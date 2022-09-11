<template>
  <div class="flex flex-col md:flex-row items-center md:items-stretch gap-7">
    <project
      v-for="(project, index) in projects"
      :key="index"
      class="w-full md:w-1/3 rounded-xl p-4"
      :project="project"
    />
    <!-- <div class="w-full bg-red-100 rounded-xl p-4">project</div>
    <div class="w-full bg-red-100 rounded-xl p-4">project</div>
    <div class="w-full bg-red-100 rounded-xl p-4">project</div> -->
  </div>
</template>
<script setup>
import Project from "./Project.vue";
const projects = [
  {
    name: "News",
    tasks: 10,
    percentage: 96,
    people: 2,
    color: "color_1",
  },
  {
    name: "Articles",
    tasks: 7,
    percentage: 90,
    people: 2,
    color: "color_2",
  },

  {
    name: "Gallery",
    tasks: 8,
    percentage: 92,
    people: 2,
    color: "color_3",
  },
];
</script>
