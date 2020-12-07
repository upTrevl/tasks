<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between items-center">
                <div>
                    Задачи
                </div>
                <div class="search-wrap">
                    <input type="text" placeholder="Начните вводить..." class="search-input border-gray-100"
                           v-model="search">
                    <div v-if="showRes" v-click-outside="hide" class="shadow-2xl search-res flex flex-col">
                        <span class="mb-4">Результаты поиска:</span>
                        <div v-for="res in searchRes">
                            <a :href="route('task.show',{task:res})"
                               class="search-item flex grid grid-cols-6  py-4 border-b border-gray-200 rounded-sm text-gray-800">
                                <div class="col-span-2">{{res.client_name}}</div>
                                <div>{{res.client_org}}</div>
                                <div>{{res.client_phone}}</div>
                                <div class="font-bold">{{res.car_number}}</div>
                                <div>
                                    <TaskStatus :status="res.status"/>
                                </div>
                            </a>
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
    import Vue from 'vue';

    Vue.directive('click-outside', {
        bind: function (el, binding, vnode) {
            window.event = function (event) {
                if (!(el == event.target || el.contains(event.target))) {
                    vnode.context[binding.expression](event);
                }
            };
            document.body.addEventListener('click', window.event)
        },
        unbind: function (el) {
            document.body.removeEventListener('click', window.event)
        },
    });
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import TaskList from '@/Pages/Task/TaskList'
    import JetButton from '@/Jetstream/Button'
    import JetNavLink from "@/Jetstream/NavLink";
    import TaskStatus from "@/Pages/Task/TaskStatus";

    export default {
        components: {
            AppLayout,
            Welcome,
            JetButton,
            JetNavLink,
            TaskList,
            TaskStatus,
        },
        data() {
            return {
                tasks: [],
                search: '',
                searchRes: [],
                showRes: false
            }
        },
        mounted: function () {
            this.getCreatedTasks();
        },
        methods: {
            getCreatedTasks: function () {
                axios
                    .get('/tasks')
                    .then(response => (
                        this.tasks = response.data
                    ));
            },
            getSearchRes: function (val) {
                if (this.search !== '') {
                    axios.get('/search/' + this.search)
                        .then(response => {
                            this.searchRes = response.data;
                            this.showRes = true;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    this.showRes = false;
                }

            },
            hide: function () {
                this.showRes = false;
            }
        },
        watch: {
            search: function () {
                this.getSearchRes(this.search);
            },
            searchRes: function () {
                console.log(this.searchRes);
            },
        },
    }
</script>
