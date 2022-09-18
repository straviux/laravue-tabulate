<template>
  <div class="mt-5 md:col-span-2 md:mt-0 w-full md:w-[500px] mx-auto">
    <form @submit.prevent="saveEvent">
      <div class="shadow sm:overflow-hidden sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
          <div class="flex justify-between">
            <h1 class="text-xl uppercase mb-2">
              {{ model.id ? model.event_name : "Add new Event" }}
            </h1>
            <router-link
              :to="{ name: 'Events' }"
              class="underline text-blue-800"
              >Cancel</router-link
            >
          </div>
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Event Name</label
              >
              <div class="mt-4 flex shadow-sm">
                <input
                  v-model="model.event_name"
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
              >Description</label
            >
            <div class="mt-2">
              <textarea
                v-model="model.event_description"
                id="excerpt"
                name="excerpt"
                rows="3"
                class="input block w-full flex-1 h-20 rounded-sm p-2 border-gray-300 focus:border-transparent focus:ring-none sm:text-sm"
                placeholder="Type something here"
              />
            </div>
            <p class="mt-2 text-sm text-gray-500">
              Brief information about this event.
            </p>
          </div>
          <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700"
              >Event Date</label
            >
            <Datepicker
              format="yyyy/MM/dd"
              v-model="model.event_date"
              class="mt-2"
            ></Datepicker>
          </div>
          <div
            class="px-4 py-3 sm:px-6 flex items-center justify-center space-x-7"
          >
            <div class="form-control">
              <label class="label cursor-pointer space-x-2">
                <span class="label-text text-lg">Active</span>
                <input
                  type="checkbox"
                  class="checkbox checkbox-primary"
                  v-model="model.status"
                />
              </label>
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
import { ref, watch } from "vue";
import store from "../../store";
import { useRoute, useRouter } from "vue-router";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
// import router from "../../../router";

const route = useRoute();
const router = useRouter();
let model = ref({
  event_name: "",
  status: "",
  event_description: "",
  event_date: "",
});

//watch current news from store
watch(
  () => store.state.currentEvent.data,
  (newVal, oldVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  }
);

if (route.params.id) {
  store.dispatch("getEvent", route.params.id);
}

const saveEvent = () => {
  store.dispatch("saveEvent", model.value).then(({ data }) => {
    console.log(data);
  });
};
// const onImageChange = (ev) => {
//   const file = ev.target.files[0];
//   const reader = new FileReader();
//   reader.onload = () => {
//     model.value.cover_photo = reader.result;
//     model.value.cover_photo_url = reader.result;
//   };
//   reader.readAsDataURL(file);
// };
// const assignValToSlug = () => {
//   model.value.slug = model.value.excerpt;
// };
</script>
