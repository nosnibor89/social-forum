<template>
    <li class="border p-2">
        <p class="italic">{{ reply.body }}</p>
        <small class="text-right block">
            {{reply.owner.name}} said at
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
        }
    },
}
</script>

<style scoped>

</style>
