<template>
  <div class="flex flex-col gap-10 p-7">
    <hello-bar class="no-print"></hello-bar>
    <router-view></router-view>
  </div>
</template>
<script setup>
import HelloBar from "./HelloBar.vue";
</script>
