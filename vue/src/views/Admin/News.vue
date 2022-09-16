<template>
  <div class="flex flex-col gap-10 p-7">
    <!-- <p>hello world</p> -->
    <!-- <hello-bar /> -->
    <news-menu />
    <!-- <div class="-mt-4">
      <NewsTab :current="currentTab" />
    </div> -->
    <router-view></router-view>
  </div>
</template>
<script setup>
import { ref } from "vue";
import NewsMenu from "../../components/admin/news/NewsMenu.vue";
import NewsTab from "../../components/admin/news/NewsTab.vue";
// import TabsWrapper from "../../components/Tabs/TabsWrapper.vue";
// import Tab from "../../components/Tabs/Tab.vue";
// const currentTab = ref("all");
// const getName = (value) => {
//   currentTab.value = value;
// };
</script>
