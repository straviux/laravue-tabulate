<template>
  <div class="space-y-5">
    <div class="flex justify-between items-center">
      <h3 class="text-xl font-bold">Updates</h3>
      <button class="relative p-2 bg-white">
        <mdicon name="bell" />
        <span
          class="absolute bg-red-400 h-2 w-2 rounded-full top-2 right-2"
        ></span>
      </button>
    </div>

    <!-- <div class="space-y-7">
      <div class="flex justify-between">
        <h5 class="font-bold text-gray-600">Ranking</h5>
        <mdicon name="dots-vertical" />
      </div>

      <div
        v-for="j in 4"
        :key="j"
        class="flex justify-content-between items-center gap-4"
      >
        <p class="w-28 text">Contestant #{{ j * 3 }}</p>
        <div
          class="w-1 rounded-xl h-10"
          :class="`bg-color_${(j % 3) + 1}`"
        ></div>
        <div class="flex-1">
          <p class="font-bold text-gray-800 text-lg">Score</p>
          <p class="text-gray-500">{{ j * 5 }}</p>
        </div>
      </div>
    </div> -->
  </div>
</template>
