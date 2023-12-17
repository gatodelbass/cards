<template>
    <input class="text-sm h-8 py-1 border-gray-400 focus:border-lightBlue-300 focus:ring focus:ring-lightBlue-200 focus:ring-opacity-50 rounded-sm shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['modelValue'],
        emits: ['update:modelValue'],
        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

