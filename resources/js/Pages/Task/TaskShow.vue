<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex justify-between">
                Гос. номер
                <div class="uppercase">
                    {{task.car_number}}
                </div>

            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white grid grid-cols-3">
                        <div class="pl-6 border-r border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Клиент:</h2>
                            <div class="info-item pb-2">
                                {{task.client_name}}
                            </div>
                            <div class="info-item pb-2">
                                {{task.client_phone}}
                            </div>
                            <div class="info-item">
                                {{task.client_org}}
                            </div>

                        </div>
                        <div class="pl-6 border-r border-gray-200">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Машина:</h2>
                            <div class="info-item pb-2">
                                {{task.car_name}}
                            </div>
                            <div class="info-item pb-2">
                                {{task.car_number}}
                            </div>

                        </div>
                        <div class="pl-6">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Описание:</h2>
                            <div class="info-item desc pb-2">
                                {{task.description}}
                            </div>

                        </div>
                    </div>
                    <task-form-accept v-if="task.status==='open'" @submitted="taskAccept">
                        <template #form>
                            <jet-input type="hidden" v-model="form.user"/>
                        </template>
                        <template #actions>
                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                                Задача успешно принята
                            </jet-action-message>
                            <jet-button v-if="task.status==='open'" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                Принять
                            </jet-button>

                        </template>
                    </task-form-accept>
                    <task-form-accept v-if="task.status==='process'" @submitted="taskClose">
                        <template #form>
                            <jet-input type="hidden" v-model="form.user"/>
                        </template>
                        <template #actions>
                            <div v-if="task.status==='process'" class="mr-3">
                                Задача принята <span v-if="task.edit_by===user.id" class="mr-4">Вами</span>
                                <jet-button v-if="task.status==='process'"
                                            :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                                    Закрыть
                                </jet-button>
                            </div>
                            <div v-if="task.status==='close'" class="mr-3">
                                Задача закрыта
                            </div>
                        </template>
                    </task-form-accept>
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
    import JetActionMessage from "@/Jetstream/ActionMessage";
    import JetFormSection from "@/Jetstream/FormSection";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetLabel from "@/Jetstream/Label";
    import JetSecondaryButton from "@/Jetstream/SecondaryButton";
    import TaskFormAccept from "@/Pages/Task/TaskFormAccept";

    export default {
        components: {
            AppLayout,
            Welcome,
            JetNavLink,
            TaskList,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            TaskFormAccept
        },
        props: ['task', 'user'],
        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    user: this.user.id,
                    task_id: this.task.id,
                }, {
                    bag: 'taskAccept',
                    resetOnSuccess: false,
                }),

                photoPreview: null,
            }
        },
        mounted: function () {

        },
        methods: {
            taskAccept() {
                this.form.post(route('task.accept'), {
                    preserveScroll: true
                });
            },
            taskClose() {
                this.form.post(route('task.close'), {
                    preserveScroll: true
                });
            }
        },
    }
</script>
