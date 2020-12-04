<template>
    <div class="mt-2" v-if="replies  && replies.length">
        <h4 class="font-semibold">Replies</h4>
        <!--        TODO: EXTRACT LIST TO ITS OWN COMPONENT-->
        <ul class="rounded border">
            <ThreadReply v-for="reply of replies"
                         :key="reply.id"
                         :reply="reply"
                         @like="toggleReply"
                         :is-favorite="userFavoritesRepliesIds.some(id => +id === +reply.id)"
                         :likeable="!!user"/>
        </ul>
        <div>
            <inertia-link v-if="prevLink" :href="prevLink" class="no-underline font-semibold text-blue-500">
                <small>prev</small>
            </inertia-link>
            {{ prevLink && nextLink ? '|' : '' }}
            <inertia-link v-if="nextLink" :href="nextLink" class="no-underline font-semibold text-blue-500">
                <small>next</small>
            </inertia-link>
        </div>
    </div>
</template>

<script>
import ThreadReply from "@/components/ThreadReply";
import {likeReply} from "@/services/ReplyService";

export default {
    name: "Replies",
    components: {ThreadReply},
    props: {
        user: {
            type: Object,
        },
        replies: {
            type: Array,
            required: true,
        },
        nextLink: {
            type: String,
        },
        prevLink: {
            type: String,
        },
    },
    methods: {
        async toggleReply(reply) {
            const favorite = await likeReply(reply.id);
            reply.favorites = [...reply.favorites, favorite]
        }
    },
    computed: {
        userFavoritesRepliesIds() {
            if (!this.user) {
                return [];
            }
            const favorites = this.replies.flatMap(reply => reply.favorites);
            return favorites
                .filter(favorite => +favorite.user_id === +this.user.id)
                .map(favorite => favorite.likeable_id);
        }
    }
}
</script>
