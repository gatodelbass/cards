<template>
    <nav
        class="bg-gradient-to-r from-gray-800 via-gray-900 to-gray-800 sticky top-0 z-30 text-jost text-sm md:text-base"
    >
        <div class="container mx-auto p-2 flex flex-wrap md:flex-no-wrap">
            <div class="w-full md:w-auto md:flex-grow md:flex md:text-left">
                <ul
                    class="flex flex-col mt-4 -mx-4 pt-4 border-t md:flex-row md:items-center md:mx-0 md:ml-auto md:mt-0 md:pt-0 md:border-0"
                >
                    <li>
                        <Link
                            class="inline-block mx-2"
                            :href="route('help')"
                            ><img
                                class="w-6 inline-block"
                                :src="'/images/cardsteal2.png'"
                            />
                        </Link>

                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('login.index')"
                            class="inline-block mx-2"
                        >
                            <span class="text-teal-300">Home</span>
                        </Link>
                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('help')"
                            class="inline-block mx-2"
                        >
                            <span class="text-teal-300">Help</span>
                        </Link>
                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('helpSpanish')"
                            class="inline-block mx-2"
                        >
                            <span class="text-teal-300">Ayuda</span>
                        </Link>

                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('redeemBoxes')"
                            class="inline-block mx-2"
                        >
                            <img
                                class="w-7 inline-block"
                                :src="'/icons/box.svg'"
                            />
                            <span class="text-teal-300 text-lobster">
                                x{{ $page.props.auth.user.boxes }}</span
                            >
                        </Link>

                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('redeemTickets')"
                            class="inline-block mx-2"
                        >
                            <img
                                class="w-6 inline-block"
                                :src="'/icons/ticket.svg'"
                            />
                            <span class="text-teal-300 text-lobster">
                                x{{ $page.props.auth.user.tickets }}</span
                            >
                        </Link>

                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('redeemGold')"
                            class="inline-block mx-2"
                        >
                            <img
                                class="w-8 inline-block p-1"
                                :src="'/icons/coin.svg'"
                            />
                            <span class="text-teal-300 text-lobster">{{
                                $page.props.auth.user.gold
                            }}</span></Link
                        >
                    </li>
                </ul>
            </div>

            <div class="w-full md:w-auto md:flex-grow md:flex md:text-left">
                <ul
                    class="flex flex-col mt-4 -mx-4 pt-4 border-t md:flex-row md:items-center md:mx-0 md:ml-auto md:mt-0 md:pt-0 md:border-0"
                >
                    <li>
                        <Link
                            :href="route('playerAvatars')"
                            class="inline-block mx-1"
                        >
                            <div v-if="$page.props.auth.user != null">
                                <img
                                    v-if="$page.props.auth.user.avatar == 'none'"
                                    class="w-12 inline-block rounded-full border-gray-300 border-1"
                                    :src="'storage/avatars/user.svg'"
                                />

                                <img
                                    v-else
                                    class="w-12 inline-block rounded-full border-teal-300 border-1"
                                    :src="'/storage/' + $page.props.auth.user.avatar"
                                />
                            </div>
                        </Link>

                        <Link
                            v-if="$page.props.user == null"
                            :href="route('loginForm')"
                            class="inline-block mx-1"
                            ><button
                                type="button"
                                class="hover:text-emerald-400 py-1 px-3 bg-blueGray-900 flex text-amber-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                Login
                            </button></Link
                        >

                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('playerProfile')"
                            class="inline-block mx-1"
                            ><button
                                type="button"
                                class="hover:text-amber-300 py-1 px-3 bg-gradient-to-r from-sky-900 via-sky-800 to-sky-700 flex text-teal-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                {{ $page.props.auth.user.nickname }}
                            </button></Link
                        >

                        <Link
                            v-if="$page.props.auth.user != null"
                            :href="route('logoutUser')"
                            class="inline-block mx-1"
                            ><button
                                type="button"
                                class="hover:text-emerald-400 py-1 px-3 bg-blueGray-900 flex text-teal-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                Logout
                            </button></Link
                        >

                        <Link
                            v-if="$page.props.auth.user == null"
                            :href="route('registerForm')"
                            class="inline-block mx-1"
                            ><button
                                type="button"
                                class="hover:text-emerald-400 py-1 px-3 bg-blueGray-900 flex text-amber-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-yellow-500 focus:ring-yellow-500"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                Register
                            </button></Link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <router-view />
</template>

<script>
import { reactive } from "vue";

export default {
    name: "ProductCard",

    props: {
        product: {
            type: Object,
        },
    },

    setup() {
        const state = reactive({
            logo: "images/logo.jpg",
        });

        return {
            state,
        };
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

#nav {
    padding: 30px;
}

#nav a {
    font-weight: bold;
    color: #2c3e50;
}

#nav a.router-link-exact-active {
    color: #42b983;
}

@font-face {
    font-family: "Girasol";
    src: local("Girasol"), url(/fonts/Girassol-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Rye";
    src: local("Rye"), url(/fonts/Rye-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Stardos";
    src: local("Stardos"),
        url(/fonts/StardosStencil-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Orelega";
    src: local("Orelega"), url(/fonts/OrelegaOne-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Unifraktur";
    src: local("Unifraktur"),
        url(/fonts/UnifrakturCook-Bold.ttf) format("truetype");
}

@font-face {
    font-family: "Fredericka";
    src: local("Fredericka"),
        url(/fonts/FrederickatheGreat-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Neuton";
    src: local("Neuton"), url(/fonts/Neuton-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Slabo";
    src: local("Slabo"), url(/fonts/Slabo27px-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Lobster";
    src: local("Lobster"), url(/fonts/Lobster-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Corben";
    src: local("Corben"), url(/fonts/Corben-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Bree";
    src: local("Bree"), url(/fonts/BreeSerif-Regular.ttf) format("truetype");
}

@font-face {
    font-family: "Jost";
    src: local("Jost"),
        url(/fonts/Jost-VariableFont_wght.ttf) format("truetype");
}
@font-face {
  font-family: "Elite";
  src: local("Elite"), url(/fonts/SpecialElite-Regular.ttf) format("truetype");
}

@font-face {
  font-family: "ZillaSlab";
  src: local("ZillaSlab"), url(/fonts/ZillaSlab-Regular.ttf) format("truetype");
}

body {
    font-family: "Jost";
}

.text-jost {
    font-family: "Jost";
}

.text-girasol {
    font-family: "Girasol";
}

.text-rye {
    font-family: "Rye";
}

.text-stardos {
    font-family: "Stardos";
}

.text-orelega {
    font-family: "Orelega";
}

.text-unifraktur {
    font-family: "Unifraktur";
}

.text-fredericka {
    font-family: "Fredericka";
}

.text-neuton {
    font-family: "Neuton";
}

.text-slabo {
    font-family: "Slabo";
}

.text-lobster {
    font-family: "Lobster";
}

.text-corben {
    font-family: "Corben";
}

.text-salsa {
    font-family: "Bree";
}

.text-zilla {
    font-family: "ZillaSlab";
}
.text-elite {
    font-family: "Elite";
}
</style>
