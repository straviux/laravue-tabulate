<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover class="relative bg-white">
    <div class="mx-auto px-4 sm:px-8">
      <div
        class="flex items-center justify-between border-b-2 border-gray-100 py-3 md:justify-start md:space-x-10"
      >
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <a href="/" class="z-20">
            <span class="sr-only">Province</span>
            <img
              class="h-24 w-auto sm:h-24"
              src="../assets/img/province_logo_colored.gif"
              alt=""
            />
          </a>
          <a href="/" class="mt-2 ml-2 z-10">
            <span class="sr-only">Congress</span>
            <img
              class="h-20 w-auto sm:h-20"
              src="../assets/img/logo_colored.gif"
              alt=""
            />
          </a>
          <a href="/" class="mt-4 -ml-28 z-0">
            <span class="sr-only">Congress</span>
            <img
              class="h-20 w-auto sm:h-20"
              src="../assets/img/title.gif"
              alt=""
            />
          </a>
        </div>
        <div class="-my-2 -mr-2 md:hidden">
          <PopoverButton
            class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
          >
            <span class="sr-only">Open menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </PopoverButton>
        </div>
        <PopoverGroup as="nav" class="hidden space-x-10 md:flex">
          <Popover class="relative" v-slot="{ open }">
            <PopoverButton
              :class="[
                open ? 'text-gray-900' : 'text-gray-500',
                'group inline-flex items-center rounded-md bg-white text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
              ]"
            >
              <span class="prose">JPM Assistance</span>
              <ChevronDownIcon
                :class="[
                  open ? 'text-gray-600' : 'text-gray-400',
                  'ml-2 h-5 w-5 group-hover:text-gray-500',
                ]"
                aria-hidden="true"
              />
            </PopoverButton>

            <transition
              enter-active-class="transition ease-out duration-200"
              enter-from-class="opacity-0 translate-y-1"
              enter-to-class="opacity-100 translate-y-0"
              leave-active-class="transition ease-in duration-150"
              leave-from-class="opacity-100 translate-y-0"
              leave-to-class="opacity-0 translate-y-1"
            >
              <PopoverPanel
                class="absolute -ml-4 mt-3 w-screen max-w-md transform px-2 sm:px-0 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 z-30"
              >
                <div
                  class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
                >
                  <div
                    class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8"
                  >
                    <a
                      v-for="item in solutions"
                      :key="item.name"
                      :href="item.href"
                      class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50"
                    >
                      <component
                        :is="item.icon"
                        class="h-6 w-6 flex-shrink-0 text-indigo-600"
                        aria-hidden="true"
                      />
                      <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                          {{ item.name }}
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                          {{ item.description }}
                        </p>
                      </div>
                    </a>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
          <router-link
            :to="'/'"
            class="text-base font-medium text-gray-500 hover:text-gray-900"
            >Home</router-link
          >
          <router-link
            :to="'news'"
            class="text-base font-medium text-gray-500 hover:text-gray-900"
            >News</router-link
          >
          <router-link
            :to="'articles'"
            class="text-base font-medium text-gray-500 hover:text-gray-900"
            >Articles</router-link
          >
          <router-link
            :to="'gallery'"
            class="text-base font-medium text-gray-500 hover:text-gray-900"
            >Gallery</router-link
          >

          <Popover class="relative" v-slot="{ open }">
            <PopoverButton
              :class="[
                open ? 'text-gray-900' : 'text-gray-500',
                'group inline-flex items-center rounded-md bg-white text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
              ]"
            >
              <span>More</span>
              <ChevronDownIcon
                :class="[
                  open ? 'text-gray-600' : 'text-gray-400',
                  'ml-2 h-5 w-5 group-hover:text-gray-500',
                ]"
                aria-hidden="true"
              />
            </PopoverButton>

            <transition
              enter-active-class="transition ease-out duration-200"
              enter-from-class="opacity-0 translate-y-1"
              enter-to-class="opacity-100 translate-y-0"
              leave-active-class="transition ease-in duration-150"
              leave-from-class="opacity-100 translate-y-0"
              leave-to-class="opacity-0 translate-y-1"
            >
              <PopoverPanel
                class="absolute left-1/2 z-40 mt-3 w-screen max-w-md -translate-x-1/2 transform px-2 sm:px-0"
              >
                <div
                  class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"
                >
                  <div
                    class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8"
                  >
                    <a
                      v-for="item in resources"
                      :key="item.name"
                      :href="item.href"
                      class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50"
                    >
                      <component
                        :is="item.icon"
                        class="h-6 w-6 flex-shrink-0 text-indigo-600"
                        aria-hidden="true"
                      />
                      <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">
                          {{ item.name }}
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                          {{ item.description }}
                        </p>
                      </div>
                    </a>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
        </PopoverGroup>
        <div class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
          <router-link
            :to="'login'"
            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
            >Sign in</router-link
          >
          <router-link
            :to="'register'"
            class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md bg-green-500 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-600"
            >Sign up</router-link
          >
        </div>
      </div>
    </div>

    <transition
      enter-active-class="duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="duration-100 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <PopoverPanel
        focus
        class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden z-50"
      >
        <div
          class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
        >
          <div class="px-5 pt-5 pb-6">
            <div class="flex items-center justify-between">
              <div>
                <img
                  class="h-16 w-auto"
                  src="../assets/img/logo_colored.gif"
                  alt="Workflow"
                />
              </div>
              <div class="-mr-2">
                <PopoverButton
                  class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                >
                  <span class="sr-only">Close menu</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
            <div class="mt-6">
              <nav class="grid gap-y-8">
                <a
                  v-for="item in solutions"
                  :key="item.name"
                  :href="item.href"
                  class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50"
                >
                  <component
                    :is="item.icon"
                    class="h-6 w-6 flex-shrink-0 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">{{
                    item.name
                  }}</span>
                </a>
              </nav>
            </div>
          </div>
          <div class="space-y-6 py-6 px-5">
            <div class="grid grid-cols-2 gap-y-4 gap-x-8">
              <router-link
                :to="'/'"
                class="text-base font-medium text-gray-800 hover:text-gray-900"
                >Home</router-link
              >
              <router-link
                :to="'news'"
                class="text-base font-medium text-gray-800 hover:text-gray-900"
                >News</router-link
              >
              <router-link
                :to="'articles'"
                class="text-base font-medium text-gray-800 hover:text-gray-900"
                >Articles</router-link
              >
              <router-link
                :to="'gallery'"
                class="text-base font-medium text-gray-800 hover:text-gray-900"
                >Gallery</router-link
              >
              <a
                v-for="item in resources"
                :key="item.name"
                :href="item.href"
                class="text-base font-medium text-gray-800 hover:text-gray-700"
                >{{ item.name }}</a
              >
            </div>
            <div>
              <p class="mt-6 text-center text-base font-medium text-gray-500">
                Existing user?
                {{ " " }}
                <a href="#" class="text-indigo-600 hover:text-indigo-500"
                  >Sign in</a
                >
              </p>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
  <router-view></router-view>
  <footer class="p-4 md:px-6 md:py-8 bg-footer">
    <div class="sm:flex sm:items-center sm:justify-between">
      <a href="#" class="flex items-center mb-4 sm:mb-0">
        <img
          src="../assets/img/hor_logo.gif"
          class="mr-3 h-16"
          alt="House of Representative Logo"
        />
        <img
          src="../assets/img/province_logo.gif"
          class="mr-3 h-16"
          alt="House of Representative Logo"
        />
        <img
          src="../assets/img/jpm_logo.gif"
          class="mr-3 h-16"
          alt="House of Representative Logo"
        />
      </a>
      <ul
        class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400"
      >
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">About</a>
        </li>
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
        </li>
        <li>
          <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
        </li>
        <li>
          <a href="#" class="hover:underline">Contact</a>
        </li>
      </ul>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400"
      >© 2022 <a href="#" class="hover:underline">JPM Palawan</a>. All Rights
      Reserved.
    </span>
  </footer>
