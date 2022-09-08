<template>
  <div class="grid grid-cols-12 gap-2 h-screen overflow-hidden bg-gray-100">
    <div
      class="col-span-12 lg:col-span-9 rounded-r-[37px] bg-white flex gap-2 lg:flex-1 md:divide-x-2"
    >
      <div class="lg:w-[250px] w-full lg:h-full overflow-hidden">
        <nav-bar />
      </div>
      <main-content class="flex-1 bg-red-200" />
    </div>
    <section class="col-span-3 bg-white">
      <div></div>
    </section>
  </div>
</template>
<script setup>
import NavBar from "./NavBar.vue";
import MainContent from "./MainContent.vue";
// import Calendar from "./Calendar.vue";
</script>
