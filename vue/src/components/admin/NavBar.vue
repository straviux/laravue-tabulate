<template>
  <div class="relative lg:block lg:space-y-10 p-2 grid grid-cols-12 lg:h-full">
    <!-- <div class="col-span-6 lg:col-span-12 flex justify-left items-center gap-4">
      <div
        class="bg-gradient-to-tl from-green-400 to-blue-500 rounded-xl p-2 text-white"
      >
        <mdicon
          name="checkbox-marked-circle-plus-outline"
          class="text-current"
        />
      </div>
      <strong>JPM Palawan</strong>
    </div> -->

    <div class="lg:hidden col-span-12 flex justify-end items-center">
      <button class="bg-stone-100 p-2 rounded-lg" @click="toggleMenu">
        <mdicon name="menu" />
      </button>
    </div>

    <div class="col-span-12 hidden lg:block">
      <div class="relative w-full h-24 flex flex-col items-center gap-4">
        <img
          src="https://placeimg.com/200/200/animals"
          alt="Profile"
          class="w-24 h-24 rounded-full"
        />
        <p
          class="absolute bg-white left-1/2 transform -translate-x-1/2 text-xs px-2 -bottom-2 text-orange-500 flex items-center gap-1 rounded-full"
        >
          <mdicon name="clock" width="15px" />
          <span class="font-bold">10h</span>
        </p>
      </div>
      <div class="text-center mt-7">
        <h1 class="font-bold text-black">Arcee Herdz</h1>
        <a href="#" class="text-gray-500">arcee.herdz@gmail.om</a>
      </div>
    </div>

    <div class="col-span-12 p-10" v-if="menuIsActive">
      <nav-bar-menu />
    </div>
    <div class="hidden lg:block absolute bottom-0">
      <img src="../../assets/img/jpm_logo.gif" alt="logo" class="mb-4" />
    </div>
  </div>
</template>
<script setup>
import NavBarMenu from "./NavBarMenu.vue";
import { ref } from "vue";
const MOBILE_BREAKPOINT = 1024; // tailwind: lg

const width = ref(document.body.offsetWidth);
const menuIsActive = ref(width.value > MOBILE_BREAKPOINT);
const toggleMenu = () => (menuIsActive.value = !menuIsActive.value);
window.addEventListener("resize", function () {
  width.value = document.body.offsetWidth;
  menuIsActive.value = width.value > MOBILE_BREAKPOINT;
});
</script>
