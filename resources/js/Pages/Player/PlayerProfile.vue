<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Profile
    </h1>

    <div
        :style="{ 'background-image': 'url(' + state.backgroundImage + ')' }"
        class="bg-fixed bg-repeat w-full justify-center flex flex-wrap p-10 border-t-4 border-b-4 border-yellow-500"
    >
        <div
            class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base"
        >
            <PlayerCard :player="user"></PlayerCard>
        </div>

        <div
            class="container flex flex-wrap mx-auto text-blueGray-800 p-2 md:p-4 text-sm md:text-base justify-center"
        >
            <PrizeCard
                v-for="prize in userPrizes"
                :key="prize.id"
                :prize="prize"
            ></PrizeCard>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

import { usePage } from "@inertiajs/inertia-vue3";

import PlayerCard from "../Player/PlayerCard.vue";
import PrizeCard from "../Player/PrizeCard.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        PlayerCard,
        PrizeCard,
    },

    props: {
        user: {
            type: Object,
            default: {},
        },
        userPrizes: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            userAvatars: {},
            filters: {
                obtained: true,
                exchange: true,
                protected: true,
                pasted: false,
            },
            backgroundImage: "/images/p1.jpg",
        });

        onMounted(() => {});

        return {
            state,
        };
    },
};
</script>
