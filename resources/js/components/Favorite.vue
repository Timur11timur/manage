<template>
    <button type="submit" :class="classes" @click="toggle">
        <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
        </svg>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            };
        },

        computed: {
            classes() {
                return [
                    'btn',
                    'border',
                    this.active ? 'btn-primary' : 'btn-default'
                ];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            destroy() {
                axios.delete(this.endpoint);
                this.active = false;
                this.count--;
            },

            create() {
                axios.post(this.endpoint);
                this.active = true;
                this.count++;
            }
        }
    }
</script>
