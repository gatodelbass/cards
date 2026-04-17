<template>
    <app-layout></app-layout>
    <h1 class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700">
        Home
    </h1>

    <div class="justify-start flex flex-auto">

        <button @click="selectedWeather()" :disabled="state.spinningWeather"
            class="m-1 py-1 px-2 border border-gray-200 w-24 h-24">
            {{ state.spinningWeather ? "Spinning..." : "Spin for weather" }}
        </button>

        <button @click="selectedTime()" :disabled="state.spinningTime"
            class="m-1 py-1 px-2 border border-gray-200 w-24 h-24">
            {{ state.spinningTime ? "Spinning..." : "Spin for time" }}
        </button>


        <button @click="spin" :disabled="state.spinning" class="m-1 py-1 px-2 border border-gray-200 w-24 h-24">
            {{ state.spinning ? "Spinning..." : "Spin for money" }}
        </button>

        <div>

            <img :src="weather[state.selectedWeather].image" class="w-24 p-1">
        </div>
        <span class="m-1">{{ weather[state.selectedWeather].conditions }}</span>

        <div class="text-3xl p-2 border-1 border-gray-300 m-1">{{ state.selectedTime }} days</div>


        <div class="m-1 p-1 text-3xl py-1 px-2 border bg-gray-100 border-gray-400 rounded-sm">money available: <b>${{
            state.currentNumber - state.totalCost }}</b></div>
    </div>

    <div class="justify-start flex flex-auto text-xs">
        <div v-for="item in state.addedItems" key="index" class="w-24 border border-gray-300  p-1 m-1">
            <div class="w-full p-0.5 border text-left bg-gray-200 border-gray-300 truncate">{{ item.name }}</div>

            <div class="w-full p-0.5 my-2"><img :src="item.image" class="max-h-20" /></div>
            <div class="w-full p-0.5 border">price: <b>${{ item.price }}</b></div>
            <button @click="removeItem(item.id)" class="p-0.5 my-0.5 px-2 border border-gray-200 bg-yellow-200 w-full">
                remove
            </button>
        </div>
    </div>




    <div class="justify-start flex flex-auto">

        <div v-for="item in campingItems" class="w-64 border border-gray-300  p-1 m-1">
            <div class="w-full p-0.5 border text-left bg-gray-200 border-gray-300">{{ item.name }}</div>

            <div class="w-full p-0.5 my-2"><img :src="item.image" class="" /></div>
            <div class="w-full p-0.5 border">price: <b>${{ item.price }}</b></div>
            <button v-if="state.currentNumber >= state.totalCost + item.price" @click="addItem(item)"
                class="p-0.5 my-0.5 px-2 border border-gray-200 bg-teal-300 w-full">
                add
            </button>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

export default {
    name: "LoginIndex",

    components: { AppLayout },

    props: {
        campingItems: Object
    },

    setup(props, { emit }) {
        const page = usePage();
        const state = reactive({
            currentNumber: 0,
            spinning: false,
            interval: null,
            spinningWeather: false,
            intervalWeather: null,
            spinningTime: false,
            intervalTime: null,
            addedItems: [],
            totalCost: 0,
            selectedWeather: 0
        });

        let weather = [];
        weather[0] = { conditions: "sunny", image: "https://cdn-icons-png.flaticon.com/128/4814/4814275.png" };
        weather[1] = { conditions: "heavy rain", image: "https://cdn-icons-png.flaticon.com/128/9755/9755312.png" };
        weather[2] = { conditions: "spring", image: "https://cdn-icons-png.flaticon.com/128/4146/4146121.png" };
        weather[3] = { conditions: "snow", image: "https://cdn-icons-png.flaticon.com/128/2336/2336301.png" };
        weather[4] = { conditions: "light rain", image: "https://cdn-icons-png.flaticon.com/128/1163/1163759.png" };


        onMounted(() => { });

        function spin() {
            state.addedItems = [];
            if (state.spinning) return;

            state.spinning = true;

            state.interval = setInterval(() => {
                state.currentNumber = Math.floor(Math.random() * (200 - 70 + 1)) + 70;

            }, 100);

            const stopTime = Math.random() * 2000 + 4000;

            setTimeout(() => {
                clearInterval(state.interval);
                state.spinning = false;
            }, stopTime);
        }

        function selectedWeather() {

            if (state.spinningWeather) return;

            state.spinningWeather = true;

            state.intervalWeather = setInterval(() => {
                state.selectedWeather = Math.floor(Math.random() * (4 - 0 + 1));

            }, 100);

            const stopTime = Math.random() * 2000 + 4000;

            setTimeout(() => {
                clearInterval(state.intervalWeather);
                state.spinningWeather = false;
            }, stopTime);
        }

        function selectedTime() {

            if (state.spinningTime) return;

            state.spinningTime = true;

            state.intervalTime = setInterval(() => {
                state.selectedTime = Math.floor(Math.random() * (5 - 1)) + 2;

            }, 100);

            const stopTime = Math.random() * 2000 + 4000;

            setTimeout(() => {
                clearInterval(state.intervalTime);
                state.spinningTime = false;
            }, stopTime);
        }

        function addItem(item) {


            state.addedItems.push(item);
            updateTotal();

        }

        function removeItem(id) {



            const index = state.addedItems.findIndex(item => item.id === id);
            if (index !== -1) {
                state.addedItems.splice(index, 1);
            }

            updateTotal();
        }

        function updateTotal() {
            state.totalCost = state.addedItems.reduce((sum, item) => {
                return sum + Number(item.price);
            }, 0);
        }

        return {
            state,
            spin,
            addItem,
            removeItem,
            updateTotal, weather, selectedWeather, selectedTime
        };
    },
};
</script>
