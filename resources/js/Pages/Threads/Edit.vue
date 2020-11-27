<template>
    <app-layout>
        <template #header>
            {{ title }}
        </template>
        <div class="w-1/2 mx-auto mt-2">
            <form @submit.prevent="startThread" :action="route('threads.store')" METHOD="POST">
                <small class="text-red-500 block" v-for="(error, index) in errors" :key="index">{{ error }}</small>

                <select class="rounded border px-4 mb-4 h-8 w-full" name="channel_id" id="channel_id"
                        v-model="form.channel_id">
                    <option value="0">Choose a channel...</option>
                    <option v-for="channel in $page.channels" :value="channel.id">{{ channel.name }}</option>
                </select>

                <input class="rounded border px-4 mb-4 h-8 w-full" name="title" id="title" v-model="form.title"
                       placeholder="Your title">
                <textarea class="rounded border h-32 px-4 w-full" name="body" id="body" v-model="form.body"
                          placeholder="What do you want to say ?"></textarea>

                <button class="float-right rounded border bg-blue-500 p-2 text-white" type="submit">Start Thread
                </button>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Input from "@/Jetstream/Input";

export default {
    name: "Edit",
    components: {Input, AppLayout},
    data() {
        return {
            form: {
                title: null,
                body: null,
                channel_id: 0,
            }
        }
    },
    computed: {
        title() {
            return this.form.title ? this.form.title : 'Create a Threads';
        },
        errors() {
            return this.$page.errors.length === 0 ? [] : this.$page.errors;
        }
    },
    methods: {
        async startThread() {
            this.$inertia.post(this.route('threads.store'), this.form, {
                onSuccess: () => {
                    if (this.errors.length === 0) {
                        this.resetForm();
                    }
                },
            });
        },
        resetForm() {
            this.form = {
                title: null,
                body: null,
                channel_id: 0,
            }
        }
    }
}
</script>

<style scoped>

</style>
