<template>
  <div class="grid grid-cols-12 gap-2 h-screen">
    <div
      class="col-span-12 lg:col-span-10 bg-stone-50 rounded-r-[37px] flex flex-col gap-2 lg:flex-row md:divide-x-2"
    >
      <div class="lg:w-[250px] w-full lg:h-full">
        <nav-bar />
      </div>

      <main-content class="flex-1" />
    </div>

    <div class="hidden xl:col-span-2 xl:block">
      <side-bar-right class="p-10" />
    </div>
  </div>
</template>
<script setup>
import NavBar from "./NavBar.vue";
import MainContent from "./MainContent.vue";
import SideBarRight from "./SideBarRight.vue";
</script>
