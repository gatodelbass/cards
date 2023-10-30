<template>
    <input class="py-2 border-gray-400 focus:border-sky-300  rounded-sm shadow-sm" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
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

