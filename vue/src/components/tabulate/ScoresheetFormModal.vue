<template>
  <input type="checkbox" id="scoresheet-modal" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box w-[550px] max-w-3xl relative">
      <label
        for="scoresheet-modal"
        class="btn btn-sm btn-circle absolute right-2 top-2"
        >✕</label
      >
      <h2 class="pb-4 text-2xl underline uppercase">Arvin Heredero</h2>
      <!-- <div class="flex gap-5 items-center justify-between w-[140px]">
        <label for="" class="text-xl uppercase">Criteria</label>
        <input
          type="text"
          class="mt-1 input input-bordered rounded-sm input-sm max-w-[100px] shadow-sm sm:text-sm focus:outline-none px-2 py-1"
        />
      </div> -->
      <table class="table table-compact w-full">
        <tr>
          <td class="text-right w-2/3">
            <label for="" class="uppercase mr-8 font-semibold"
              >AUDIENCE IMPACT</label
            >
          </td>
          <td>
            <input
              type="text"
              class="mt-1 input input-bordered text-2xl input-sm text-center rounded-sm w-[75px] h-[40px] focus:outline-none"
            />
          </td>
        </tr>
        <tr>
          <td class="text-right w-2/3">
            <label for="" class="uppercase mr-8 font-semibold"
              >Musicality</label
            >
          </td>
          <td>
            <input
              type="text"
              class="mt-1 input input-bordered text-2xl input-sm text-center rounded-sm w-[75px] h-[40px] focus:outline-none"
            />
          </td>
        </tr>
      </table>
      <div class="modal-action flex items-center justify-between mt-12">
        <div class="space-x-3 flex items-center">
          <button
            class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
          >
            <mdicon name="arrow-left" width="16" />Previous
          </button>
          <button
            class="btn rounded btn-outline btn-sm gap-2 text-[12px] w-[106px]"
          >
            Next<mdicon name="arrow-right" width="16" />
          </button>
        </div>
        <div class="flex items-center">
          <button
            class="btn btn-sm bg-green-600 text-white w-[120px] gap-2 outline-none border-none rounded text-[12px] shadow"
          >
            Save <mdicon name="content-save-outline" width="20" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup></script>
