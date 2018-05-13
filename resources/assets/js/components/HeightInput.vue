<template>
    <div class="form-group">
        <label for="heightInput">Height: {{ valueSI }}</label>
        <input id="heightInput" v-model="value" type="range" min="0" max="13" class="form-control-range" name="height">
    </div>
</template>

<script>
    export default {
        props: ['value'],
        computed: {
            valueSI: function () {
                if (this.value == '0') {
                    return 'below 1.2';
                } else if (this.value == '13') {
                    return '2.4 and above';
                } else {
                    return Number((1.2 + 0.1 * (this.value - 1)).toFixed(1));
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
