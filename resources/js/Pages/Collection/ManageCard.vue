<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Collection: {{ collection.name }}
    </h1>

    <div class="my-4">
        <inertia-link
            :href="route('collections.index')"
            class="px-4 bg-orange-400 py-2 hover:bg-teal-400 text-jost mx-1"
        >
            Go back
        </inertia-link>
        <inertia-link
            :href="route('cards.create', collection.id)"
            class="px-4 bg-emerald-400 py-2 hover:bg-teal-400 text-jost mx-1"
        >
            Create new card
        </inertia-link>
    </div>

    <div class="flex flex-wrap justify-center">

       



        <div v-for="card in cards" :key="card.id" class="m-1">

             <inertia-link
            :href="route('cards.edit', card.id)"
           
        >
           
       



            <div
                class="w-36 mx-auto bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 p-2"
            >
                <div class="w-full text-right">
                    <span
                        class="bg-amber-200 rounded-sm px-2 text-sm text-lobster text-gray-700"
                        >card #{{ card.id }}</span
                    >
                </div>

                <div
                    v-bind:class="{
                        'bg-gradient-to-r from-gray-500 via-gray-400 to-gray-300':
                            card.rarity == null,
                        'bg-gradient-to-r from-red-500 via-red-400 to-red-300':
                            card.rarity == 5,
                        'bg-gradient-to-r from-sky-500 via-sky-400 to-sky-300':
                            card.rarity == 4,
                        'bg-gradient-to-r from-violet-500 via-violet-400 to-violet-300':
                            card.rarity == 3,
                        'bg-gradient-to-r from-teal-500 via-teal-400 to-teal-300':
                            card.rarity == 2,
                        ' bg-gradient-to-r from-yellow-500 via-yellow-400 to-yellow-300':
                            card.rarity == 1,
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
                    class="bg-gradient-to-r from-cyan-900 via-cyan-800 to-cyan-500 rounded-sm align-middle text-center p-1 w-full text-cyan-200 mt-2 text-xs"
                >
                    <p class="text-rye">{{ card.name }}</p>
                </div>

                <div class="text-cyan-200 mt-1 text-xs">
                    <img
                        :src="'/icons/coinCyan.svg'"
                        class="w-4 inline-block"
                    />
                    <p class="inline-block ml-1 text-lobster">
                        {{ card.cost }}
                    </p>
                </div>
            </div>
             </inertia-link>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import { reactive } from "vue";
import Swal from "sweetalert2";

import { Inertia } from "@inertiajs/inertia";

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
    },

    setup(props, { emit }) {
        const state = reactive({});

        function remove(id) {
            Swal.fire({
                title: "Desea eliminar el registro?",
                showDenyButton: true,
                confirmButtonText: `Si`,
                denyButtonText: `No`,

                confirmButtonColor: "#22C55E",
                showClass: { popup: "" },

                customClass: {
                    confirmButton: "order-2",
                    denyButton: "order-3",
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Inertia.delete(route("categories.destroy", id));

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
                }
            });
        }

        return {
            remove,
            state,
        };
    },
};
</script>
