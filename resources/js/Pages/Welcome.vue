<script></script>

<template>
    <body
        class="leading-normal tracking-normal text-indigo-400 m-0 bg-cover bg-fixed"
        style="background-image: url('images/header.png')"
    >
        <div class="h-full">
            <!--Nav-->
            <div class="w-full container mx-auto">
                <div class="w-full flex items-center justify-between pt-2">
                    <div class="w-1/2 my-4">
                        <span
                            class="flex items-center text-teal-400 font-semibold text-3xl lg:text-4xl mx-2"
                            href="#"
                        >
                            <img
                                class="h-16 w-16 object-cover object-center mx-2"
                                :src="'/images/cardsteal.png'"
                                alt="photo"
                            />

                            Cards by el gato
                        </span>
                    </div>

                    <div
                        class="flex w-1/2 justify-end text-sm md:text-base text-teal-400"
                    >
                        <Link :href="route('help')"
                            ><button
                                type="button"
                                class="hover:bg-cyan-900 py-1 px-2 flex rounded-full m-1"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                Help
                            </button></Link
                        >
                        <Link
                            v-if="$page.props.user == null"
                            :href="route('loginForm')"
                            ><button
                                type="button"
                                class="hover:bg-cyan-900 py-1 px-2 flex rounded-full m-1"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                Login
                            </button></Link
                        >
                        <Link
                            v-if="$page.props.user == null"
                            :href="route('registerForm')"
                            ><button
                                type="button"
                                class="hover:bg-cyan-900 py-1 px-2 flex rounded-full m-1"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                Register
                            </button></Link
                        >
                    </div>
                </div>
            </div>

            <!--Main-->
            <div
                class="container pt-10 md:pt-20 mx-auto flex flex-wrap flex-col md:flex-row items-center"
            >
                <!--Left Col-->
                <div
                    class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden"
                >
                    <h1
                        class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold text-center md:text-left"
                    >
                        Welcome to
                        <span class="text-teal-500"> Cards by el gato</span>, a
                        free card collector and trading game
                    </h1>
                    <p
                        class="leading-normal text-base md:text-2xl my-8 mx-4 text-center text-teal-300 md:text-left"
                    >
                        Here you can exchange your cards and collect from many
                        other collections. Or you can create and publish your
                        own collections too!
                    </p>

                    <Link :href="route('loginForm')">
                        <div class="m-4">
                            <div
                                class="bg-gradient-to-r from-gray-800 to-teal-500 p-4 rounded-l-full rounded-r-full"
                            >
                                <h2 class="text-xl text-teal-300">
                                    Login here if you already have an account
                                </h2>
                            </div>
                        </div>
                    </Link>

                    <Link :href="route('registerForm')">
                        <div class="m-4">
                            <div
                                class="bg-gradient-to-r from-gray-800 to-sky-500 p-4 rounded-l-full rounded-r-full"
                            >
                                <h2 class="text-xl text-teal-300">
                                    Register here if you are a new player
                                </h2>
                            </div>
                        </div>
                    </Link>
                </div>

                <!--Right Col-->
                <div
                    class="w-full xl:w-3/5 p-10 overflow-hidden flex flex-wrap justify-center"
                >
                    <div
                        v-for="card in randomCards"
                        :key="card.id"
                        class="transform -rotate-3"
                    >
                        <div
                            class="w-44 p-1 bg-gradient-to-r from-gray-900 to-gray-600 rounded transform rotate-0 m-5"
                        >
                            <span
                                class="bg-amber-200 rounded-sm px-2 py-0 mx-0 text-base text-lobster text-gray-700"
                                >card #{{ card.id }}</span
                            >
                            <div
                                class="bg-gradient-to-r from-cyan-900 via-cyan-700 to-cyan-500 rounded align-middle text-center p-1 w-full h-8 m-0 text-hueso-500"
                            >
                                <span v-for="n in card.rarity" :key="n">
                                    <img
                                        class="inline-block align-middle w-4 m-1"
                                        :src="'/icons/starHueso.svg'"
                                    />
                                </span>
                            </div>
                            <div
                                class="relative h-56 bg-lightBlue-300 mx-1 mt-2 mb-6"
                            >
                                <img
                                    :src="'/storage/' + card.image"
                                    class="z-0 absolute border-white border-4"
                                />
                            </div>
                            <div
                                class="bg-gradient-to-r from-cyan-900 via-cyan-700 to-cyan-500 rounded align-middle text-center p-2 w-full text-amber-100"
                            >
                                <b>{{ card.name }}</b>
                            </div>
                            <div class="align-middle text-center text-cyan-200">
                                <img
                                    :src="coinCyan"
                                    class="w-4 inline-block"
                                /><b class="inline-block ml-1 align-middle">{{
                                    card.cost
                                }}</b>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full justify-center p-5 lg:mt-5 rounded">
                    <p class="text-xl text-teal-300">
                        "Purchase" collections and add cards to complete pages.
                    </p>

                    <p class="text-xl text-pink-300">
                        Here some already created collections:
                    </p>

                    <div class="flex flex-wrap justify-center">
                        <div
                            v-for="collection in randomCollections"
                            :key="collection.id"
                        >
                            <collection-box :collection="collection">
                            </collection-box>
                            <span
                                class="text-jost rounded-r-full rounded-l-full bg-gray-800 text-teal-300 px-3 py-1"
                            >
                                Price - ${{ collection.cards.length * 1000 }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- <div class="w-full p-2 lg:w-1/4 md:w-1/2 mt-4">
                    <div
                        class="opacity-75 flex flex-col p-4 overflow-hidden rounded-xl shadow-lg duration-300 hover:shadow-2xl group hover:opacity-95 hover:border-1 hover:border-teal-500"
                    >
                        <div class="justify-center flex flex-wrap">
                            <div
                                class="px-4 py-4 bg-amber-100 hover:bg-teal-500 rounded-full"
                            >
                                <img
                                    class="w-10 mx-auto"
                                    :src="'/icons/cards.svg'"
                                />
                            </div>
                        </div>
                        <div class="justify-center flex flex-wrap">
                            <h1
                                class="text-3xl sm:text-4xl xl:text-5xl font-bold text-amber-100 mt-4 group-hover:text-teal-500"
                            >
                                {{ $page.props.totalUserCardsObtained }}
                            </h1>
                        </div>

                        <div class="justify-center flex flex-wrap">
                            <div
                                class="flex flex-row justify-between text-amber-100 group-hover:text-teal-500 text-lg"
                            >
                                <p>Total cards obtained by players</p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="w-full p-2 lg:w-1/4 md:w-1/2 mt-4">
                    <div
                        class="opacity-75 flex flex-col p-4 overflow-hidden rounded-xl shadow-lg duration-300 hover:shadow-2xl group hover:opacity-95 hover:border-1 hover:border-teal-500"
                    >
                        <div class="justify-center flex flex-wrap">
                            <div
                                class="px-4 py-4 bg-amber-100 hover:bg-teal-500 rounded-full"
                            >
                                <img
                                    class="w-10 mx-auto"
                                    :src="'/icons/photo.svg'"
                                />
                            </div>
                        </div>
                        <div class="justify-center flex flex-wrap">
                            <h1
                                class="text-3xl sm:text-4xl xl:text-5xl font-bold text-amber-100 mt-4 group-hover:text-teal-500"
                            >
                                {{ $page.props.totalUserCardsPasted }}
                            </h1>
                        </div>

                        <div class="justify-center flex flex-wrap">
                            <div
                                class="flex flex-row justify-between text-amber-100 group-hover:text-teal-500 text-lg"
                            >
                                <p>Total cards pasted by players</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 lg:w-1/4 md:w-1/2 mt-4">
                    <div
                        class="opacity-75 flex flex-col p-4 overflow-hidden rounded-xl shadow-lg duration-300 hover:shadow-2xl group hover:opacity-95 hover:border-1 hover:border-teal-500"
                    >
                        <div class="justify-center flex flex-wrap">
                            <div
                                class="px-4 py-4 bg-amber-100 hover:bg-teal-500 rounded-full"
                            >
                                <img
                                    class="w-10 mx-auto"
                                    :src="'/icons/in.svg'"
                                />
                            </div>
                        </div>
                        <div class="justify-center flex flex-wrap">
                            <h1
                                class="text-3xl sm:text-4xl xl:text-5xl font-bold text-amber-100 mt-4 group-hover:text-teal-500"
                            >
                                {{ $page.props.totalExchangesAccepted }}
                            </h1>
                        </div>

                        <div class="justify-center flex flex-wrap">
                            <div
                                class="flex flex-row justify-between text-amber-100 group-hover:text-teal-500 text-lg"
                            >
                                <p>Total exchanges accepted</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 lg:w-1/4 md:w-1/2 mt-4">
                    <div
                        class="opacity-75 flex flex-col p-4 overflow-hidden rounded-xl shadow-lg duration-300 hover:shadow-2xl group hover:opacity-95 hover:border-1 hover:border-teal-500"
                    >
                        <div class="justify-center flex flex-wrap">
                            <div
                                class="px-4 py-4 bg-amber-100 hover:bg-teal-500 rounded-full"
                            >
                                <img
                                    class="w-10 mx-auto"
                                    :src="'/icons/book.svg'"
                                />
                            </div>
                        </div>
                        <div class="justify-center flex flex-wrap">
                            <h1
                                class="text-3xl sm:text-4xl xl:text-5xl font-bold text-amber-100 mt-4 group-hover:text-teal-500"
                            >
                                {{ $page.props.totalCollections }}
                            </h1>
                        </div>

                        <div class="justify-center flex flex-wrap">
                            <div
                                class="flex flex-row justify-between text-amber-100 group-hover:text-teal-500 text-lg"
                            >
                                <p>Total active collections</p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="w-full justify-center flex flex-wrap p-5 lg:mt-5">
                    <div
                        class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 rounded-lg p-6 w-72 shadow-md m-4"
                    >
                        <div class="flex items-center mb-4">
                            <img
                                class="h-16 w-16 object-cover object-center rounded-full"
                                :src="'/icons/collection2.svg'"
                                alt="photo"
                            />
                            <div>
                                <p
                                    class="text-2xl text-violet-300 mb-1 ml-6 text-jost"
                                >
                                    Collect
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-cyan-500 text-xl my-2">
                                Fill great collections
                            </p>
                            <p class="text-gray-400 text-justify">
                                A total of 12 categories to differenciate the
                                class of each collection, at least 10 cards per
                                collection including different rarity cards.
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 rounded-lg p-6 w-72 shadow-md m-4"
                    >
                        <div class="flex items-center mb-4">
                            <img
                                class="h-16 w-16 object-cover object-center rounded-full"
                                :src="'/icons/exchange.svg'"
                                alt="photo"
                            />
                            <div>
                                <p class="text-2xl text-violet-300 mb-1 ml-6">
                                    Trade
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-cyan-500 text-xl my-2">
                                Exchange cards with other players
                            </p>
                            <p class="text-gray-400 text-justify">
                                Get rare cards by exchanges with other players.
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 rounded-lg p-6 w-72 shadow-md m-4"
                    >
                        <div class="flex items-center mb-4">
                            <img
                                class="h-16 w-16 object-cover object-center rounded-full"
                                :src="'/icons/paintbrush.svg'"
                                alt="photo"
                            />
                            <div>
                                <p class="text-2xl text-violet-300 mb-1 ml-6">
                                    Build
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-cyan-500 text-xl my-2">
                                Create your own collections (only for the brave
                                ones!)
                            </p>
                            <p class="text-gray-400 text-justify">
                                If you like to share a new collection you can
                                create your own cards to other players to
                                collect.
                            </p>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div
                    class="w-full pt-16 pb-6 text-sm text-center md:text-left fade-in"
                >
                    <div>
                        <img
                            class="w-96 mx-auto"
                            :src="'/images/cardsteal.png'"
                        />
                    </div>
                    <p class="text-gray-400">
                        Contact at
                        <span class="text-violet-400">
                            karta.tcg@gmail.com</span
                        >
                    </p>

                    <p class="text-gray-400">
                        <a
                            target="_blank"
                            href="https://www.facebook.com/Karta-Card-Trading-Game-105780995533698"
                            class="text-sky-600 font-semibold tracking-wider"
                        >
                            Cards Facebook page
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
import { onMounted, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CollectionBox from "./Collection/CollectionBox.vue";

export default {
    name: "Welcome",

    components: { AppLayout, CollectionBox },

    props: {
        randomCards: {
            type: Object,
        },
        randomCollections: {
            type: Object,
        },
        chartData: {
            type: Object,
        },

        totalUserCardsObtained: {
            type: Number,
        },
        totalUserCardsPasted: {
            type: Number,
        },
        totalExchangesAccepted: {
            type: Number,
        },
        totalCollections: {
            type: Number,
        },
    },

    setup(props, { emit }) {
        const state = reactive({
            showGraph: false,
            chartData: [],
            chartType: "BarChart",
            chartOptions: {
                //chart: {
                title: "Titulo",
                width: 600,
                height: 350,
                //},
            },
        });

        onMounted(() => {
            var obj = props.chartData;

            for (var i in obj) {
                state.chartData.push(obj[i]);
            }

            state.chartType = "PieChart";
            state.chartOptions.title = "All available cards grouped by rarity";
        });

        return {
            state,
        };
    },
};
</script>

<style>
@font-face {
    font-family: "Jost";
    src: local("Jost"),
        url(/fonts/Jost-VariableFont_wght.ttf) format("truetype");
}

body {
    font-family: "Jost";
}

.text-jost {
    font-family: "Jost";
}
</style>
