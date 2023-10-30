<template>
    <div :id="card.id" class="w-full h-8 pl-20 mt-10">
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
    <div class="w-80 pt-1 mt-1 mb-2 mx-8 border-1 content-center">
        <div v-if="availableCard" class="w-64 h-20 p-1 mx-auto">
            <button
                @click="pasteCard(card)"
                class="bg-amber-200 p-4 text-2xl tracking-wider text-gray-800 rounded hover:bg-amber-300 my-2 mx-4 shadow-lg text-jost"
            >
                Paste!
            </button>
        </div>

        <div v-else class="w-64 h-20 p-1"></div>

        <div
            class="border-1 rounded-full py-5 my-6 mx-28 text-lobster text-2xl text-center text-gray-200"
        >
            #{{ card.id }}
        </div>
    </div>

    <div class="w-full h-8 text-center text-rye text-amber-200 opacity-20">
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

    name: "AlbumCardEmptyHorizontal",

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
