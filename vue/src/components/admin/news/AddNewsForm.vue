<template>
  <div class="mt-5 md:col-span-2 md:mt-0">
    <form @submit.prevent="saveNews">
      <div class="shadow sm:overflow-hidden sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
          <h1 class="text-xl uppercase mb-2">
            {{ model.id ? model.headline : "Write a news article" }}
          </h1>
          <!-- <pre>{{ model }}</pre> -->
          <div>
            <label class="block text-sm font-medium text-gray-700"
              >Cover photo</label
            >
            <div
              class="mt-2 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6"
            >
              <div class="space-y-1 text-center">
                <svg
                  class="mx-auto h-12 w-12 text-gray-400"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 48 48"
                  aria-hidden="true"
                  v-if="!model.cover_photo"
                >
                  <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  />
                </svg>
                <img
                  v-else
                  :src="model.cover_photo"
                  :alt="model.headline"
                  w-64
                  h-48
                  object-cover
                />
                <div
                  class="flex text-sm items-center justify-center text-gray-600"
                >
                  <label
                    for="file-upload"
                    class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500"
                  >
                    <span>Upload a file</span>
                    <input
                      id="file-upload"
                      name="file-upload"
                      type="file"
                      class="sr-only"
                    />
                  </label>
                </div>
                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Headline</label
              >
              <div class="mt-4 flex shadow-sm">
                <input
                  v-model="model.headline"
                  type="text"
                  name="headline"
                  id="headline"
                  class="input block w-full flex-1 rounded-sm border-gray-300 focus:border-transparent focus:ring-none sm:text-sm"
                />
              </div>
            </div>
          </div>

          <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700"
              >Excerpt</label
            >
            <div class="mt-2">
              <textarea
                v-model="model.excerpt"
                id="excerpt"
                name="excerpt"
                rows="3"
                class="input block w-full flex-1 h-20 rounded-sm p-2 border-gray-300 focus:border-transparent focus:ring-none sm:text-sm"
                placeholder="Type something here"
              />
            </div>
            <p class="mt-2 text-sm text-gray-500">
              Brief information about this news. Will be displayed as subheading
              on news list.
            </p>
          </div>

          <div>
            <label for="content" class="block text-sm font-medium text-gray-700"
              >Content</label
            >
            <div class="mt-2">
              <QuillEditor
                v-model:content="model.content"
                contentType="html"
                theme="snow"
                toolbar="essential"
                class="h-48"
              />
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
          <button
            type="submit"
            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            Save
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>
import { ref } from "vue";
import store from "../../../store";
import { useRoute } from "vue-router";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
// import router from "../../../router";

const router = useRoute();
let model = ref({
  headline: "",
  excerpt: "",
  content: "",
  cover_photo: "",
});

if (route.params.id) {
  model.value = store.state.news.find(
    (s) => s.id === parseInt(route.params.id)
  );
}

const saveNews = () => {
  // store.dispatch("saveNews", model.value).then(({ data }) => {
  //   console.log("test");
  // });
};
</script>
