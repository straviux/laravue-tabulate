<template>
  <div id="login-container" class="bg-no-repeat bg-cover bg-center relative">
    <div
      class="absolute bg-gradient-to-b from-blue-600 to-green-400 opacity-75 inset-0 z-0"
    ></div>
    <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
      <div class="flex justify-center self-center z-10">
        <div class="p-12 bg-white mx-auto rounded-2xl w-100">
          <div class="mb-4">
            <a
              href="#"
              @click="$router.go(-1)"
              class="float-right mt-2 underline cursor-pointer text-green-600"
              >Go Back</a
            >
            <h3 class="font-semibold text-2xl text-gray-800">Sign Up</h3>
            <p class="text-gray-500">Create your account.</p>
          </div>
          <form class="space-y-5" @submit="register">
            <div class="space-y-2">
              <label class="text-sm font-medium text-gray-700 tracking-wide"
                >Fullname</label
              >
              <input
                class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type="text"
                v-model="user.name"
                placeholder="Enter your name"
              />
            </div>
            <div class="space-y-2">
              <label class="text-sm font-medium text-gray-700 tracking-wide"
                >Username</label
              >
              <input
                class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type="text"
                v-model="user.username"
                placeholder="Enter your username"
              />
            </div>
            <div class="space-y-2">
              <label class="text-sm font-medium text-gray-700 tracking-wide"
                >Email Address</label
              >
              <input
                class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type="email"
                v-model="user.email"
                placeholder="Enter your email"
              />
            </div>
            <div class="space-y-2">
              <label
                class="mb-5 text-sm font-medium text-gray-700 tracking-wide"
              >
                Password
              </label>
              <input
                class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type="password"
                v-model="user.password"
                placeholder="Enter your password"
              />
            </div>
            <div class="space-y-2">
              <label
                class="mb-5 text-sm font-medium text-gray-700 tracking-wide"
              >
                Confirm Password
              </label>
              <input
                class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                type="password"
                v-model="user.password_confirmation"
                placeholder="Confirm your password"
              />
            </div>

            <div>
              <button
                type="submit"
                class="w-full flex justify-center bg-green-400 hover:bg-green-500 text-gray-100 p-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500"
              >
                Submit
              </button>
            </div>
          </form>
          <div class="flex items-center justify-between pt-5">
            <div class="text-sm">
              Existing user?

              <router-link
                :to="'login'"
                class="text-green-400 hover:text-green-500"
                >Sign in</router-link
              >
            </div>
          </div>
          <div class="pt-5 text-center text-gray-400 text-xs">
            <span> Copyright © 2022-2023</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import store from "../store";
import { useRouter } from "vue-router";
const router = useRouter();
const user = {
  name: "",
  username: "",
  email: "",
  password: "",
  password_confirmation: "",
};

const register = (ev) => {
  ev.preventDefault();
  store.dispatch("register", user).then(() => {
    router.push({ name: "Events" });
  });
};
</script>

<style lang="scss" scoped>
#login-container {
  background-image: url("../assets/img/login_bg.jpg");
}
</style>
