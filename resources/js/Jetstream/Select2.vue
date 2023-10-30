<template>
    <select class="border-blueGray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm h-8 text-sm py-0 px-2" v-model="value">
        <option
            v-for="option, key in options" :value="key"
            :selected="key == value"
            :key="key" class="-mt-0 py-0 align-top h-16">
            {{ option }}
        </option>
    </select>

</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                default: []
            },
            value: {
                default: null,
            },
        },
    }
</script>



