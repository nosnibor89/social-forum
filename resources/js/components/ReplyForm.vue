<template>
    <div class="mt-4 w-full">
        <form @submit.prevent="reply" :action="route('threads.replies.store', threadId)" METHOD="POST">
            <textarea class="rounded border h-32 px-4 w-full" name="body" id="body" v-model="form.body"
                      placeholder="Your comments here..."></textarea>

            <button class="float-right rounded border bg-blue-500 p-2 text-white" type="submit">Reply</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "ReplyForm",
    props: {
        threadId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            form: {
                body: null,
            },
        }
    },
    methods: {
        reply() {
            this.$inertia.post(this.route('threads.replies.store', this.threadId), this.form, {
                onSuccess: () => {
                    this.form.body = '';
                },
            });
        }
    },
}
</script>

<style scoped>

</style>
