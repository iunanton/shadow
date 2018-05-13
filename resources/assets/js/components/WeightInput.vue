<template>
    <div class="form-group">
        <label for="weightInput">Weight: {{ valueSI }}</label>
        <input id="weightInput" v-model="value" type="range" min="0" max="20" class="form-control-range" name="weight">
    </div>
</template>

<script>
    export default {
        props: ['value'],
        computed: {
            valueSI: function () {
                if (this.value == '0') {
                    return 'below 35';
                } else if (this.value == '20') {
                    return '130 and above';
                } else {
                    return Number((35 + 5 * (this.value - 1)).toFixed(0));
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
