<template>
    <app-layout>
        <template #header>
            {{ thread.title }} by
            <inertia-link href="#" class="no-underline font-semibold text-blue-500">
                {{ thread.creator.name }}
            </inertia-link>
        </template>
        <div class="flex space-x-16 p-16">
            <div class="flex flex-col w-3/5">
                <textarea disabled class="rounded border h-32 px-4">{{ thread.body }}</textarea>

                <ThreadReplies :replies="thread.paginatedReplies.data" :next-link="nextRepliesLink"
                               :prev-link="prevRepliesLink"/>

                <hr class="mt-4">
                <ReplyForm v-if="$page.user" :thread-id="thread.id"/>
                <a v-else :href="route('login')" class="no-underline font-semibold text-blue-500">
                    <p>Please login to reply</p>
                </a>
            </div>
            <div class="rounded border w-2/5 p-4">
                <p class="font-thin text-gray-500">
                    This thread was published {{ thread.created_at | simpleDate }} by
                    <inertia-link href="#" class="no-underline font-semibold text-blue-500">
                        {{ thread.creator.name }}
                    </inertia-link>
                    and
                    currently has {{ totalReplies }}
                </p>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ThreadReplies from "@/components/ThreadReplies";
import ReplyForm from "@/components/ReplyForm";

export default {
    name: "Show",
    components: {ReplyForm, ThreadReplies, AppLayout},
    props: {
        thread: {
            required: true,
            type: Object,
        },
    },
    computed: {
        replies() {
            return this.thread.paginatedReplies;
        },
        nextRepliesLink() {
            return this.thread.paginatedReplies.next_page_url;
        },
        prevRepliesLink() {
            return this.thread.paginatedReplies.prev_page_url;
        },
        totalReplies() {
            return this.thread.paginatedReplies.total;
        }
    },
    created() {
        console.log(this.thread.paginatedReplies)
    }
}
</script>

<style scoped>

</style>
