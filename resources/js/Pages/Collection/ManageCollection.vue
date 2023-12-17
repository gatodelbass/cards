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
        <Link
            :href="route('collections.index')"
            class="bg-orange-400 hover:bg-teal-400 rounded-sm shadow-xl px-4 py-2 text-jost m-1"
        >
            Go back
        </Link>
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
        <Link
            :href="route('previewAlbum', collection.id)"
            class="bg-emerald-400 hover:bg-emerald-500 rounded-sm shadow-xl px-4 py-2 text-jost m-1"
        >
            Preview album
        </Link>
    </div>

    <div class="flex flex-wrap justify-center">
        <div v-for="(card, index) in state.cards" :key="card.id" class="m-1">
            <CardSetRarity :card="card"> </CardSetRarity>

            <div
                class="w-44 mb-1 mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
            >
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
                    <img :src="'/icons/eraser.svg'" class="w-5 inline-block" />
                </div>
            </div>
        </div>
    </div>

    <div></div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import { onMounted, reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import CardSetRarity from "./CardSetRarity.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCard,
        CardSetRarity,
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
                    collection_id: element.collection_id,
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

        return {
            state,
            setRarity,
            clearRarity,
            submitCollection,

            form,
        };
    },
};
</script>
