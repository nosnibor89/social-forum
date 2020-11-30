<template>
    <li class="border p-2">
        <div class="flex justify-between">
            <p class="italic flex-grow">{{ reply.body }}</p>
            <div @click.prevent="like" class="flex items-center" :class="likeClass">
                <font-awesome-icon icon="heart"/>
                <small class="mx-1">{{ reply.favorites.length }}</small>
            </div>
        </div>

        <small class="text-right text-gray-400 block mt-4">
            {{ reply.owner.name }},
            {{ reply.created_at | simpleDate }}
        </small>
    </li>
</template>

<script>
export default {
    name: "ThreadReply",
    props: {
        reply: {
            type: Object,
            required: true,
        },
        likeable: {
            type: Boolean,
            required: true,
        },
        isFavorite: {
            type: Boolean,
            required: true,
        }
    },
    computed: {
        likeClass() {
            const color = this.isFavorite ? 'text-pink-500' : 'text-gray-500';

            return {
                [color]: true,
                'cursor-pointer': this.likeable
            }
        }
    },
    methods: {
        like() {
            if (!this.likeable) {
                return;
            }
            this.$emit('like', this.reply);
        }
    }
}
</script>

<style scoped>

</style>
