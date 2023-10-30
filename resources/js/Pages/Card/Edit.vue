<template>
    <app-layout> </app-layout>
    <div class="max-w-4xl mx-auto mt-4 text-jost text-sm md:text-base">
        <div class="py-3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-300">
                <div
                    class="flex justify-between items-start p-5 rounded-t border-b"
                >
                    <h3
                        class="text-3xl font-semibold text-gray-900 lg:text-4xl"
                    >
                        Edit this card
                    </h3>
                </div>
            </div>

            <div class="mx-auto mt-0 bg-gray-50">
                <div class="py-3 mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-label for="name"
                                >Card name (max 20):
                            </jet-label>
                            <jet-input
                                id="other_position"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                            />
                            <jet-input-error
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-label for="name">Layout: </jet-label>
                            <jet-select
                                v-model="form.layout"
                                v-model:options="state.layouts"
                                :value="form.layout"
                                class="mt-1 block w-full"
                                required
                            />
                            <jet-input-error
                                :message="form.errors.layout"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-label for="name">Image: </jet-label>
                            <div
                                class="flex items-center justify-center w-full mt-1"
                            >
                                <label
                                    class="flex flex-col border-4 border-dashed w-full hover:bg-sky-200 hover:border-sky-300 group"
                                >
                                    <div
                                        class="flex items-center justify-center"
                                    >
                                        <img
                                            :src="'/icons/imageIcon.svg'"
                                            class="w-8 rounded px-0 mx-2"
                                        />

                                        <p
                                            class="lowercase text-sm text-gray-400 group-hover:text-gray-600 pt-1 tracking-wider inline-block"
                                        >
                                            (400px x 600px)
                                        </p>
                                    </div>
                                    <input
                                        type="file"
                                        class="hidden"
                                        @change="onFileSelected"
                                    />
                                </label>
                            </div>

                            <jet-input-error
                                :message="form.errors.layout"
                                class="mt-2"
                            />
                        </div>

                        <div class="w-full mb-4 px-2">
                            <jet-label for="criteria"
                                >Description text for your collection (max 200):
                            </jet-label>
                            <jet-text-area
                                v-model="form.text"
                                type="text"
                                class="mt-1 block w-full text-sm md:text-base"
                            />
                            <jet-input-error
                                :message="form.errors.criteria"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-center">
                        <card-big :card="state.card"> </card-big>
                    </div>

                    <div class="flex flex-wrap justify-center">
                        <p class="w-full">Top filters</p>

                        <button
                            @click="setFilter('top', 'none', state.card)"
                            class="inline-block align-middle w-10 m-1 bg-gray-100 border-1 border-gray-400"
                        ></button>

                        <img
                            v-for="filter in topFilters"
                            :key="filter"
                            @click="setFilter('top', filter, state.card)"
                            :src="'/filters/' + filter"
                            class="inline-block align-middle w-10 m-1 cursor-pointer border-1 border-gray-400"
                        />
                    </div>

                    <div class="flex flex-wrap justify-center">
                        <p class="w-full">Bottom filters</p>

                        <button
                            @click="setFilter('bottom', 'none', state.card)"
                            class="inline-block align-middle w-10 m-1 bg-gray-100 border-1 border-gray-400"
                        ></button>

                        <img
                            v-for="filter in bottomFilters"
                            :key="filter"
                            @click="setFilter('bottom', filter, state.card)"
                            :src="'/filters/' + filter"
                            class="inline-block align-middle w-10 m-1 cursor-pointer border-1 border-gray-400"
                        />
                    </div>

                    <!--
                    <div>
                        <img
                            :src="'/storage/' + form.currentImage"
                            class="z-0 border-white border-8"
                        />
                    </div>

                    -->

                    <div
                        v-if="form.image"
                        class="w-64 mx-auto bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 p-2"
                    >
                        <div class="w-full m-auto p-2 bg-red-400 rounded-t">
                            <img
                                class="inline-block align-middle w-10 m-1 cursor-pointer"
                                :src="'/icons/starHueso.svg'"
                            />
                            <p class="inline-block">here goes the rarity</p>
                            <img
                                class="inline-block align-middle w-10 m-1 cursor-pointer"
                                :src="'/icons/starHueso.svg'"
                            />
                        </div>

                        <div class="w-full m-auto p-2">
                            <div class="relative h-80">
                                <img
                                    :src="showImage(form.image)"
                                    class="z-0 absolute border-white border-8"
                                />
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-r from-cyan-900 via-cyan-800 to-cyan-500 rounded-sm align-middle text-center p-2 w-full text-cyan-200 mt-2"
                        >
                            <p class="text-rye">{{ form.name }}</p>
                        </div>

                        <div
                            class="align-middle text-center text-cyan-200 mt-1"
                        >
                            <img
                                :src="'/icons/coinCyan.svg'"
                                class="w-4 inline-block"
                            />
                            <p
                                class="inline-block ml-1 align-middle text-lobster"
                            >
                                0
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-center px-0 my-4 md:gap-8 gap-4 text-white text-lg"
                    >
                        <inertia-link
                            :href="route('collections.index')"
                            class="w-auto bg-orange-500 hover:bg-orange-600 rounded-sm shadow-xl px-4 py-2"
                        >
                            Go back
                        </inertia-link>

                        <button
                            @click="edit()"
                            class="w-auto bg-sky-500 hover:bg-sky-600 rounded-sm shadow-xl px-4 py-2 text-josefin"
                        >
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { reactive, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSelect from "@/Jetstream/Select";
import JetTextArea from "@/Jetstream/Textarea";
import Swal from "sweetalert2";
import { usePage } from "@inertiajs/inertia-vue3";
import CardBig from "../Card/CardBig.vue";

export default {
    name: "OperatorCreate",
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetSelect,
        JetTextArea,
        CardBig,
    },
    props: {
        card: {
            type: Object,
            default: null,
        },
        topFilters: {
            type: Array,
            default: null,
        },
        bottomFilters: {
            type: Array,
            default: null,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            card: props.card,
            layouts: {
                Vertical: "Vertical",
                Horizontal: "Horizontal",
            },
        });

        onMounted(() => {
            form.reset();
            form.name = props.card.name;
            form.layout = props.card.layout;
            form.text = props.card.text;
            form.currentImage = props.card.image;
            form.collection_id = props.card.collection_id;
            form.status = props.card.status;
        });

        const form = useForm({
            name: null,
            layout: null,
            text: null,
            currentImage: null,
            image: null,
            collection_id: props.collectionId,
            status: "created",
            _method: "PUT",
        });

        function edit() {
            form.post(route("cards.update", props.card.id), {
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

        function onFileSelected(event) {
            form.image = event.target.files[0];
        }

        function showImage(image) {
            return URL.createObjectURL(image);
        }

        async function setFilter(type, filter, card) {
            await axios
                .get(route("setFilter", [type, filter, card.id]))
                .then(function (response) {
                    if (type == "top") {
                        state.card.top_filter = filter;
                    } else {
                        state.card.bottom_filter = filter;
                    }

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
            edit,
            form,
            state,
            showImage,
            onFileSelected,
            setFilter,
        };
    },
};
</script>
