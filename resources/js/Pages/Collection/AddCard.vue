<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Collection: {{ collection.name }}
    </h1>

    <div
        v-if="$page.props.auth.user.role == 'admin'"
        class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base"
    >
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="mx-auto mt-0 bg-gray-50">
                <div class="flex flex-wrap">
                    <div class="w-5/12">
                        <jet-input
                            type="text"
                            class="w-full mx-2"
                            v-model="form.cardName"
                        />
                    </div>

                    <div class="w-5/12">
                        <jet-input
                            type="text"
                            class="w-full mx-4"
                            v-model="form.cardImage"
                        />
                    </div>

                    <div class="w-2/12 mt-1">
                        <button
                            @click="addCard()"
                            class="bg-sky-400 hover:bg-sky-500 px-2 py-1"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap justify-center">
        <div v-for="card in state.cards" :key="card.id" class="m-1">
            <card-basic :card="card"> </card-basic>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionCard from "./CollectionCard.vue";
import JetInput from "@/Jetstream/Input.vue";
import CardBasic from "./CardBasic.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CollectionCard,
        JetInput,
        CardBasic,
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
        onMounted(() => {
            state.cards = props.cards;
        });

        const state = reactive({});

        const form = useForm({
            cardName: null,
            cardImage: null,
            collectionId: props.collection.id,
        });

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
            remove,
            state,
            addCard,
            form,
        };
    },
};
</script>
