<template>
    <app-layout></app-layout>

    <div
        v-if="state.showModal"
        class=" text-xl text-jost min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover p-1 md:p-10"
    >
        <div
            @click="closeModal"
            class="absolute bg-sky-900 opacity-95 inset-0 z-0"
        ></div>
        <div
            class="w-full p-1 relative mx-auto my-auto rounded shadow-lg bg-gray-800 opacity-80"
        >
            <div class="p-2 mt-2 text-center space-x-4 md:block">
                <button
                    @click="closeModal"
                    class="mb-2 md:mb-0 bg-teal-400 px-5 py-2 text-sm shadow-sm w-full text-blueGray-600 rounded-sm hover:shadow-lg hover:bg-amber-400"
                >
                    Close
                </button>
            </div>
            <div class="">
                <div class="justify-center flex flex-wrap bg p-1">
                    <CardBattleBig :card="state.firstCardModal">
                    </CardBattleBig>

                    <CardBattleBig :card="state.secondCardModal">
                    </CardBattleBig>
                </div>

                <div class="flex flex-wrap ">
                    <div class="w-1/2">
                        <button
                            @click="vote(state.firstCardModal)"
                            class="w-full bg-teal-300 hover:bg-teal-400 p-0 border-1 border-gray-500"
                        >
                            vote {{ state.firstCardModal.votes }}
                        </button>
                    </div>
                    <div class="w-1/2">
                        <button
                            @click="vote(state.secondCardModal)"
                            class="w-full bg-teal-300 hover:bg-teal-400 p-0 border-1 border-gray-500"
                        >
                            vote {{ state.secondCardModal.votes }}
                        </button>
                    </div>
                </div>

                <div class="p-2 mt-2 text-center space-x-4 md:block">
                    <button
                        @click="closeModal"
                        class="mb-2 md:mb-0 bg-teal-400 px-5 py-2 text-sm shadow-sm w-full text-blueGray-600 rounded-sm hover:shadow-lg hover:bg-amber-400"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Battle
    </h1>

    <div v-if="$page.props.auth.user.role == 'admin'" class="my-4">

        <button @click="nextRound" class="px-4 bg-emerald-400 py-2 hover:bg-teal-400 text-jost">
             Next round {{state.matches.length}}
        </button>
      
    </div>

    <div class="flex flex-wrap justify-center">
        <div v-for="match in state.matches" :key="match" class="">
            <div
                @click="showModal(match)"
                class="flex flex-wrap m-1 mb-0.5 md:m-2 bg-amber-100 p-1 md:p-2 border-1 border-gray-800 rounded-sm"
            >
                <div class="mx-0.5">
                    <CardBattle :card="match.firstCard"> </CardBattle>
                </div>

                <div class="mx-1">
                    <CardBattle :card="match.secondCard"> </CardBattle>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import CardBattle from "./CardBattle.vue";
import CardBattleBig from "./CardBattleBig.vue";
import CollectionBox from "./CollectionBox.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

import { Inertia } from "@inertiajs/inertia";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCard,
        CollectionBox,
        CardBattle,
        CardBattleBig,
    },
    props: {
        cards: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            showModal: false,
            cards: [],
            matches: [],
            qualified: [],
            
            firstCardModal: {},
            secondCardModal: {},
        });

        onMounted(() => {
            props.cards.forEach((element) => {
                let card = {
                    id: element.id,
                    name: element.name,
                    image: element.image,
                    votes: 0,
                };
                state.cards.push(card);
            });

            setMatches();
        });

        function setMatches() {

            state.matches = [];
            for (let i = 0; i < state.cards.length; i += 2) {
                let aux = i;

                let match = {
                    firstCard: state.cards[aux],
                    secondCard: state.cards[aux + 1],
                };

                state.matches.push(match);
            }

           // alert(state.matches.length);
        }

        function showModal(match) {
            state.showModal = true;

            state.firstCardModal = match.firstCard;
            state.secondCardModal = match.secondCard;
        }

        function closeModal() {
            state.showModal = false;
        }

        function vote(card){
            card.votes += 1;
        }

        function nextRound(){

            state.cards = [];

            for (let i = 0; i < state.matches.length; i++) {    
                
                console.log(state.matches[i].firstCard.votes + " vs " + state.matches[i].secondCard.votes);

                if( state.matches[i].firstCard.votes == state.matches[i].secondCard.votes){
                     state.cards.push(state.matches[i].firstCard);
                      state.cards.push(state.matches[i].secondCard);

                      
                     
                }

                else if( state.matches[i].firstCard.votes > state.matches[i].secondCard.votes){
                     state.cards.push(state.matches[i].firstCard);
                     
                } else {
                         state.cards.push(state.matches[i].secondCard);
                }               
            }
            
            state.matches = [];
            setMatches();
        }

        return {
            showModal,
            closeModal,
            state,
            setMatches,
            vote,
            nextRound,
        };
    },
};
</script>

<style>
/* 3D Cube */
.space3d {
    perspective: 2000px;
    width: 200px;
    height: 300px;
}

._3dbox {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transform: rotateX(-25deg) rotateY(30deg);
}

._3dface {
    position: absolute;
}

._3dface--top {
    width: 200px;
    height: 100px;
    transform: rotateX(90deg) translate3d(0, 70px, 50px);
}

._3dface--front {
    width: 200px;
    height: 300px;
    transform: translate3d(0, 0, 120px);
}

._3dface--left {
    width: 100px;
    height: 300px;

    transform: rotateY(-90deg) translate3d(70px, 0, 50px);
}
</style>
