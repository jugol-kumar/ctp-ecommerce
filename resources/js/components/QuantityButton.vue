<template>
    <div class="input-group input-group-lg bootstrap-touchspin">
        <span class="input-group-btn bootstrap-touchspin-injected">
            <button @click="increment()"
                    class="btn btn-primary bootstrap-touchspin-down"
                    type="button">
                <vue-feather type="minus"/>
            </button>
        </span>
        <input type="number" class="touchspin form-control" @input="$emit('update:modalValue', $event.target.value)">
        <span class="input-group-btn bootstrap-touchspin-injected">
            <button @click="decrement()"
                    class="btn btn-primary bootstrap-touchspin-up"
                    type="button">
                <vue-feather type="plus"/>
            </button>
        </span>
    </div>
</template>

<script>

</script>

<style scoped>

</style>
