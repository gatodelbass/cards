<template>
  <app-layout> </app-layout>

  <div class="w-full text-jost">
    <div class="container mx-auto text-blueGray-800">
      <div
        class="w-96 mx-auto bg-gradient-to-br from-cyan-400 via-sky-400 to-cyan-400 rounded shadow py-2 my-10"
      >
        <h1 class="text-jost my-4 text-xl">Thanks for your registration!</h1>

        <div class="py-4 px-8">
          <div class="mb-4 text-left">
            <label class="block">Hello {{ user.nickname }}</label>
          </div>

          <div class="mb-4 text-left">
            <label class="block"
              >We sent an email to {{ user.email }}. Please check your inbox to
              activate your user</label
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
