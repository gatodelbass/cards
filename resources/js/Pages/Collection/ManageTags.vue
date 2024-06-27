<template>
    <app-layout></app-layout>

    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Card: {{ card.name }}
    </h1>

    <div class="flex flex-nowrap justify-center my-2 w-1/3">
        <div class="w-2/6">
            <CardBasic :card="card"> </CardBasic>
        </div>
        <div class="w-4/6">
            <div>
                <span
                    @click="setCardTag(cardTag.tag.id)"
                    v-for="cardTag in state.cardTags"
                    :key="cardTag.id"
                    class="bg-teal-300 py-1 px-2 rounded-full my-2 mx-1 border-1 border-teal-400 text-lg cursor-pointer"
                    >{{ cardTag.tag.name }}</span
                >
            </div>
        </div>
    </div>

    <div class="flex flex-wrap justify-center"></div>

    <div class="flex flex-wrap justify-center my-4 max-w-2xl">
        <div class="w-10/12">
            <jet-input
                @keyup="filterTags"
                type="text"
                class="w-full mx-2"
                v-model="state.filter"
            />
        </div>

        <div class="w-2/12 mt-1">
            <button
                @click="addTag()"
                class="bg-sky-400 hover:bg-sky-500 px-2 py-1"
            >
                Create
            </button>
        </div>
    </div>

    <div class="flex flex-wrap justify-center">
        <span
            @click="setCardTag(tag.id)"
            v-for="tag in state.tags"
            :key="tag.id"
            class="bg-gray-200 py-1 px-2 rounded-full mx-1 border-1 border-gray-300 text-lg cursor-pointer"
            >{{ tag.name }}</span
        >
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
        card: {
            type: Object,
            default: {},
        },
        tags: {
            type: Object,
            default: {},
        },
        cardTags: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        onMounted(() => {
            state.tags = props.tags;
            state.cardTags = props.cardTags;
        });

        const state = reactive({
            filter: "",
        });

        function addCard() {
            form.get(route("addNewCard"), {
                onSuccess: (response) => {
                    state.cardName = "";
                    state.cardImage = "";
                },
                onError: () => {},
            });
        }

        async function setCardTag(tagId) {
            await axios
                .get(route("setCardTag", [props.card.id, tagId]))
                .then(function (response) {
                    state.cardTags = response.data.cardTags;
                })
                .catch(function (error) {});
        }

        return {
            state,
            addCard,
            setCardTag,
        };
    },
};
</script>
