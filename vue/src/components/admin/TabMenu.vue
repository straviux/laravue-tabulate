<template>
  <div class="navbar bg-base-100">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost lg:hidden">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h8m-8 6h16"
            />
          </svg>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 bg-base-100 w-52"
          role="tablist"
          id="tabs-tab"
        >
          <li class="nav-item hover:bg-white" role="presentation">
            <a
              v-for="({ name, target }, index) in tabMenu"
              :key="index"
              :href="target"
              class="border-x-0 hover:bg-white focus:bg-white border-t-0 uppercase"
              :class="[index === activeTab ? 'border-b-2 border-color_1' : '']"
              :id="`tabs-${name}-tab`"
              data-bs-toggle="pill"
              :data-bs-target="`${target}`"
              role="tab"
              :aria-controls="`tabs-${name}`"
              aria-selected="true"
              @click="setActive(index)"
              >{{ name }}</a
            >
          </li>
        </ul>
        <!-- <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
          role="tablist"
          id="tabs-tab"
        >
          <li class="nav-item" role="presentation">
            <a
              href="#tabs-all"
              class="nav-link hover:border-transparent hover:bg-gray-100 focus:border-transparent active border-x-0 border-t-0 border-b-2 border-transparent"
              id="tabs-all-tab"
              data-bs-toggle="pill"
              data-bs-target="#tabs-all"
              role="tab"
              aria-controls="tabs-all"
              aria-selected="true"
              >All</a
            >
          </li>
          <li class="nav-item" role="presentation">
            <a
              href="#tabs-featured"
              class="nav-link block font-medium text-xs leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent"
              id="tabs-featured-tab"
              data-bs-toggle="pill"
              data-bs-target="#tabs-featured"
              role="tab"
              aria-controls="tabs-featured"
              aria-selected="false"
              >Featured</a
            >
          </li>
          <li class="nav-item" role="presentation">
            <a
              href="#tabs-drafts"
              id="tabs-drafts-tab"
              data-bs-toggle="pill"
              data-bs-target="#tabs-drafts"
              role="tab"
              aria-controls="tabs-drafts"
              aria-selected="true"
              >Drafts</a
            >
          </li>
        </ul> -->
      </div>
      <a class="btn btn-ghost normal-case text-xl">News Maintenance</a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul
        tabindex="0"
        class="menu menu-compact menu-horizontal"
        role="tablist"
        id="tabs-tab"
      >
        <li class="nav-item hover:bg-white" role="presentation">
          <a
            v-for="({ name, target }, index) in tabMenu"
            :key="index"
            :href="target"
            class="border-x-0 hover:bg-white focus:bg-white border-t-0 uppercase"
            :class="[index === activeTab ? 'border-b-2 border-color_1' : '']"
            @click="setActive(index)"
            >{{ name }}</a
          >
        </li>
      </ul>
    </div>
    <div class="navbar-end">
      <a class="btn btn-sm gap-2 btn-primary text-white shadow-lg"
        ><mdicon name="newspaper-plus" /> Add news</a
      >
    </div>
  </div>
</template>
<script setup>
import { ref } from "vue";
const activeTab = ref(0);
// const activeTab=
const setActive = (index) => (activeTab.value = index);
// const props = defineProps({
//   menu: Array,
//   title: String,
// });

const tabMenu = [
  {
    name: "all",
    target: "#all",
  },
  {
    name: "featured",
    target: "#featured",
  },
  {
    name: "drafts",
    target: "#drafts",
  },
];
</script>
