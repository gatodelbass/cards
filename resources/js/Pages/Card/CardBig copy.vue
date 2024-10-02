<template>
 <div class="justify-center h-full">
        <div class="w-10/12 mb-1">
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
        <div class="w-10/12">
            <img :src="card.image" class="border-white border-8" />
        </div>
        <div class="w-10/12 h-8 text-left text-amber-100 mt-1 text-sm">
            {{ card.name }}
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";

export default {
    name: "CardBig",
    components: {},
    props: {
        card: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        return {
            state,
        };
    },
};
</script>
