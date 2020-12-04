<template>
    <app-layout>
        <template #header>
            Forum Threads
        </template>
        <ThreadList :threads="threads"/>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ThreadList from "@/components/ThreadList";

export default {
    name: "Index",
    components: {ThreadList, AppLayout},
    props: {
        threads: {
            required: true,
            type: Array,
        },
    },
}
</script>
