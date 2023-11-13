<template>
    <div class="w-full h-8 pl-20 mt-10">
        <div class="w-6/12 inline-block mb-2">
            <span v-for="n in card.rarity" :key="n">
                <img
                    class="inline-block w-4 mx-1"
                    :src="'/icons/starHueso.svg'"
                />
            </span>
        </div>
        <div class="w-6/12 inline-block">
            <span
                class="bg-amber-200 rounded-sm px-2 mt-1 text-base text-lobster text-blueGray-700"
                >card #{{ card.id }}</span
            >
        </div>
    </div>
    <div class="w-full h-52 transform rotate-90 pt-1 mt-5 mb-2">
        <div class="relative cursor-pointer w-56 mx-16 -my-14">
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
    <div class="w-full h-8 text-center text-rye text-amber-200">
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
