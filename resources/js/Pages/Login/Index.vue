<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Home
    </h1>

    <Link
        v-if="hasIncomingExchanges"
        :href="route('incomingExchanges')"
    >
        <div
            class="mt-2 hover:bg-sky-900 text-jost bg-gray-900 py-2 text-base md:text-xl cursor-pointer text-teal-300 animate-bounce"
        >
            You have exchange offers! Click here to show them.
        </div>
    </Link>

    <div class="w-full text-jost">
        <div
            class="container flex flex-wrap mx-auto text-blueGray-800 p-2 md:p-10 text-sm md:text-base justify-center"
        >
            <Link :href="route('exploreCollections')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/compass.svg'" />
                    <p class="my-2">Explore collections</p>
                </div>
            </Link>

            <Link :href="route('redeemBoxes')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/box2.svg'" />
                    <p class="my-2">Redeem boxes</p>
                </div>
            </Link>

            <Link :href="route('redeemTickets')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/ticket3.svg'" />
                    <p class="my-2">Redeem tickets</p>
                </div>
            </Link>


            <Link href="exchangeBag" method="post"> <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/backpack.svg'" />
                    <p class="my-2">The exchange bag</p>
                </div></Link>

            <Link :href="route('playerCards')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/cards.svg'" />
                    <p class="my-2">My cards</p>
                </div>
            </Link>

            <Link :href="route('albumIndex')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/book2.svg'" />
                    <p class="my-2">Album</p>
                </div>
            </Link>

            <Link :href="route('incomingExchanges')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 relative"
                >
                    <img class="w-10 mx-auto" :src="'/icons/in.svg'" />
                    <p class="my-2">Incoming exchanges</p>
                </div>
            </Link>

            <Link :href="route('outgoingExchanges')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/out.svg'" />
                    <p class="my-2">Outgoing exchanges</p>
                </div>
            </Link>

            <Link :href="route('playerProfile')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/profile.svg'" />
                    <p class="my-2">My profile</p>
                </div>
            </Link>

            <Link :href="route('redeemGold')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/coin3.svg'" />
                    <p class="my-2">Buy tickets</p>
                </div>
            </Link>

            <Link :href="route('players')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/shades.svg'" />
                    <p class="my-2">All players</p>
                </div>
            </Link>

            <Link :href="route('help')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/help.svg'" />
                    <p class="my-2">Help</p>
                </div>
            </Link>

            <Link :href="route('collections.index')">
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/collection.svg'" />
                    <p class="my-2">My collections</p>
                </div>
            </Link>

            <Link
                v-if="$page.props.auth.user.role == 'admin'"
                :href="route('adminIndex')"
            >
                <div
                    class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
                >
                    <img class="w-10 mx-auto" :src="'/icons/safe.svg'" />
                    <p class="my-2">Admin</p>
                </div>
            </Link>

    
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3'


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
            userData: page.props.auth.user,
        });

        onMounted(() => {});

        return {
            state,
        };
    },
};
</script>
