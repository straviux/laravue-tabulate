<template>
  <ul>
    <!-- <router-link
      :to="'news'"
      class="text-base font-medium text-gray-800 hover:text-gray-900"
      >News</router-link
    > -->
    <li class="" v-for="({ text, icon, to }, index) in items" :key="index">
      <router-link
        :to="to"
        class="p-3 flex justify-start items-center gap-2"
        active-class="font-bold text-gray-600 drop-shadow-md"
        :class="[this.$route.name === to.name ? '' : 'text-gray-500']"
      >
        <mdicon :name="icon" class="text-current" /><span>{{ text }}</span>
      </router-link>
    </li>
  </ul>
</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
// import { router } from "vue-router";
const router = useRouter();
const active = ref(0);

const setActive = (to) => {
  active.value = to;
  // this.$route.push({ name: to });
};

const items = [
  { text: "Dashboard", icon: "view-dashboard", to: { name: "Dashboard" } },
  { text: "Profile", icon: "account-outline", to: { name: "Profile" } },
  { text: "News", icon: "newspaper-variant", to: { name: "News" } },
  { text: "Articles", icon: "post-outline", to: { name: "Articles" } },
  { text: "Gallery", icon: "camera-iris", to: { name: "Gallery" } },
];
</script>
