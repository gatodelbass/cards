<template>
    <div class="justify-center pl-20">
        <div class="w-56 mb-1">
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

        <div class="content-center relative">


            <div v-if="state.paste">
                
            <img class="w-10 absolute left-10 top-10 animate-ping1 " :src="'/images/partyAmber.svg'" />
            <img class="w-12 absolute left-16 top-16 animate-ping2 " :src="'/images/partyBlue.svg'" />
            <img class="w-14 absolute left-24 top-24 animate-ping3 " :src="'/images/partyGreen.svg'" />
            <img class="w-16 absolute left-32 top-32 animate-ping4 " :src="'/images/partyRed.svg'" />
            
            </div>

        

            <div
                class="w-56 h-56 border-1 content-center items-center justify-center rounded-full"
            >
                <span v-if="availableCard" class="">
                    <button
                        @click="pasteCard(card)"
                        class="bg-amber-200 p-4 text-2xl tracking-wider text-gray-800 rounded-full hover:bg-amber-300 mt-4 mx-auto shadow-lg text-jost"
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

        <div class="w-56 h-8 text-left text-amber-100 mt-1 text-sm">
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

    name: "AlbumCardEmptyHorizontal",

    setup(props, { emit }) {
        const state = reactive({
            paste: false
        });

        onMounted(() => {});

        async function pasteCard(card) {
            await axios
                .get(route("pasteCard", card.id))
                .then(function (response) {
                    state.paste = true;
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
