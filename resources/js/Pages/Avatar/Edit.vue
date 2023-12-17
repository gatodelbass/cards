<template>
  <app-layout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl leading-tight">Cards</h2>
      </div>
    </template>

    <div class="justify-center flex flex-wrap p-5 m-2">
      <div
        class="grid bg-white rounded-sm shadow-xl w-11/12 md:w-9/12 lg:w-1/2"
      >
        <div class="flex justify-center py-4">
          <div
            class="
              flex
              bg-blueGray-800
              rounded-full
              md:p-4
              p-2
              border-1 border-gray-300
            "
          >
            <svg
              class="w-8 h-8 text-amber-300"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
              ></path>
            </svg>
          </div>
        </div>

        <div class="flex justify-center">
          <div class="flex">
            <h1 class="text-gray-600 font-bold md:text-2xl text-xl">
              Edit Card
            </h1>
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 mt-5 mx-7">
          <div class="grid grid-cols-1">
            <label
              class="md:text-sm text-xs text-gray-500 text-light font-semibold"
              >Name</label
            >
            <input
              v-model="card.name"
              class="
                py-1
                px-3
                rounded-sm
                border-1 border-gray-300
                mt-1
                focus:outline-none
                focus:ring-2 focus:ring-amber-400
                focus:border-transparent
              "
              type="text"
              placeholder=""
            />
            <jet-input-error :message="form.errors.name" class="mt-2" />
          </div>
          <div class="grid grid-cols-1">
            <label
              class="md:text-sm text-xs text-gray-500 text-light font-semibold"
              >Rarity</label
            >

            <span class="text-center ml-2 mt-2 font-semibold">
              <button
                type="button"
                v-for="i in 7"
                :key="i"
                :class="{ 'mr-1': i < 7 }"
                @click="setRarity(i)"
              >
                <svg
                  class="block h-6 w-6"
                  :class="[
                    card.rarity >= i
                      ? 'text-blueGray-700'
                      : 'text-blueGray-300',
                  ]"
                  fill="currentColor"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"
                  />
                </svg>
              </button>
            </span>

            <jet-input-error :message="form.errors.rarity" class="mt-2" />
          </div>
         
        </div>   

        <div class="grid grid-cols-1 mt-5 mx-7">
          <label
            class="
              md:text-sm
              text-xs text-gray-500 text-light
              font-semibold
              mb-1
            "
            >Upload Image</label
          >
          <div class="flex items-center justify-center w-full">
            <label
              class="
                flex flex-col
                border-4 border-dashed
                w-full
                h-32
                hover:bg-gray-100
                hover:border-gray-300
                group
              "
            >
              <div class="flex flex-col items-center justify-center pt-7">
                <svg
                  class="
                    w-10
                    h-10
                    text-blueGray-500
                    group-hover:text-blueGray-600
                  "
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                  ></path>
                </svg>
                <p
                  class="
                    lowercase
                    text-sm text-gray-400
                    group-hover:text-blueGray-600
                    pt-1
                    tracking-wider
                  "
                >
                  (225px x 350px)
                </p>
              </div>
              <input type="file" class="hidden" @change="onFileSelected" />
            </label>
          </div>
        </div>

        <div class="flex items-center justify-center md:gap-8 gap-4 pt-5 pb-5">
          <a
            :href="route('cards.index')"
            class="
              w-auto
              bg-blueGray-700
              hover:bg-gray-600
              rounded-sm
              shadow-xl
              font-medium
              text-amber-300
              px-4
              py-2
            "
            >Go back</a
          >
          <button
            @click="update()"
            class="
              w-auto
              bg-teal-500
              hover:bg-teal-600
              rounded-sm
              shadow-xl
              font-medium
              text-blueGray-700
              px-4
              py-2
            "
          >
            Create
          </button>
        </div>
      </div>
    </div>
  </app-layout>
</template>


<script>
import { onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import JetInputError from "@/Jetstream/InputError";
import Swal from "sweetalert2";

export default {
  name: "CardCreate",
  components: {
    AppLayout,
    JetInputError,
  },
  props: {
  
    card: {
      type: Object,
      default: {},
    },
  },

  setup(props, { emit }) {
    const state = reactive({
      selectedFile: null,
    });

    onMounted(() => {

    });

    const form = useForm({
      id: null,
      name: null,
      rarity: null,     
      image: null,
      _method: "PUT",
    });

    function update() {
      form.id = props.card.id;
      form.name = props.card.name;
      form.rarity = props.card.rarity;      

      form.post(route("cards.update", props.card.id), {
        onSuccess: () => {
          Swal.fire({
            toast: true,
            title: '<p class="text-xl text-blueGray-300">Hecho</p>',
            showClass: { popup: "" },
            position: "top-end",
            showConfirmButton: false,
            icon: "success",
            background: "#334155",
            timer: 1500,
          });
        },
        onError: () => {
          Swal.fire({
            toast: true,
            title: '<p class="text-xl">Error</p>',
            showClass: { popup: "" },
            position: "top-end",
            showConfirmButton: false,
            icon: "error",
            background: "#fddf7f",
            timer: 1500,
          });
        },
      });
    }

    function setRarity(rarity) {
      props.card.rarity = rarity;
    }

    function onFileSelected(event) {
      form.image = event.target.files[0];
    }

    return {
      update,
      form,
      state,
      onFileSelected,
      setRarity,
    };
  },
};
</script>