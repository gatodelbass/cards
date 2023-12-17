<template>
    <app-layout></app-layout> <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Outgoing exchanges
    </h1>

    <div class="flex flex-wrap justify-center bg-amber-100">

        <div
            v-for="trade in state.outgoingExchanges"
            :key="trade.id"
            
        >

            <div v-if="trade.status == 'offered'" class="flex flex-wrap m-1 md:m-2 bg-gray-600 p-0.5 md:p-2 border-1 border-gray-800 rounded-sm">
                  <card-small :card="trade.ownercard.card" :exists="true">
            </card-small>

            <div class="align-top inline-block pt-16">
               

                <button @click="rejectExchange(trade)" class="block">
                    <img
                        class="w-7 md:w-8 rounded-sm bg-red-400 hover:bg-red-500 p-2 m-1 border-1 border-red-600"
                        :src="'/icons/cross.svg'"
                    />
                </button>
            </div>

            <card-small :card="trade.playercard.card" :exists="true">
            </card-small>
            </div>

            <div v-else class="flex flex-wrap   p-4 md:p-2  rounded-sm w-60 h-60 md:w-80 md:h-80 justify-center ">
                <div class=" my-auto text-lobster text-xl -rotate-12 justify-center bg-emerald-300 p-4">Exchange accepted!

                   
                </div>
            </div>
          
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";

import CardSmall from "../Card/CardSmall.vue";
import Button from "../../Jetstream/Button.vue";
import Swal from "sweetalert2";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardSmall,
    },

    props: {
        outgoingExchanges: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            outgoingExchanges: props.outgoingExchanges,
           
        });

        onMounted(() => {
            //state.bagCards = props.bagCards;
        });      



         async function rejectExchange(trade) {
            await axios
                .get(route("rejectExchange", trade.id))
                .then(function (response) {

                    state.outgoingExchanges = response.data.outgoingExchanges;
                     Swal.fire({
                        toast: true,
                        title: '<p class="text-2xl text-gray-900 text-jost">Rejected!</p>',
                        showClass: { popup: "" },
                        position: "top-end",
                        showConfirmButton: false,
                        icon: "success",
                        background: "#6EE7B7",
                        timer: 1500,
                    });
                    
                })
                .catch(function (error) {});
        }

       


        return {
            state,            
            rejectExchange,         
        };
    },
};
</script>
