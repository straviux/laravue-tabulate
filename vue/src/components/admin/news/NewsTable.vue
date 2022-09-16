<template>
  <div
    class="flex p-2 my-4 bg-white rounded-lg shadow space-x-4 items-center justify-between"
  >
    <div class="flex gap-3 items-center">
      <span>Filter: </span>
      <div class="form-control">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Active</span>
          <input
            type="radio"
            name="active"
            class="radio radio-sm radio-primary"
            value="active"
            checked
          />
        </label>
      </div>
      <div class="form-control">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Inactive</span>
          <input
            type="radio"
            name="active"
            value="inactive"
            class="radio radio-sm radio-primary"
          />
        </label>
      </div>
      <div class="form-control">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Draft</span>
          <input
            type="radio"
            name="active"
            value="draft"
            class="radio radio-sm radio-primary"
          />
        </label>
      </div>
      <div class="form-control ml-2 pl-2 border-l border-gray-300">
        <label class="label cursor-pointer space-x-1">
          <span class="label-text text-xs">Featured</span>
          <input
            type="checkbox"
            class="checkbox checkbox-sm checkbox-primary"
            value="featured"
          />
        </label>
      </div>
    </div>
    <div>
      <form method="GET">
        <div class="relative text-gray-600 focus-within:text-gray-400">
          <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            <button
              type="submit"
              class="p-1 focus:outline-none focus:shadow-outline"
            >
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                class="w-6 h-6"
              >
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </button>
          </span>
          <input
            type="search"
            name="q"
            class="w-[300px] py-2 text-sm text-white bg-gray-100 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
            placeholder="Search for headline"
            autocomplete="off"
          />
        </div>
      </form>
    </div>
  </div>
  <div class="overflow-x-auto w-full shadow rounded-lg">
    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>
            <label>
              <input type="checkbox" class="checkbox" />
            </label>
          </th>
          <th>Cover</th>
          <th>Headline</th>
          <th>Date Posted</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        <tr>
          <th>
            <label>
              <input type="checkbox" class="checkbox" />
            </label>
          </th>
          <td>
            <div class="flex items-center space-x-3">
              <div class="avatar">
                <div class="mask mask-squircle w-12 h-12">
                  <img
                    src="https://placeimg.com/250/250/tech"
                    alt="Avatar Tailwind CSS Component"
                  />
                </div>
              </div>
            </div>
          </td>
          <td>
            <span class="text-sm font-bold"
              >Storage facilities for relief goods during calamities
              proposed</span
            >
          </td>
          <td><span class="text-[11px]">Sept 12, 2022</span></td>
          <th>
            <button class="btn btn-ghost btn-xs">
              <span
                class="text-[11px] text-orange-700 font-bold underline capitalize"
                >Edit</span
              >
            </button>
          </th>
        </tr>
      </tbody>
      <!-- foot -->
      <tfoot>
        <tr>
          <th>
            <label>
              <input type="checkbox" class="checkbox" />
            </label>
          </th>
          <th>Cover</th>
          <th>Headline</th>
          <th>Date Posted</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
    <router-view name="newsform"></router-view>
  </div>
</template>
