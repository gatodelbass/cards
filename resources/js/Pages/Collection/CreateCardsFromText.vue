<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        admin collections {{ state.cards }}
    </h1>

    <div class="py-3 mx-auto sm:px-6 lg:px-8">
        <div class="mx-auto mt-0 bg-gray-50">
            <div class="py-3 mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap">
                    <div class="w-full mb-4 px-2">
                        <jet-label for="criteria"
                            >one card per line:
                        </jet-label>
                        <jet-text-area
                            v-model="state.text"
                            type="text"
                            class="mt-1 block w-full text-sm md:text-base"
                        />
                    </div>
                </div>

                <div
                    class="flex items-center justify-center px-0 my-2 md:gap-8 gap-4 text-white text-lg"
                >
                    <Link
                        :href="route('login.index')"
                        class="w-auto bg-orange-500 hover:bg-orange-600 rounded-sm shadow-xl px-4 py-2"
                    >
                        Go back
                    </Link>

                    <button
                        @click="read()"
                        class="w-auto bg-sky-500 hover:bg-sky-600 rounded-sm shadow-xl px-4 py-2 text-josefin"
                    >
                        Read
                    </button>
                    <button
                            @click="createCards()"
                            class="bg-sky-400 hover:bg-sky-500 px-2 py-1"
                        >
                            Create cards
                        </button>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-0 bg-gray-50">
            <div class="flex flex-wrap justify-center">
                <div v-for="card in state.cards" :key="card.id" class="m-1">
                    <CardCreateFromText :card="card"> </CardCreateFromText>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AdminCollectionCard from "../Collection/AdminCollectionCard.vue";
import JetTextArea from "@/Jetstream/Textarea.vue";
import CardCreateFromText from "./CardCreateFromText.vue";

import { reactive } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "CreateCardsFromText",
    components: {
        AppLayout,
        AdminCollectionCard,
        JetTextArea,
        CardCreateFromText,
    },
    props: {
        collection: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            text: "",
            cards: [],
        });

        const form = useForm({
            cardName: null,
            cardImage: null,
            collectionId: props.collection.id,
        });

        function read() {
            state.cards = [];
            var lines = state.text.split("\n");

            console.log(lines);

            for (var i = 0; i < lines.length; i++) {
                if (lines[i] != "" && lines[i] != null) {
                    let line = lines[i].split("|");

                    let card = {
                        name: line[0],
                        image: line[1],
                    };

                    state.cards.push(card);
                }
            }
        }

        function createCards(){

            alert("create");

            state.cards.forEach(element => {
                alert(element);
            });

        }

        function addCard() {
            form.get(route("addNewCard"), {
                onSuccess: (response) => {
                    state.cardName = "";
                    state.cardImage = "";
                },
                onError: () => {},
            });
        }

        return {
            read,
            state,
            addCard,
            form,
            createCards
        };
    },
};
</script>

<style></style>
