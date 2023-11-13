<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Home
    </h1>

    <inertia-link
        v-if="hasIncomingExchanges"
        :href="route('incomingExchanges')"
    >
        <div
            class="mt-2 hover:bg-sky-900 text-jost bg-gray-900 py-2 text-base md:text-xl cursor-pointer text-teal-300 animate-bounce"
        >
            You have exchange offers! Click here to show them.
        </div>
    </inertia-link>

    <div class="w-full text-jost">
        <div
            class="container flex flex-wrap mx-auto text-blueGray-800 p-2 md:p-10 text-sm md:text-base justify-center"
        >
            <inertia-link :href="route('exploreCollections')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/compass.svg'" />
                    <p class="my-2">Explore collections</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('redeemBoxes')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/box2.svg'" />
                    <p class="my-2">Redeem boxes</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('redeemTickets')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/ticket3.svg'" />
                    <p class="my-2">Redeem tickets</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('exchangeBag')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/backpack.svg'" />
                    <p class="my-2">The exchange bag</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('playerCards')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/cards.svg'" />
                    <p class="my-2">My cards</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('albumIndex')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/book2.svg'" />
                    <p class="my-2">Album</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('incomingExchanges')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 relative"
                >
                    <img class="w-10 mx-auto" :src="'/icons/in.svg'" />
                    <p class="my-2">Incoming exchanges</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('outgoingExchanges')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/out.svg'" />
                    <p class="my-2">Outgoing exchanges</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('playerProfile')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/profile.svg'" />
                    <p class="my-2">My profile</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('redeemGold')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/coin3.svg'" />
                    <p class="my-2">Buy tickets</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('players')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/shades.svg'" />
                    <p class="my-2">All players</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('help')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/help.svg'" />
                    <p class="my-2">Help</p>
                </div>
            </inertia-link>

            <inertia-link :href="route('collections.index')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/collection.svg'" />
                    <p class="my-2">My collections</p>
                </div>
            </inertia-link>
            {{ state.userData }}
            <inertia-link
                v-if="$page.props.auth.user.role == 'admin'"
                :href="route('adminIndex')"
            >
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/safe.svg'" />
                    <p class="my-2">Admin</p>
                </div>
            </inertia-link>
            AJAJAJ
            {{ $page.props.auth.user }}

            <div class="flex flex-nowrap bg-gray-200">
         

                <div
                class="w-44 h-72 my-2 mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
            >
                <div class="rounded-sm">
                    <div class="flex my-1">
                        <div class="w-3/10 mx-1">
                            <img
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2018/96/iconmonstr-soccer-1.png"
                                class="w-6 inline-block bg-yellow-200 p-0.5 rounded-full border-1 border-gray-100"
                            />
                            &nbsp;
                        </div>

                        <div class="w-3/10 mx-1">
                            <img
                                :src="'/images/image-center.png'"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2017/240/iconmonstr-shape-1.png"
                                class="w-6 inline-block p-0.5"
                            />
                        </div>

                        <div class="w-4/10 mx-auto text-right">
                            <span
                                class="rounded-sm px-1 text-yellow-200 bg-gray-800 "
                                ># <span class="font-semibold">20</span> -
                                32</span
                            >
                        </div>
                    </div>
                    <div
                        class="flex my-1 py-0.5 text-center items-center justify-center border-1 border-gray-400 mx-1 text-base bg-gradient-to-r from-gray-900 via-gray-500 to-gray-900"
                    >
                        ⭐
                    </div>
                    <div
                        class="relative p-1 h-40 bg-gradient-to-br from-gray-900 via-gray-700 to-gray-900 rounded-sm m-1 border-1 border-gray-400"
                    >
                        <img
                            class="max-h-full min-h-full object-contain mx-auto rounded-sm"
                            alt="img"
                            src="https://media.sweetwater.com/api/i/q-82__h-750__f-webp__ha-a802ae5ba9ef002c__hmac-b5aaf84493a804d14d1665b8292e30e1cb121275/images/guitars/BTB1936SFL/211P01230802253/211P01230802253-front-large.jpg.auto.webp"
                        />
                        <p
                            v-if="true"
                            class="z-10 absolute bottom-1 left-1 bg-yellow-200 text-gray-700 md:font-semibold px-1 rounded-sm truncate ... mx-auto"
                        >
                            $4000
                        </p>
                    </div>
                    <div
                        class="flex my-1 text-center items-center justify-center border-1 border-gray-400 mx-1 text-yellow-200"
                    >
                        <p class="px-1 py-0.5 truncate ...">Kanon</p>
                    </div>

                    <div class="flex mb-1">
                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-rose-400">
                                ATK: 5600
                            </p>
                        </div>

                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-emerald-400">
                                DEF: 5600
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div
                class="w-44 h-72 my-2 mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
            >
                <div class="rounded-sm">
                    <div class="flex my-1">
                        <div class="w-3/10 mx-1">
                            <img
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2018/96/iconmonstr-soccer-1.png"
                                class="w-6 inline-block bg-yellow-200 p-0.5 rounded-full border-1 border-gray-100"
                            />
                            &nbsp;
                        </div>

                        <div class="w-3/10 mx-1">
                            <img
                                :src="'/images/image-center.png'"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2017/240/iconmonstr-shape-1.png"
                                class="w-6 inline-block p-0.5"
                            />
                        </div>

                        <div class="w-4/10 mx-auto text-right">
                            <span
                                class="rounded-sm px-1 text-yellow-200 bg-gray-800 "
                                ># <span class="font-semibold">20</span> -
                                32</span
                            >
                        </div>
                    </div>
                    <div
                        class="flex my-1 py-0.5 text-center items-center justify-center border-1 border-gray-400 mx-1 text-base bg-gradient-to-r from-gray-900 via-gray-500 to-gray-900"
                    >
                        ⭐
                    </div>
                    <div
                        class="relative p-1 h-40 bg-gradient-to-br from-gray-900 via-gray-700 to-gray-900 rounded-xs m-1 border-1 border-gray-400"
                    >
                        <img
                        class="max-h-full min-h-full object-contain mx-auto rounded-sm"
                            alt="img"
                            src="https://media.sweetwater.com/api/i/q-82__h-750__f-webp__ha-3f583441c2517975__hmac-67701e75579aefbc41195948e6d541bb7742aa47/images/guitars/JBassAUVMAP/US23068178/US23068178-front-large.jpg.auto.webp"
                        />
                        <p
                            v-if="true"
                            class="z-10 absolute bottom-1 left-1 bg-yellow-200 text-gray-700 md:font-semibold px-1 rounded-sm truncate ... mx-auto"
                        >
                            $4000
                        </p>
                    </div>
                    <div
                        class="flex my-1 text-center items-center justify-center border-1 border-gray-400 mx-1 text-yellow-200"
                    >
                        <p class="px-1 py-0.5 truncate ...">Kanon</p>
                    </div>

                    <div class="flex mb-1">
                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-rose-400">
                                ATK: 5600
                            </p>
                        </div>

                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-emerald-400">
                                DEF: 5600
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-44 h-72 my-2 mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
            >
                <div class="rounded-sm">
                    <div class="flex my-1">
                        <div class="w-3/10 mx-1">
                            <img
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2018/96/iconmonstr-soccer-1.png"
                                class="w-6 inline-block bg-yellow-200 p-0.5 rounded-full border-1 border-gray-100"
                            />
                            &nbsp;
                        </div>

                        <div class="w-3/10 mx-1">
                            <img
                                :src="'/images/image-center.png'"
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2017/240/iconmonstr-shape-1.png"
                                class="w-6 inline-block p-0.5"
                            />
                        </div>

                        <div class="w-4/10 mx-auto text-right">
                            <span
                                class="rounded-sm px-1 text-yellow-200 bg-gray-800 "
                                ># <span class="font-semibold">20</span> -
                                32</span
                            >
                        </div>
                    </div>
                    <div
                        class="flex my-1 py-0.5 text-center items-center justify-center border-1 border-gray-400 mx-1 text-base bg-gradient-to-r from-gray-900 via-gray-500 to-gray-900"
                    >
                        ⭐
                    </div>
                    <div
                        class="relative p-1 h-40 bg-gradient-to-br from-gray-900 via-gray-700 to-gray-900 rounded-sm m-1 border-1 border-gray-400"
                    >
                        <img
                            class="max-h-full min-h-full object-contain mx-auto rounded-sm"
                            alt="img"
                            src="https://i.pinimg.com/564x/72/35/81/7235814972a21a0ca4516aa7b0ca754a.jpg"
                        />
                        <p
                            v-if="true"
                            class="z-10 absolute bottom-1 left-1 bg-yellow-200 text-gray-700 md:font-semibold px-1 rounded-sm truncate ... mx-auto"
                        >
                            $4000
                        </p>
                    </div>
                    <div
                        class="flex my-1 text-center items-center justify-center border-1 border-gray-400 mx-1 text-yellow-200"
                    >
                        <p class="px-1 py-0.5 truncate ...">Kanon</p>
                    </div>

                    <div class="flex mb-1">
                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-rose-400">
                                ATK: 5600
                            </p>
                        </div>

                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-emerald-400">
                                DEF: 5600
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="w-44 h-72 my-2 mx-2 border-1 border-gray-300 rounded-sm p-0.5 bg-gray-800 shadow text-sm"
            >
                <div class="rounded-sm">
                    <div class="flex my-1">
                        <div class="w-3/10 mx-1">
                            <img
                                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2018/96/iconmonstr-soccer-1.png"
                                class="w-6 inline-block bg-yellow-200 p-0.5 rounded-full border-1 border-gray-100"
                            />
                            &nbsp;
                        </div>

                        <div class="w-3/10 mx-1">
                            <img
                                :src="'/images/image-vertical.png'"                               
                                class="w-6 inline-block p-0.5"
                            />
                        </div>

                        <div class="w-4/10 mx-auto text-right">
                            <span
                                class="rounded-sm px-1 text-yellow-200 bg-gray-800 "
                                ># <span class="font-semibold">20</span> -
                                32</span
                            >
                        </div>
                    </div>
                    <div
                        class="flex my-1 py-0.5 text-center items-center justify-center border-1 border-gray-400 mx-1 text-base bg-gradient-to-r from-gray-900 via-gray-500 to-gray-900"
                    >
                        ⭐
                    </div>
                    <div
                        class="relative p-1 h-40 bg-gradient-to-br from-gray-900 via-gray-700 to-gray-900 rounded-sm m-1 border-1 border-gray-400"
                    >
                        <img
                            class="max-h-full min-h-full object-contain mx-auto rounded-sm"
                            alt="img"
                            src="https://media.sweetwater.com/api/i/q-82__h-750__f-webp__ha-a00f92cdfe9d53a1__hmac-5d219a6a15154535f30cfed505e3911e0227f1bc/images/closeup/750-LB208SMNS_front.jpg.auto.webp"
                        />
                        <p
                            v-if="true"
                            class="z-10 absolute bottom-1 left-1 bg-yellow-200 text-gray-700 md:font-semibold px-1 rounded-sm truncate ... mx-auto"
                        >
                            $4000
                        </p>
                    </div>
                    <div
                        class="flex my-1 text-center items-center justify-center border-1 border-gray-400 mx-1 text-yellow-200"
                    >
                        <p class="px-1 py-0.5 truncate ...">Kanon</p>
                    </div>

                    <div class="flex mb-1">
                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-rose-400">
                                ATK: 5600
                            </p>
                        </div>

                        <div class="w-1/2 text-center">
                            <p class="px-1 font-semibold text-emerald-400">
                                DEF: 5600
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from '@inertiajs/vue3'

export default {
    name: "LoginIndex",

    components: { AppLayout },

    props: {
        hasIncomingExchanges: {
            type: Boolean,
        },
    },

    setup(props, { emit }) {
        const page = usePage();
        const state = reactive({
            userData:  page.props.auth.user,
        });

        onMounted(() => {
           
        });

        return {
            state,
        };
    },
};
</script>
