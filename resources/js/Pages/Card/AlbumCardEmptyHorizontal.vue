<template>
    <div class="justify-center pl-20">
        <div class="w-78 mb-1">
            <div class="w-6/12 inline-block">
                <span
                    class="text-lg text-gray-200"
                    v-for="n in card.rarity"
                    :key="n"
                >
                    ☆
                </span>
            </div>
            <div class="w-6/12 inline-block text-right"></div>
        </div>

        <div class="content-center">
            <div
                class="w-78 h-56 border-1 content-center items-center justify-center"
            >
                <span v-if="availableCard" class="">
                    <button
                        @click="pasteCard(card)"
                        class="bg-amber-200 p-4 text-2xl tracking-wider text-gray-800 rounded hover:bg-amber-300 mt-4 mx-auto shadow-lg text-jost"
                    >
                        Paste!
                    </button>
                </span>
                <br /><br /><br />
                <span
                    class="border-1 rounded-full py-5 px-4 my-6 text-lobster text-2xl text-center text-gray-200"
                >
                    #{{ card.collection_id }} - {{ card.order }}
                </span>
            </div>
        </div>

        <div class="w-78 h-8 text-left text-amber-100 mt-1 text-sm">
            {{ card.name }}
        </div>
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
