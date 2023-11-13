<template>
    <div class="w-full h-8 pl-20">
        <div class="w-6/12 inline-block">
            <span v-for="n in card.rarity" :key="n">
                <img
                    class="inline-block w-4 mx-1"
                    :src="'/icons/starHueso.svg'"
                />
            </span>
        </div>
        <div class="w-6/12 inline-block text-left">
            <span
                class="bg-amber-200 rounded-sm px-2 mt-1 text-base text-lobster text-blueGray-700"
                >card #{{ card.id }}</span
            >
        </div>
    </div>
    <div class="w-full h-80 transform rotate-0 p-1">
        <div class="relative w-56 mx-20">
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
    <div class="w-full h-8 text-center text-rye pt-4 text-amber-200">
        {{ card.name }}
    </div>
</template>

<script>
import { reactive, onMounted } from "vue";

export default {
    props: {
        card: Object,
        default: {},
    },

    name: "AlbumCardAddedHorizontal",

    setup() {
        const state = reactive({});

        onMounted(() => {});

        return {
            state,
        };
    },
};
</script>
