<template>
    <div class="status">
        <div v-if="status==='open'" class="task-status open">
            Открыта
        </div>
        <div v-if="status==='process'" class="task-status process">
            В процессе
        </div>
        <div v-if="status==='close'" class="task-status close">
            Закрыта
        </div>
    </div>
</template>

<script>
    export default {
        name: "TaskStatus",
        props: ['status'],
        data() {
            return {

            }
        },
    }
</script>

<style scoped>

</style>
