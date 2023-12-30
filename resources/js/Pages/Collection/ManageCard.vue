<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Collection: {{ collection.name }}
    </h1>

    <div class="my-4">
        <Link
            :href="route('collections.index')"
            class="px-4 bg-orange-400 py-2 hover:bg-teal-400 text-jost mx-1"
        >
            Go back
        </Link>
    </div>

    <div class="flex flex-wrap justify-center text-jost">
        <button
            @click="changeAllLayout('center')"
            class="bg-yellow-200 py-0 px-2 h-10 mx-1"
        >
            Change all to
            <img
                :src="'/images/image-center.png'"
                class="w-6 inline-block p-0.5 border-2"
            />
        </button>

        <button
            @click="changeAllLayout('circle')"
            class="bg-yellow-200 py-0 px-2 h-10 mx-1"
        >
            Change all to
            <img
                :src="'/images/image-circle.png'"
                class="w-6 inline-block p-0.5 border-2"
            />
        </button>

        <button
            @click="changeAllLayout('horizontal')"
            class="bg-yellow-200 py-0 px-2 h-10 mx-1"
        >
            Change all to
            <img
                :src="'/images/image-horizontal.png'"
                class="w-6 inline-block p-0.5 border-2"
            />
        </button>

        <button
            @click="changeAllLayout('vertical')"
            class="bg-yellow-200 py-0 px-2 h-10 mx-1"
        >
            Change all to
            <img
                :src="'/images/image-vertical.png'"
                class="w-6 inline-block p-0.5 border-2"
            />
        </button>
    </div>

    <draggable :list="state.cards" @change="saveCardOrder(state.cards)">
        <template #item="{ element: card }">
            <div class="max-w-5xl mx-auto cursor-move">
                <div class="border-1 border-gray-600 bg-yellow-50">
                    <span>{{ card.order }}</span>
                    <img
                        class="w-24 h-24 object-contain rounded-sm inline-block mx-2"
                        alt="img"
                        :src="card.image"
                    />

                    <jet-input
                        @change="saveCardName(card)"
                        type="text"
                        class="mt-1 inline-block w-96 mx-1"
                        v-model="card.name"
                    />

                    <jet-input
                        @change="saveCardImage(card)"
                        type="text"
                        class="mt-1 inline-block w-96 mx-1"
                        v-model="card.image"
                    />

                    <img
                        @click="saveCardLayout(card, 'center')"
                        :src="'/images/image-center.png'"
                        class="w-6 inline-block p-0.5 border-2"
                        v-bind:class="{
                            'border-green-400': card.layout == 'center',
                        }"
                    />

                    <img
                        @click="saveCardLayout(card, 'circle')"
                        :src="'/images/image-circle.png'"
                        class="w-6 inline-block p-0.5 border-2"
                        v-bind:class="{
                            'border-green-400': card.layout == 'circle',
                        }"
                    />

                    <img
                        @click="saveCardLayout(card, 'horizontal')"
                        :src="'/images/image-horizontal.png'"
                        class="w-6 inline-block p-0.5 border-2"
                        v-bind:class="{
                            'border-green-400': card.layout == 'horizontal',
                        }"
                    />

                    <img
                        @click="saveCardLayout(card, 'vertical')"
                        :src="'/images/image-vertical.png'"
                        class="w-6 inline-block p-0.5 border-2"
                        v-bind:class="{
                            'border-green-400': card.layout == 'vertical',
                        }"
                    />
                </div>
            </div>
        </template>
    </draggable>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import { reactive, onMounted } from "vue";
import JetInput from "@/Jetstream/Input.vue";
import draggable from "vuedraggable";

import { useForm } from "@inertiajs/vue3";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCard,
        JetInput,
        draggable,
    },
    props: {
        cards: {
            type: Object,
            default: {},
        },
        collection: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            cards: [],
            layouts: {
                exchange: true,
                protected: true,
                pasted: false,
                currentPage: 1,
                totalPages: 0,
                star1: true,
                star2: true,
                star3: true,
                star4: true,
                star5: true,
            },
        });

        onMounted(() => {
            props.cards.forEach((element) => {
                let card = {
                    id: element.id,
                    collection_id: element.collection_id,
                    name: element.name,
                    image: element.image,
                    order: element.order,
                    layout: element.layout,
                };
                state.cards.push(card);
            });
        });

        const form = useForm({
            collection_id: props.collection.id,
            cards: null,
        });

        async function saveCardName(card) {
            await axios
                .get(route("saveCardName", [card.id, card.name]))
                .then(function (response) {
                    card = response.data.card;
                })
                .catch(function (error) {});
        }

        async function saveCardImage(card) {
            await axios
                .post(route("saveCardImage", card))
                .then(function (response) {
                    card = response.data.card;
                })
                .catch(function (error) {});
        }

        async function saveCardLayout(card, layout) {
            await axios
                .get(route("saveCardLayout", [card.id, layout]))
                .then(function (response) {
                    card.layout = layout;
                })
                .catch(function (error) {});
        }

        async function saveCardOrder() {
            form.cards = state.cards;
            form.post(route("saveCardOrder"), {});
        }

        async function changeAllLayout(layout) {
            await axios
                .get(route("changeAllLayout", [props.collection.id, layout]))
                .then(function (response) {
                    state.cards = response.data.cards;
                })
                .catch(function (error) {});
        }

        return {
            saveCardName,
            saveCardImage,
            saveCardLayout,
            state,
            saveCardOrder,
            changeAllLayout,
        };
    },
};
</script>
