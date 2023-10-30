<template>
    <select class="border-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm" v-model="value">
        <option
            v-for="option, key in options" :value="key"
            :selected="key == value"
            :key="key" class="m-10 py-5 align-middle h-20">
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



