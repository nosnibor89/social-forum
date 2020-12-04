<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ profileUser.name }}'s Profile
            </h2>
        </template>
        <ThreadList :threads="paginatedThreads.data"/>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import ThreadList from "@/components/ThreadList";
    export default {
        components: {ThreadList, AppLayout},
        props: {
            profileUser: {
                type: Object,
                required: true,
            },
            paginatedThreads: {
                type: Object,
                required: true,
            }
        },
    }
</script>
