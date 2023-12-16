<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Batch collection
    </h1>
    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
        <div v-for="card in cards" :key="card.id">
            <div
                class="w-full md:w-64 p-1 bg-gradient-to-r from-gray-900 to-gray-600 rounded cursor-pointer my-2"
            >
                <span
                    class="bg-amber-200 rounded-sm px-2 py-0 mx-0 text-base text-lobster text-blueGray-700"
                    >card #{{ card.id }}</span
                >

                <div class="bg-lightBlue-300 mx-0 my-1">
                    <img
                        :src="'/storage/' + card.image"
                        class="z-0 border-white border-8"
                    />
                </div>
                <div
                    class="bg-gradient-to-r from-cyan-900 via-cyan-700 to-cyan-500 rounded align-middle text-center p-2 w-full text-rye"
                >
                    <jet-input
                        @keyup="saveCardName(card)"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="card.name"
                    />
                </div>
                {{ card.layout }}
                <div class="my-2 text-jost text-gray-200">
                    <input
                        @change="saveCardLayout(card)"
                        class="ml-5 mr-2"
                        type="radio"
                        id="Vertical"
                        value="Vertical"
                        v-model="card.layout"
                    />
                    <label for="Vertical">Vertical</label>

                    <input
                        @change="saveCardLayout(card)"
                        class="ml-5 mr-2"
                        type="radio"
                        id="Horizontal"
                        value="Horizontal"
                        v-model="card.layout"
                    />
                    <label for="Horizontal">Horizontal</label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import { onMounted, reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import JetInput from "@/Jetstream/Input";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        JetInput,
        CollectionCard,
    },
    props: {
        cards: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            cards: [],
            takenRarity: [],
            availableRarity: [],
        });

        async function saveCardName(card) {
            await axios
                .get(route("saveCardName", [card.id, card.name]))
                .then(function (response) {})
                .catch(function (error) {});
        }

        async function saveCardLayout(card) {
            await axios
                .get(route("saveCardLayout", [card.id, card.layout]))
                .then(function (response) {})
                .catch(function (error) {});
        }

        return {
            state,
            saveCardName,
            saveCardLayout,
        };
    },
};
</script>
