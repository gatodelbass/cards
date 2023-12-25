<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-2xl leading-tight font-semibold tracking-wide text-gray-400"
                >
                    <span class="text-lightBlue-500">OPERARIOS</span>
                    |
                    <span
                        class="font-semibold text-orange-500 px-2 py-1 rounded-sm"
                        >{{ client.name }}</span
                    >
                </h2>
            </div>
        </template>
        <div class="max-w-4xl mx-auto mt-4 border-1">
            <div class="py-3 mx-auto sm:px-6 lg:px-8">
                <div class="bg-emerald-300">
                    <div
                        class="flex justify-between items-start p-5 rounded-t border-b"
                    >
                        <h3
                            class="text-3xl font-semibold text-gray-900 lg:text-4xl"
                        >
                            Crear nuevo operario
                        </h3>
                    </div>
                </div>

                <div class="mx-auto mt-0 bg-white text-jost text-base">
                    <div class="py-3 mx-auto sm:px-6 lg:px-8">
                        <div class="flex justify-center py-4">
                            <div
                                class="flex bg-lightBlue-500 rounded-full md:p-4 p-2 border-1 border-gray-300"
                            >
                                <img
                                    :src="'/icons/workerWhiteIcon.svg'"
                                    class="w-10"
                                />
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full md:w-1/3 mb-4 px-2">
                                <jet-label for="name">Nombre: </jet-label>
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
                                <jet-label for="name">Cedula: </jet-label>
                                <jet-input
                                    id="other_position"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.document"
                                />
                                <jet-input-error
                                    :message="form.errors.document"
                                    class="mt-2"
                                />
                            </div>

                            <div class="w-full md:w-1/3 mb-4 px-2">
                                <jet-label for="phone">Teléfono:</jet-label>
                                <jet-input
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                />
                                <jet-input-error
                                    :message="form.errors.phone"
                                    class="mt-2"
                                />
                            </div>

                            <div class="w-full md:w-1/3 mb-4 px-2">
                                <jet-label for="email">Email:</jet-label>
                                <jet-input
                                    id="email"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                />
                                <jet-input-error
                                    :message="form.errors.email"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        <div class="flex flex-wrap">
                            <label
                                class="inline-flex items-center m-2 px-2 py-1"
                            >
                                <input
                                    v-model="form.position"
                                    type="checkbox"
                                    value="Alistador"
                                    class="rounded-sm form-checkbox h-6 w-6 text-orange-500"
                                /><span class="ml-2 font-semibold text-gray-700"
                                    >Alistador</span
                                >
                            </label>

                            <label
                                class="inline-flex items-center m-2 px-2 py-1"
                            >
                                <input
                                    v-model="form.position"
                                    type="checkbox"
                                    value="Cabinero"
                                    class="rounded-sm form-checkbox h-6 w-6 text-orange-500"
                                /><span class="ml-2 font-semibold text-gray-700"
                                    >Cabinero</span
                                >
                            </label>

                            <label
                                class="inline-flex items-center m-2 px-2 py-1"
                            >
                                <input
                                    v-model="form.position"
                                    type="checkbox"
                                    value="Colorista"
                                    class="rounded-sm form-checkbox h-6 w-6 text-orange-500"
                                /><span class="ml-2 font-semibold text-gray-700"
                                    >Colorista</span
                                >
                            </label>

                            <label
                                class="inline-flex items-center m-2 px-2 py-1"
                            >
                                <input
                                    v-model="form.position"
                                    type="checkbox"
                                    value="Brillador"
                                    class="rounded-sm form-checkbox h-6 w-6 text-orange-500"
                                /><span class="ml-2 font-semibold text-gray-700"
                                    >Brillador</span
                                >
                            </label>
                            <div class="w-full md:w-1/3 mb-4 px-2">
                            <jet-input-error
                                    :message="form.errors.position"
                                    class="mt-2"
                                />
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-center px-0 my-4 md:gap-8 gap-4 text-white text-lg"
                        >
                            <Link
                                :href="route('operators.index', client.id)"
                                class="w-auto bg-orange-500 hover:bg-orange-600 rounded-sm shadow-xl px-4 py-2"
                            >
                                Cancelar
                            </Link>

                            <button
                                @click="save()"
                                class="w-auto bg-lightBlue-500 hover:bg-lightBlue-600 rounded-sm shadow-xl px-4 py-2 text-josefin"
                            >
                                Crear operario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";


import Swal from "sweetalert2";

export default {
    name: "OperatorCreate",
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        
        
    },
    props: {
        client: {
            type: Object,
            default: null,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            selectedFile: null,
            positions: {
                "Jefe de taller": "Jefe de taller",
                "Gerente comercial": "Gerente comercial",
                "Coordinador de calidad": "Coordinador de calidad",
                "Coordinador de taller": "Coordinador de taller",
            },
        });

        const form = useForm({
            client_id: props.client.id,
            name: null,
            document: null,
            position: [],
            phone: null,
            email: null,
            alistador: false,
            cabinero: false,
            colorista: false,
            brillador: false,
            status: "activo",
        });

        function save() {
            form.post(route("operators.store"), {
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

        return {
            save,
            form,
            state,
        };
    },
};
</script>
