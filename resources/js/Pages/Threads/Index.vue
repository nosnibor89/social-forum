<template>
    <app-layout>
        <template #header>
            Forum Threads
        </template>
        <div class="w-1/2 mx-auto mt-2">
            <!--        TODO: EXTRACT LIST TO ITS OWN COMPONENT-->
            <ul class="rounded border ">
                <li class="border p-2" v-for="thread of threads" :key="thread.id">
                   <div class="flex justify-between">
                       <inertia-link :href="route('threads.show', { thread: thread.id, channel: thread.channel_id})"
                                     class="no-underline font-semibold text-blue-500">
                           <h4>{{ thread.title }}</h4>
                       </inertia-link>

                       <small class="text-gray-500">{{ thread.replies_count}} replies</small>
                   </div>

                    <p class="italic">{{ thread.body }}</p>
                </li>
            </ul>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "Index",
    components: {AppLayout},
    props: {
        threads: {
            required: true,
            type: Array,
        },
    },
}
</script>
