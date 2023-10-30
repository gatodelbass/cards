<template>
    <app-layout></app-layout>

    <div
        v-for="n in state.takenRarity[5]"
        :key="n"
        class="w-10 h-8 bg-gray-100 inline-block m-0.5 p-1 rounded-sm border-1 border-gray-300"
    >
        5★
    </div>

    <div
        v-for="n in state.availableRarity[5]"
        :key="n"
        class="w-10 h-8 bg-red-400 inline-block m-0.5 p-1 rounded-sm border-1 border-red-500"
    >
        5★
    </div>

    <div
        v-for="n in state.takenRarity[4]"
        :key="n"
        class="w-10 h-8 bg-gray-100 inline-block m-0.5 p-1 rounded-sm border-1 border-gray-300"
    >
        4★
    </div>

    <div
        v-for="n in state.availableRarity[4]"
        :key="n"
        class="w-10 h-8 bg-sky-400 inline-block m-0.5 p-1 rounded-sm border-1 border-sky-500"
    >
        4★
    </div>

    <div
        v-for="n in state.takenRarity[3]"
        :key="n"
        class="w-10 h-8 bg-gray-100 inline-block m-0.5 p-1 rounded-sm border-1 border-gray-300"
    >
        3★
    </div>

    <div
        v-for="n in state.availableRarity[3]"
        :key="n"
        class="w-10 h-8 bg-violet-400 inline-block m-0.5 p-1 rounded-sm border-1 border-violet-500"
    >
        3★
    </div>

    <div
        v-for="n in state.takenRarity[2]"
        :key="n"
        class="w-10 h-8 bg-gray-100 inline-block m-0.5 p-1 rounded-sm border-1 border-gray-300"
    >
        2★
    </div>

    <div
        v-for="n in state.availableRarity[2]"
        :key="n"
        class="w-10 h-8 bg-teal-400 inline-block m-0.5 p-1 rounded-sm border-1 border-teal-500"
    >
        2★
    </div>

    <div
        v-for="n in state.takenRarity[1]"
        :key="n"
        class="w-10 h-8 bg-gray-100 inline-block m-0.5 p-1 rounded-sm border-1 border-gray-300"
    >
        1★
    </div>

    <div
        v-for="n in state.availableRarity[1]"
        :key="n"
        class="w-10 h-8 bg-yellow-400 inline-block m-0.5 p-1 rounded-sm border-1 border-yellow-500"
    >
        1★
    </div>

    <div class="my-4 text-base">
        <inertia-link
            :href="route('collections.index')"
            class="bg-orange-400 hover:bg-teal-400 rounded-sm shadow-xl px-4 py-2 text-jost m-1"
        >
            Go back
        </inertia-link>
        <button
            v-if="
                collection.status == 'created' &&
                state.availableRarity[1] == 0 &&
                state.availableRarity[2] == 0 &&
                state.availableRarity[3] == 0 &&
                state.availableRarity[4] == 0 &&
                state.availableRarity[5] == 0
            "
            @click="submitCollection()"
            class="bg-emerald-400 hover:bg-emerald-500 rounded-sm shadow-xl px-4 py-2 text-jost m-1"
        >
            Submit collection
        </button>
        <inertia-link
            :href="route('previewAlbum', collection.id)"
            class="bg-emerald-400 hover:bg-emerald-500 rounded-sm shadow-xl px-4 py-2 text-jost m-1"
        >
            Preview album
        </inertia-link>
    </div>

    <div class="flex flex-wrap justify-center">
        <div v-for="(card, index) in state.cards" :key="card.id" class="m-1">
            <div
                class="w-36 mx-auto bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 p-2"
            >
                <div
                    v-bind:class="{
                        'bg-gray-600': card.rarity == null,
                        'bg-red-400': card.rarity == 5,
                        'bg-sky-400': card.rarity == 4,
                        'bg-violet-400': card.rarity == 3,
                        'bg-teal-400': card.rarity == 2,
                        'bg-yellow-400': card.rarity == 1,
                    }"
                    class="w-full m-auto p-1 rounded-t h-8"
                >
                    <span v-for="n in card.rarity" :key="n">
                        <img
                            class="inline-block align-middle w-4 m-0.5"
                            :src="'/icons/starHueso.svg'"
                        />
                    </span>
                </div>

                <div class="w-full m-auto p-2">
                    <div class="relative h-40">
                        <img
                            :src="'/storage/' + card.image"
                            class="z-0 absolute border-white border-4"
                        />
                    </div>
                </div>

                <div
                    class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 rounded-sm align-middle text-center p-1 w-full text-gray-200 mt-2 text-xs"
                >
                    <p class="text-rye">{{ card.name }}</p>
                </div>

                <div class="mt-1 flex flex-wrap text-sm justify-center">
                    <div
                        v-if="state.availableRarity[1] > 0"
                        @click="setRarity(index, 1)"
                        class="bg-yellow-400 inline-block m-0.5 px-1 py-1 rounded-sm cursor-pointer"
                    >
                        1★
                    </div>
                    <div
                        v-if="state.availableRarity[2] > 0"
                        @click="setRarity(index, 2)"
                        class="bg-teal-400 inline-block m-0.5 px-1 py-1 rounded-sm cursor-pointer"
                    >
                        2★
                    </div>
                    <div
                        v-if="state.availableRarity[3] > 0"
                        @click="setRarity(index, 3)"
                        class="bg-violet-400 inline-block m-0.5 px-1 py-1 rounded-sm cursor-pointer"
                    >
                        3★
                    </div>
                    <div
                        v-if="state.availableRarity[4] > 0"
                        @click="setRarity(index, 4)"
                        class="bg-sky-400 inline-block m-0.5 px-1 py-1 rounded-sm cursor-pointer"
                    >
                        4★
                    </div>
                    <div
                        v-if="state.availableRarity[5] > 0"
                        @click="setRarity(index, 5)"
                        class="bg-red-400 inline-block m-0.5 px-1 py-1 rounded-sm cursor-pointer"
                    >
                        5★
                    </div>
                    <div
                        v-if="card.rarity > 0"
                        @click="clearRarity(index)"
                        class="bg-white inline-block m-0.5 px-1 py-1 rounded-sm cursor-pointer"
                    >
                        <img
                            :src="'/icons/eraser.svg'"
                            class="w-5 inline-block"
                        />
                    </div>
                </div>

                <div
                    v-if="collection.cover_card == card.image"
                    @click="setCover(collection.id, card)"
                    class="mt-2 flex flex-wrap text-sm justify-center bg-teal-500 text-gray-800 text-jost border-1 border-teal-300 rounded-sm cursor-pointer"
                >
                    Current cover
                </div>

                <div
                    v-else
                    @click="setCover(collection.id, card)"
                    class="mt-2 flex flex-wrap text-sm justify-center text-teal-300 text-jost border-1 border-teal-300 rounded-sm cursor-pointer"
                >
                    Set as cover
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
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCard,
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
        rarity: {
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

        onMounted(() => {
            form.reset();

            state.takenRarity[1] = 0;
            state.takenRarity[2] = 0;
            state.takenRarity[3] = 0;
            state.takenRarity[4] = 0;
            state.takenRarity[5] = 0;

            state.availableRarity[1] = props.rarity.oneStars;
            state.availableRarity[2] = props.rarity.twoStars;
            state.availableRarity[3] = props.rarity.threeStars;
            state.availableRarity[4] = props.rarity.fourStars;
            state.availableRarity[5] = props.rarity.fiveStars;

            props.cards.forEach((element) => {
                let card = {
                    id: element.id,
                    name: element.name,
                    rarity: element.rarity == null ? null : element.rarity,

                    image: element.image,
                };
                state.cards.push(card);

                if (element.rarity > 0) {
                    state.availableRarity[element.rarity]--;
                    state.takenRarity[element.rarity]++;
                }
            });
        });

        const form = useForm({
            collection_id: props.collection.id,
            cards: null,
        });

        function submitCollection() {
            form.cards = state.cards;

            form.post(route("submitCollection"), {
                onSuccess: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Hecho</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#6EE7B7",
                        timer: 1500,
                    });
                },
                onError: () => {
                    Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Error</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "error",
                        background: "#F97316",
                        timer: 1500,
                    });
                },
            });
        }

        function setRarity(index, rarity) {
            if (state.cards[index].rarity > 0) {
                state.takenRarity[state.cards[index].rarity]--;
                state.availableRarity[state.cards[index].rarity]++;
            }

            state.cards[index].rarity = rarity;
            state.takenRarity[rarity]++;
            state.availableRarity[rarity]--;
        }

        function clearRarity(index) {
            if (state.cards[index].rarity > 0) {
                state.takenRarity[state.cards[index].rarity]--;
                state.availableRarity[state.cards[index].rarity]++;
            }

            state.cards[index].rarity = null;
        }

        async function setCover(collectionId, card) {
            await axios
                .get(route("setCover", [collectionId, card.id]))
                .then(function (response) {
                    props.collection.cover_card = card.image;

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-blueGray-300">Done!</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#334155",
                        timer: 1500,
                    });
                })
                .catch(function (error) {});
        }

        return {
            state,
            setRarity,
            clearRarity,
            submitCollection,
            setCover,
            form,
        };
    },
};
</script>
