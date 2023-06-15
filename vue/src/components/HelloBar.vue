<template>
  <div
    class="flex flex-col md:flex-row gap-10 justify-between items-center no-print"
  >
    <div>
      <h1 class="font-extrabold text-4xl text-blueGray-700">
        Tabulating System
      </h1>
      <p>{{ getDateTime() }}</p>
    </div>
    <div class="flex justify-between gap-2 items-center">
      <button class="bg-gray-200 p-2 rounded-lg text-blueGray-500">
        <mdicon name="magnify" />
      </button>
      <!-- <button
        class="bg-sky-800 py-2 px-4 text-gray-100 rounded-lg hover:shadow-2xl cursor-pointer"
      >
        Add Post
      </button> -->
      <div class="flex justify-center items-center">
        <button
          @click="logout"
          class="text-sm px-2 text-red-500 underline rounded-full flex gap-1"
        >
          <mdicon name="logout-variant" width="15px" />
          <span class="font-bold">Log out</span>
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
import store from "../store";
import { useRouter } from "vue-router";

const router = useRouter();
const logout = () => {
  store.dispatch("logout").then(() => {
    router.push({
      name: "Login",
    });
  });
};

const getDateTime = () => {
  const current = new Date();
  const date =
    current.getFullYear() +
    "-" +
    (current.getMonth() + 1) +
    "-" +
    current.getDate();
  const time =
    current.getHours() +
    ":" +
    current.getMinutes() +
    ":" +
    current.getSeconds();
  const dateTime = date + " " + time;

  return dateTime;
};
</script>
