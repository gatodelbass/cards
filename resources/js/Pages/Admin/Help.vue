<template>
    <app-layout></app-layout>

    <div class="text-jost px-4">
        <p class="my-4 text-xl">
            Hola!, también está disponible la
            <span class="text-sky-600 font-semibold tracking-wider">
                <Link :href="route('helpSpanish')"
                    >Guia del juego - versión en español
                </Link></span
            >
        </p>

        <p class="my-4">
            Hello! we also have a
            <a
                target="_blank"
                href="https://www.facebook.com/Karta-Card-Trading-Game-105780995533698"
                class="text-sky-600 font-semibold tracking-wider"
            >
                Karta Facebook page
            </a>
            where we will be publishing updates, new collections and other
            related stuff
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Help guide
        </h1>
        <p class="my-2 p-2 text-justify">
            Welcome to Karta, a website made just for fun and to share with
            other players, where you can collect and exchange cards of different
            topics. It's for free and also ads free
        </p>

        <p class="my-2 p-2 text-justify">
            We starting to cover each one of the items in the home section and
            then we explain other relevant stuff of the page
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Explore collections
        </h1>

        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/compass.svg'" />
            <p class="my-2">Explore collections</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you can buy new collections of your preference,
            since you have enough gold. You can filter the collections by the
            category. The cost of each collection is the number of its cards
            plus 1000.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Redeem boxes
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/box2.svg'" />
            <p class="my-2">Redeem boxes</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you can redeem obtained boxes. You get 2 boxes daily
            when you login to the website. Boxes can give you between 5 an 15
            and gold between 1000 and 50000. Boxes also can give avatars but it
            happens just a few times. Its the only way to get new avatars.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Redeem tickets
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/ticket3.svg'" />
            <p class="my-2">Redeem tickets</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you can get cards by redeem your tickets. One ticket
            gives you a single card which vary in rarity and cost. You have the
            option to redeem 1, 10 or 20 tickets in a single attempt, depending
            on your tickets quantity. When you get a new card, it will blink on
            the card, this card will be automatically protected to avoid you to
            sell accidentally and it's ready to paste in the album if you have
            purchased it's collection. Otherwise when the card is not new,
            automatically is put in exchange, so other players can see the card
            in the exchange bag and offer a trade.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            The exchange bag
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/backpack.svg'" />
            <p class="my-2">The exchange bag</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In the exchange bag you will find cards from other players, where
            you can offer you own cards in exchange. To make and exchange offer
            to the owner of the card, you have to put one of your cards with the
            same rarity. So you click on the card you want to get and it will
            display (if you have) your available cards to offer.
        </p>
        <img class="p-2 mx-auto" :src="'/images/help1.png'" />

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            My cards
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/cards.svg'" />
            <p class="my-2">My cards</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you can mange all your cards, can sell the repeated
            ones and can protect the ones that you want to keep for later on.
            The already pasted cards are displayed whit a green smiley at the
            bottom.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            The album
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/book2.svg'" />
            <p class="my-2">The album</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In the album you can paste you obtained cards and complete pages. It
            will display the progress of each one of the collections you have
            purchased. Before you enter the actual page, it will display the
            cards in small boxes where the gray means you don't have that card,
            the green means you already pasted that card and the glowing yellow
            means yo have that card available to paste.
        </p>

        <img class="p-2 mx-auto" :src="'/images/help2.png'" />

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Incoming exchanges
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/cards.svg'" />
            <p class="my-2">Incoming exchanges</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you will find the exchange offers that other player
            made for you, so you can accept or reject those offers.
        </p>
        <img class="p-2 mx-auto" :src="'/images/help3.png'" />

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Outgoing exchanges
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/out.svg'" />
            <p class="my-2">Outgoing exchanges</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you will find the exchange offers made by you, so
            you can cancel an offer if you have changed your mind.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Buy tickets
        </h1>
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400 mx-auto"
        >
            <img class="w-10 mx-auto" :src="'/icons/ticket3.svg'" />
            <p class="my-2">Buy tickets</p>
        </div>

        <p class="my-2 p-2 text-justify">
            In this section you can buy tickets with gold, each ticket costs
            10000 gold. You have the options yo buy 1, 10 or 20 tickets
            depending on your gold funds.
        </p>

        <h1
            class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
        >
            Avatars
        </h1>

        <p class="my-2 p-2 text-justify">
            Clicking on your avatar image you can then select a different avatar
            if you want, the selected avatar will be highlighted by a green
            border. Also you can sell repeated avatars. Each avatar is sold in
            10000 gold.
        </p>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    name: "ProductCard",

    components: { AppLayout },

    props: {
        record: {
            type: Object,
        },
    },

    setup(props, { emit }) {
        onMounted(() => {});

        const formatter = new Intl.NumberFormat("en-US", {
            style: "currency",
            currency: "USD",
            minimumFractionDigits: 0,
        });

        function formatCost(cost) {
            return formatter.format(cost);
        }

        return {
            formatCost,
        };
    },
};
</script>
