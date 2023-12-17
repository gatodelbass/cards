<template>
    <div
        v-if="collection.status == 'submitted'"
        class="w-full md:w-1/2 rounded shadow-md flex m-4 p-2 text-jost text-sm md:text-base text-gray-300 bg-gray-900"
    >
        <div class="w-1/3">
            <div class="border-4 border-white">
                <img
                    class="border-gray-900 border-4"
                    :src="'/storage/' + collection.cover_card"
                    alt="image"
                />
            </div>
        </div>

        <div
            class="px-6 py-2 w-2/3 bg-gradient-to-tl from-black via-gray-800 to-gray-700 ml-4 rounded"
        >
            <h4 class="my-1 font-semibold">{{ collection.name }}</h4>
            <p class="text-justify text-emerald-300">
                <img
                    :src="'/icons/' + collection.category.icon"
                    class="w-6 inline-block m-1 bg-white p-0.5 rounded-full"
                />
                {{ collection.category.name }}
            </p>
            <p class="text-justify">
                Number of cards: {{ collection.cards.length }}
            </p>

            <Link :href="route('previewAlbum', collection.id)">
                <button
                    class="px-4 py-1 my-1 shadow w-full bg-emerald-200 text-gray-700 hover:bg-emerald-300"
                >
                    Preview
                </button>
            </Link>

            <div class="flex">
                <div class="w-1/3 mx-1">
                    <button
                        @click="activateCollection"
                        class="px-4 py-1 my-1 shadow w-full bg-emerald-200 text-gray-700 hover:bg-emerald-300"
                    >
                        Activate
                    </button>
                </div>

                <div class="w-1/3 mx-1">                    
                        <button
                         v-if="
                            collection.errors != null && collection.errors != ''
                        "
                        @click="errorsCollection"
                            class="px-4 py-1 my-1 shadow w-full bg-orange-200 text-gray-700 hover:bg-orange-300"
                        >
                            Errors
                        </button>
                   
                </div>

                <div class="w-1/3 mx-1">
                   <button
                        @click="rejectCollection"
                        class="px-4 py-1 my-1 shadow w-full bg-red-200 text-gray-700 hover:bg-red-300"
                    >
                        Reject
                    </button>
                </div>
            </div>

            <div class="w-full text-left">
                <jet-label for="criteria">Errors: </jet-label>
                <jet-text-area
                    v-model="collection.errors"
                    type="text"
                    class="mt-1 block w-full text-sm md:text-base text-gray-800"
                />
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetTextArea from "@/Jetstream/Textarea.vue";
import { reactive } from "vue";

export default {
    name: "CollectionCard",
    components: {
        AppLayout,
        JetTextArea,
    },
    props: {
        collection: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            errors: "",
        });

        async function activateCollection() {
            await axios
                .get(route("activateCollection", props.collection.id))
                .then(function (response) {
                    props.collection.status = "errors";

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

        async function errorsCollection() {
            await axios
                .get(
                    route("errorsCollection", 
                        props.collection.id), {
                    params: { errors: props.collection.errors },
                }
                )
                .then(function (response) {
                    props.collection.status = "created";

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

        async function rejectCollection() {
            await axios
                .get(route("activateCollection", props.collection.id))
                .then(function (response) {
                    props.collection.status = "errors";

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
            activateCollection,
            errorsCollection,
            rejectCollection,
        };
    },
};
</script>
