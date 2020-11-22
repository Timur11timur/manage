<template>
    <div>
        <input id="trix" type="hidden" :name="name" :value="value">

        <trix-editor
            ref="trix"
            input="trix"
            @trix-change="change"
            :placeholder="placeholder">

        </trix-editor>
    </div>
</template>

<style>
    trix-editor {
        border-color: #dae1e7;
        border-radius: 0;
        padding: 10px;
    }

    trix-editor pre {
        border: 1px solid grey;
        border-radius: 2px;
        background-color: #eeeeee;
        padding: 5px;
    }

    trix-toolbar .trix-button-group {
        border-color: #dae1e7;
        margin-bottom: 0;
        border-bottom: none;
        border-radius: 0;
    }

    trix-toolbar .trix-button {
        border-bottom: none;
    }
</style>

<script>
    import Trix from 'trix';

    export default {
        props: ['name', 'value', 'placeholder'],

        methods: {
            change({target}) {
                this.$emit('input', target.value)
            }
        },

        watch: {
            value(val) {
                if (val === '') {
                    this.$refs.trix.value = '';
                }
            }
        }
    }
</script>
