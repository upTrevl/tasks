<template>
    <div class="notifications-wrap">
        пример
        <div class="">
            <a href="" class="notification">
                <div class="flex flex-row mb-2 justify-between">
                    <div class="date mr-3">30.20.2011</div>
                    <div class="font-semibold">Новая задача</div>
                    <a href="" >X</a>
                </div>
                <div class="flex flex-row">
                    <div class="date mr-3">Создатель:</div>
                    <div class="">Мандрусова Татьяна</div>
                </div>
            </a>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Notifications",
        data() {
            return {
                notifications: []
            }
        },
        mounted: function () {
            this.getNotifications()
        },
        methods: {
            getNotifications: function () {
                axios
                    .get('/notifications')
                    .then(response => (
                        this.tasks = response.data
                    ));
            },
        },
    }
</script>

<style scoped>

</style>
