<template>
    <div
        class="max-w-md rounded shadow-md m-4 text-jost text-sm text-gray-300 bg-gray-900"
    >
        <div class="w-full mr-4 flex">
            <div class="w-1/3">
                <img
                    class="border-4 border-amber-200 w-28 m-4 rounded-tr-3xl rounded-bl-3xl p-1"
                    :src="collection.cover_card"
                    alt="image"
                />
            </div>
            <div class="w-2/3 mt-2">
                <span class=" text text-amber-200 text-lg ">
                    {{ collection.name }}
                </span>
              
              

                <br>
                <div class="mt-4"> <span class="text-emerald-300 mt-4">
                    <img
                        :src="'/icons/' + collection.category.icon"
                        class="w-8 inline-block mx-1 bg-amber-200 p-1 rounded-full"
                    />
                </span>
                &nbsp;
                <span
                    class="text-gray-700  bg-amber-200 rounded-full px-2 py-1 inline-block"
                >
                    {{ collection.cards.length }} cards
                </span>

                <p class="text-amber-200 mb-2">
                    {{ collection.category.name }}
                </p></div>
               

               
            </div>
        </div>

        <div
            class="w-full text-sm rounded text-lobster text-gray-700 flex flex-wrap content-start ml-1 pb-1 mt-2"
        >
            <div
                v-for="card in collection.cards"
                :key="card.id"
                class="mx-0.5 my-0.5"
            >
                <div
                    v-if="pasted.includes(card.id)"
                    class="bg-emerald-300 border-emerald-500 px-0.5 pt-2 w-10 h-10 rounded-sm border-b-3 border-l-3"
                >
                    {{ card.order }}
                </div>

                <div
                    v-else-if="available.includes(card.id)"
                    class="bg-amber-200 border-amber-500 px-0.5 pt-2 w-10 h-10 rounded-sm border-b-3 border-l-3 animate-pulse"
                >
                    {{ card.order }}
                </div>

                <div
                    v-else
                    class="bg-gray-400 border-gray-500 px-0.5 pt-2 w-10 h-10 rounded-sm border-b-3 border-l-3"
                >
                    {{ card.order }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";

export default {
    name: "CollectionCard",
    components: {
        AppLayout,
    },
    props: {
        collection: {
            type: Object,
            default: {},
        },
        available: {
            type: Array,
            default: [],
        },
        pasted: {
            type: Array,
            default: [],
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
