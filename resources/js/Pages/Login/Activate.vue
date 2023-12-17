<template>
  <app-layout> </app-layout>

  <div class="w-full text-jost">
    <div class="container mx-auto text-blueGray-800">
      <div
        class="w-96 mx-auto bg-gradient-to-br from-cyan-400 via-sky-400 to-cyan-400 rounded shadow py-2 my-10"
      >
        <h1 class="text-jost my-4 text-xl">Thank you! Your user is ready</h1>

        <div class="py-4 px-8">
          <div class="mb-4 text-left">
            <label class="block"
              >Hello {{ user.nickname }}, now you have:</label
            >
          </div>

          <div class="mb-4 text-left text-xl">
            <img class="w-10 inline-block mx-1" :src="'/icons/box.svg'" />Boxes
            x2
          </div>
          <div class="mb-4 text-left text-xl">
            <img
              class="w-10 inline-block mx-1"
              :src="'/icons/ticket.svg'"
            />Tickets x10
          </div>
          <div class="mb-4 text-left text-xl">
            <img class="w-10 inline-block mx-1" :src="'/icons/coin.svg'" /> Gold
            100.000
          </div>

          <div class="mb-4 mt-6">
            <Link :href="route('loginForm')"
              ><button
                type="button"
                class="bg-gradient-to-r from-blue-100 to-blue-200 hover:border-1 py-2 px-4 mt-2 rounded-full"
              >
                Go to login
              </button></Link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  name: "Cart",

  components: { AppLayout },

  props: {
    user: {
      type: Object,
      default: {},
    },
  },

  setup() {
    return {};
  },
};
</script>
