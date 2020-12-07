<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
                <div>
                    Задачи
                </div>
                <div class="search-wrap">
                    <input type="text" placeholder="Начните вводить..." class="search-input border-gray-100" v-model="search">
                    <div v-if="showRes" class="search-res">
                        Результаты поиска
                        <div v-for="res in searchRes"  class="search-item">
                            {{res.car_number}}
                        </div>
                    </div>
                </div>
                <jet-nav-link :href="route('task.create')" :active="route().current('task.create')">
                    Создать задачу
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <TaskList :tasks="tasks"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import TaskList from '@/Pages/Task/TaskList'
    import JetButton from '@/Jetstream/Button'
    import JetNavLink from "@/Jetstream/NavLink";

    export default {
        components: {
            AppLayout,
            Welcome,
            JetButton,
            JetNavLink,
            TaskList,
        },
        data() {
            return {
                tasks: [],
                search:'',
                searchRes:[],
                showRes:false
            }
        },
        mounted: function () {
            this.getCreatedTasks();
        },
        methods: {
            getCreatedTasks: function () {
                axios
                    .get('/tasks/archive')
                    .then(response => (
                        this.tasks = response.data
                    ));
            },
            getSearchRes: function (val) {
                axios.get('/search/' +this.search)
                    .then(response => {
                        this.searchRes = response.data;
                        this.showRes = true;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        watch: {
            search: function () {
                this.getSearchRes(this.search);
            },
            searchRes: function () {
                console.log(this.searchRes);
            },
        }
    }
</script>
