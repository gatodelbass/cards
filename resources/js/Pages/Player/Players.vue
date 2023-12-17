<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        All players
    </h1>
    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">

        <div v-for="player in players" :key="player.id">

             <PlayerCard :player="player"></PlayerCard>

        </div>

       
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";

import PlayerCard from "../Player/PlayerCard.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        PlayerCard,
    },

    props: {
        players: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
           
        });

        onMounted(() => {
          
        });

       

       

        return {
          
            state,
        };
    },
};
</script>
