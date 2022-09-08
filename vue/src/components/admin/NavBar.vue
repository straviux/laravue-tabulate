<template>
  <div class="relative lg:block lg:space-y-10 p-2 grid grid-cols-12 h-full">
    <div class="col-span-6 lg:col-span-12 flex justify-left items-center gap-4">
      <div
        class="bg-gradient-to-tl from-green-400 to-blue-500 rounded-xl p-2 text-white"
      >
        <mdicon
          name="checkbox-marked-circle-plus-outline"
          class="text-current"
        />
      </div>
      <strong>JPM Palawan</strong>
    </div>

    <div class="lg:hidden col-span-6 flex justify-end items-center">
      <button class="bg-stone-300 p-2 rounded-lg">
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

    <div class="col-span-12 p-10">
      <nav-bar-menu />
    </div>
    <div class="absolute bottom-0 left-0"></div>
  </div>
</template>
<script setup>
import NavBarMenu from "./NavBarMenu.vue";
</script>
