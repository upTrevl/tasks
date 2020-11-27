<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
                <div>
                    Задачи
                </div>

                <jet-nav-link :href="route('task.create')" :active="route().current('task.create')">
                    Создать задачу
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JetButton from '@/Jetstream/Button'
    import JetNavLink from "@/Jetstream/NavLink";

    export default {
        components: {
            AppLayout,
            Welcome,
            JetButton,
            JetNavLink,
        },
        data() {
            return {
                tasks: [],
            }
        },
        mounted: function () {
            this.getCreatedTasks();
        },
        methods: {
            getCreatedTasks: function () {
                axios
                    .get('/tasks')
                    .then(response => (this.tasks = response));
            }
        },
    }
</script>