</template>

<script>
import { mapState } from "vuex";
import store from "../store";
import {
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
} from "@headlessui/vue";
import {
  ArrowPathIcon,
  Bars3Icon,
  BookmarkSquareIcon,
  CalendarIcon,
  ChartBarIcon,
  CursorArrowRaysIcon,
  LifebuoyIcon,
  PhoneIcon,
  PlayIcon,
  ShieldCheckIcon,
  Squares2X2Icon,
  XMarkIcon,
} from "@heroicons/vue/24/outline";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import router from "../router";

const solutions = [
  {
    name: "Financial Assitance",
    description: "Apply for financial assistance that you might need.",
    href: "#",
    icon: ChartBarIcon,
  },
  {
    name: "Scholarship",
    description: "Get an opportunity to be part of our scholarship programs.",
    href: "#",
    icon: CursorArrowRaysIcon,
  },
  {
    name: "Livelihood",
    description: "Join in our livelihood seminars and training programs.",
    href: "#",
    icon: ShieldCheckIcon,
  },
];

const resources = [
  {
    name: "Guides",
    description:
      "Learn how to maximize our platform to get the most out of it.",
    href: "#",
    icon: BookmarkSquareIcon,
  },
  {
    name: "Events",
    description: "See what events we might be planning near you.",
    href: "#",
    icon: CalendarIcon,
  },
  {
    name: "Frequently Ask Questions",
    description:
      "Get all of your questions answered in our forums or contact support.",
    href: "#",
    icon: LifebuoyIcon,
  },
  {
    name: "About Us",
    description: "Get to know who we are and what we do.",
    href: "#",
    icon: ShieldCheckIcon,
  },
];

export default {
  computed: {
    ...mapState(["user"]),
  },
  components: {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    ArrowPathIcon,
    Bars3Icon,
    BookmarkSquareIcon,
    CalendarIcon,
    ChartBarIcon,
    CursorArrowRaysIcon,
    LifebuoyIcon,
    PhoneIcon,
    PlayIcon,
    ShieldCheckIcon,
    Squares2X2Icon,
    XMarkIcon,
    ChevronDownIcon,
  },
  setup() {
    return {
      resources,
      solutions,
    };
  },
};
</script>
