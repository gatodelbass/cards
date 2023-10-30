<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        My avatars
    </h1>
    <div class="justify-center flex flex-wrap px-5 m-2 text-sm md:text-base">
        <div v-for="userAvatar in userAvatars" :key="userAvatar.id">
            <div v-if="userAvatar.status == 'obtained'" class="p-1">
                <div v-if="$page.props.auth.user.avatar == userAvatar.avatar.image">
                    <img
                        @click="selectAvatar(userAvatar)"
                        :src="'/storage/' + userAvatar.avatar.image"
                        class="border-teal-400 border-b-4 md:border-b-8 md:border-l-8 w-40 rounded-full m-4"
                    />
                </div>

                <div v-else>
                    <img
                        @click="selectAvatar(userAvatar)"
                        :src="'/storage/' + userAvatar.avatar.image"
                        class="border-gray-300 border-b-4 md:border-b-8 md:border-l-8 w-40 rounded-full mx-4 cursor-pointer"
                    />

                    <img
                        @click="sellUserAvatar(userAvatar)"
                        class="w-6 md:w-10 inline-block mx-1 cursor-pointer"
                        :src="'/icons/banknote.svg'"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted } from "vue";
import Swal from "sweetalert2";

import { usePage } from "@inertiajs/inertia-vue3";

import CardSmall from "../Card/CardSmall.vue";
import Button from "../../Jetstream/Button.vue";

export default {
    name: "OperatorIndex",
    components: {
        AppLayout,
        CardSmall,
        Button,
    },

    props: {
        userAvatars: {
            type: Object,
            default: {},
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            userAvatars: {},
            filters: {
                obtained: true,
                exchange: true,
                protected: true,
                pasted: false,
            },
        });

        onMounted(() => {
            state.userAvatars = props.userAvatars;
        });

        async function selectAvatar(userAvatar) {
            await axios
                .get(route("selectAvatar", userAvatar.id))
                .then(function (response) {
                    usePage().props.auth.user.avatar = response.data.avatar;

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-gray-300">Done!</p>',
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

        async function sellUserAvatar(userAvatar) {
            await axios
                .get(route("sellUserAvatar", userAvatar.id))
                .then(function (response) {
                    usePage().props.auth.user.gold =
                        usePage().props.auth.user.gold +
                        response.data.goldObtained;

                    userAvatar.status = "sold";

                    Swal.fire({
                        toast: true,
                        title: '<p class="text-xl text-gray-300">Done!</p>',
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
            selectAvatar,
            sellUserAvatar,
            state,
        };
    },
};
</script>
