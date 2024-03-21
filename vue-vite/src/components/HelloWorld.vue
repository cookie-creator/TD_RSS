<script setup>
import { ref } from 'vue'

defineProps({
  msg: String,
})

const count = ref(0)
</script>

<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full bg-white">
      <body class="h-full">
      ```
    -->
    <h1>HelloWorld</h1>
</template>


<style scoped>
.read-the-docs {
  color: #888;
}
</style>
