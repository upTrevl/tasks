<template>
    <div>
        <div class="p-6 sm:px-20 bg-white">
            <div class="task-list-item">
                <table class="table_col">
                    <colgroup>
                        <col style="background:#8da2fb;">
                    </colgroup>
                    <tr>
                        <th>ID</th>
                        <th>Дата создания</th>
                        <th>ФИО Клиента</th>
                        <th>Гос Номер</th>
                        <th>Номер Телефона</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    <tr v-for="task in tasks">
                        <td>{{task.id}}</td>
                        <td>{{task.created_at | formatDate}}</td>
                        <td>{{task.client_name}}</td>
                        <td>{{task.car_number}}</td>
                        <td>{{task.client_phone}}</td>
                        <td>
                           <TaskStatus :status="task.status"/>
                        </td>
                        <td>
                            <jet-nav-link :href="route('task.show',{task:task})">
                                Подронее
                            </jet-nav-link>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

    import JetNavLink from "@/Jetstream/NavLink";
    import TaskStatus from "@/Pages/Task/TaskStatus";
    export default {
        components: {
            JetNavLink,
            TaskStatus,
        },
        name: "TaskList",
        props: ['tasks'],
        mounted: function () {
        },
        methods: {
            getStatus: function ($status) {
            }
        },
    }
</script>

<style scoped>

</style>
