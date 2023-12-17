<template>
    <app-layout></app-layout>

    <div
        class="w-full justify-center text-center flex flex-wrap text-hueso-600 bg-gradient-to-br from-gray-900 via-blue-900 to-pink-900"
    >
        <div
            class="text-amber-200 text-center text-6xl w-full text-lobster my-10"
        >
            <p class="text-6xl">{{ collection.name }}</p>

            <p class="text-2xl text-teal-400 mt-2">
                <img
                    :src="'/icons/' + collection.category.icon"
                    class="w-6 inline-block m-1 bg-teal-400 p-0.5 rounded-full"
                />
                {{ collection.category.name }}
            </p>

            <p class="text-base text-gray-300 text-jost">
                Created by: {{ collection.user.nickname }}
            </p>
        </div>

        <div
            :key="card.id"
            v-for="card in collection.cards"
            class="w-96 h-96 mx-0 my-8 transform"
        >
            <div v-if="card.layout == 'Horizontal'">
                <AlbumCardAddedHorizontal
                    :card="card"
                ></AlbumCardAddedHorizontal>
            </div>
            <div v-else class="cursor-pointer">
                <AlbumCardAddedVertical :card="card"></AlbumCardAddedVertical>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import AlbumCardEmptyVertical from "../Card/AlbumCardEmptyVertical.vue";
import AlbumCardEmptyHorizontal from "../Card/AlbumCardEmptyHorizontal.vue";
import AlbumCardAddedVertical from "../Card/AlbumCardAddedVertical.vue";
import AlbumCardAddedHorizontal from "../Card/AlbumCardAddedHorizontal.vue";

export default {
    name: "CollectionCard",
    components: {
        AppLayout,
        AlbumCardEmptyVertical,
        AlbumCardEmptyHorizontal,
        AlbumCardAddedVertical,
        AlbumCardAddedHorizontal,
    },
    props: {
        collection: {
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
