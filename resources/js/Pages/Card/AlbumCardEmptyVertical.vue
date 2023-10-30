<template>
    <div   class="w-full h-8 pl-20">
        <div class="w-6/12 inline-block">
            <span v-for="n in card.rarity" :key="n">
                <img
                    class="inline-block w-4 mx-1"
                    :src="'/icons/starHueso.svg'"
                />
            </span>
        </div>
        <div class="w-6/12 inline-block"></div>
    </div>
    <div
        class="w-56 rounded-sm h-72 transform rotate-0 border-1  mx-20 my-1"
    >
        <div v-if="availableCard" class="w-full h-44 p-1 rounded">
            <button
                @click="pasteCard(card)"
                class="bg-amber-200 p-4 m-3 text-2xl tracking-wider text-gray-800 rounded hover:bg-amber-300 shadow-lg text-jost"
            >
                Paste!
            </button>
        </div>

        <div
            v-else
            class="w-64 h-44 p-1 rounded transform rotate-0 my-0 mx-8"
        ></div>

        <div
            class="border-1  rounded-full py-5 my-22 mx-16 text-lobster text-2xl text-center relative bottom-0 text-gray-200"
        >
            #{{ card.id }}
        </div>
    </div>
    <div class="w-full h-8 text-center text-rye pt-1 text-amber-200 opacity-20">
        {{ card.name }}
    </div>
</template>

<script>
import axios from "axios";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

export default {
    props: {
        card: Object,
        availableCard: Boolean,
    },

    name: "AlbumCardEmptyVertical",

    setup(props, { emit }) {
        const state = reactive({});

        onMounted(() => {});

        async function pasteCard(card) {
            await axios
                .get(route("pasteCard", card.id))
                .then(function (response) {
                    emit("refreshAlbumPage");

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-gray-300">Done!</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#334155",
                        timer: 1500,
                    });
                })
                .catch(function (error) {});
        }

        return {
            state,
            pasteCard,
        };
    },
};
</script>
