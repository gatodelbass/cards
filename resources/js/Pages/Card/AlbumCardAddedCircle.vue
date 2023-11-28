<template>
    <div class="justify-center pl-16 pt-10">
        <div class="w-56 mb-1">
            <div class="w-6/12 inline-block">
                <span v-for="n in card.rarity" :key="n" class="text-lg"
                    >⭐</span
                >
            </div>
            <div class="w-6/12 inline-block text-right">
                <span
                    class="bg-amber-200 rounded-sm px-2 mt-1 text-base text-lobster text-blueGray-700"
                >
                    #{{ card.collection_id }} - {{ card.order }}</span
                >
            </div>
        </div>
        <div class="w-56 rounded-full">
            <!-- <img class="w-10 absolute left-10 top-10 animate-ping1 " :src="'/images/partyAmber.svg'" />
            <img class="w-12 absolute left-16 top-16 animate-ping2 " :src="'/images/partyBlue.svg'" />
            <img class="w-14 absolute left-24 top-24 animate-ping3 " :src="'/images/partyGreen.svg'" />
            <img class="w-16 absolute left-32 top-32 animate-ping4 " :src="'/images/partyRed.svg'" /> -->

            <img :src="card.image" class="border-white border-8 rounded-full" />
        </div>
        <div class="w-56 h-8 text-left text-amber-100 mt-1 text-sm text-elite">
            {{ card.name }}
        </div>
    </div>
</template>

<script>
import { reactive, onMounted } from "vue";

export default {
    props: {
        card: Object,
        default: {},
    },

    name: "AlbumCardAddedCenter",

    setup() {
        const state = reactive({});

        onMounted(() => {});

        return {
            state,
        };
    },
};
</script>
