<template>
  <ul>
    <li
      class="p-3 flex justify-start items-center gap-3 cursor-pointer text-gray-500"
      v-for="({ text, icon }, index) in items"
      :key="index"
      :class="{
        'font-bold text-gray-600 drop-shadow-md': active === index,
      }"
      @click="setActive(index)"
    >
      <mdicon :name="icon" class="text-current" /><span>{{ text }}</span>
    </li>
  </ul>
</template>
<script setup>
import { ref } from "vue";

const active = ref(0);

const setActive = (index) => (active.value = index);

const items = [
  { text: "Dashboard", icon: "view-dashboard" },
  { text: "Profile", icon: "account-outline" },
  { text: "News", icon: "newspaper-variant" },
  { text: "Articles", icon: "post-outline" },
  { text: "Gallery", icon: "camera-iris" },
];
</script>
