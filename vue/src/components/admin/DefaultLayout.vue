<template>
  <div class="bg-gray-100">
    <div class="grid grid-cols-12 gap-2 h-screen overflow-hidden">
      <div
        class="col-span-12 lg:col-span-9 rounded-r-[37px] bg-white flex gap-2 flex-col lg:flex-none md_divide-x-2"
      >
        <div class="lg:w-[250px] w-full lg:h-full overflow-hidden">
          <nav-bar />
        </div>
        <div class="flex-1"><main-content /></div>
      </div>
      <section class="col-span-3 bg-white">
        <div><Calendar /></div>
      </section>
    </div>
  </div>
</template>
<script setup>
import NavBar from "./NavBar.vue";
import MainContent from "./MainContent.vue";
import Calendar from "./Calendar.vue";
</script>
