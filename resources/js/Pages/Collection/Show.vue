<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-2xl leading-tight text-lightBlue-500 font-semibold"
                >
                    DETALLE DEL OPERARIO
                </h2>
            </div>
        </template>

        <div class="max-w-4xl mx-auto mt-10 bg-white border-1">
            <div class="py-3 mx-auto sm:px-6 lg:px-8">
                <div v-if="record.image" class="flex justify-center mt-4">
                    <img
                        :src="'../storage/' + record.image"
                        class="w-32 rounded-full shadow-sm"
                    />
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/3 mb-4 px-4">
                        <jet-label for="name">Nombre: </jet-label>
                        <span
                            class="mt-1 block w-full border-b-2 border-lightBlue-500"
                            >{{ record.name }}</span
                        >
                    </div>

                    <div class="w-full md:w-1/3 mb-4 px-4">
                        <jet-label for="name">Cedula: </jet-label>
                        <span
                            class="mt-1 block w-full border-b-2 border-lightBlue-500"
                            >{{ record.document }}</span
                        >
                    </div>

                    <div class="w-full md:w-1/3 mb-4 px-4">
                        <jet-label for="name">Cargo: </jet-label>
                        <span
                            class="mt-1 block w-full border-b-2 border-lightBlue-500"
                            >{{ record.position }}</span
                        >
                    </div>

                    <div class="w-full md:w-1/3 mb-4 px-4">
                        <jet-label for="phone">Teléfono: </jet-label>
                        <span
                            class="mt-1 block w-full border-b-2 border-lightBlue-500"
                            >{{ record.phone }}</span
                        >
                    </div>

                    <div class="w-full md:w-1/3 mb-4 px-4">
                        <jet-label for="email">Email: </jet-label>
                        <span
                            class="mt-1 block w-full border-b-2 border-lightBlue-500"
                            >{{ record.email }}</span
                        >
                    </div>

                    <div class="w-full md:w-1/3 mb-4 px-4">
                        <jet-label for="name">Estado: </jet-label>
                        <span
                            class="mt-1 block w-full border-b-2 border-lightBlue-500"
                            >{{ record.status }}</span
                        >
                    </div>
                </div>
            </div>
            <div
                class="flex items-center justify-center px-0 md:gap-8 gap-4 text-white text-lg"
            >
                <a
                    :href="route('operators.index', record.client_id)"
                    class="w-auto bg-orange-500 hover:bg-orange-600 rounded-sm shadow-xl font-medium px-4 py-2 mb-8"
                    >Volver a operarios</a
                >
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";


import { reactive } from "vue";
export default {
    name: "OperatorShow",
    components: {
        AppLayout,
        JetInput,
        JetLabel,
        
    },
    props: {
        record: {
            type: Object,
            default: {},
        },
        userPermissions: {
            type: Array,
            default: [],
        },
    },

    setup(props, { emit }) {
        const state = reactive({});

        function can(permission) {
            if (props.userPermissions.includes(permission)) {
                return true;
            } else {
                return true;
            }
        }

        return {
            state,
            can,
        };
    },
};
</script>
