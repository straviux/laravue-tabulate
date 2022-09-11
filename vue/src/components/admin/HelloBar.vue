<template>
  <div class="flex flex-col md:flex-row gap-10 justify-between items-center">
    <div>
      <h1 class="font-extrabold text-4xl text-blueGray-700">Hello, Arcee</h1>
      <p>Today is Friday, September 09, 2020</p>
    </div>
    <div class="flex justify-between gap-2 items-center">
      <button class="bg-gray-200 p-2 rounded-lg text-blueGray-500">
        <mdicon name="magnify" />
      </button>
      <button
        class="bg-sky-800 py-2 px-4 text-gray-100 rounded-lg hover:shadow-2xl cursor-pointer"
      >
        Add Post
      </button>
    </div>
  </div>
</template>
<script setup></script>
