<template>
    <div class="justify-center pl-20">
        <div class="w-56">
            <div class="w-6/12 inline-block">
                <span v-for="n in card.rarity" :key="n"> ⭐ </span>
            </div>
            <div class="w-6/12 inline-block text-right">
                <span
                    class="bg-amber-200 rounded-sm px-2 mt-1 text-base text-lobster text-blueGray-700"
                >
                    #{{ card.collection_id }} - {{ card.order }}</span
                >
            </div>
        </div>

        <div class="w-56 h-78 mt-16">
            <div class="relative cursor-pointer -my-14">
                <img
                    :src="card.image"
                    class="z-10 absolute border-white border-8"
                />
                <img
                    v-if="card.top_filter != 'none'"
                    :src="'/filters/' + card.top_filter"
                    class="z-20 absolute border-white border-8"
                />
                <img
                    v-if="card.bottom_filter != 'none'"
                    :src="'/filters/' + card.bottom_filter"
                    class="z-0 absolute border-white border-8"
                />
            </div>
        </div>

        <div class="w-56 h-8 text-left text-amber-200 mt-1 text-sm">
            {{ card.name }} y aqui mas nombre y descipciones del la carta
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
