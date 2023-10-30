<template>
    <div v-show="message">
        <p class=" text-orange-500">
            {{ message }}
        </p>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
