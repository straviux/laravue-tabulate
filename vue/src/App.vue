<script setup>
// This starter template is using Vue 3 <script setup> SFCs
// Check out https://v3.vuejs.org/api/sfc-script-setup.html#sfc-script-setup
</script>

<template>
  <router-view :key="$route.path"></router-view>
</template>

<style>
.display-on-print {
  display: none;
}

@media print {
  @page {
    margin: 0 !important;
  }
  .no-print {
    display: none !important;
  }

  .display-on-print {
    display: inline;
  }
  .print-div {
    display: block !important;
    background-color: transparent !important;
    -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    box-shadow: none !important;
    align-items: center;
  }
}
</style>
