<template>
    <jet-form-section @submitted="saveTask">
        <template #title>
            Создание задачи
        </template>

        <template #description>
            Создайте новую задачу заполнив поля
        </template>

        <template #form>
            <jet-input type="hidden" v-model="form.create_by"/>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="client_name" value="ФИО Клиента"/>
                <jet-input id="client_name" type="text" class="mt-1 block w-full" v-model="form.client_name"
                           placeholder="Иванов Иван Иванович" autocomplete="client_name"/>
                <jet-input-error :message="form.error('client_name')" class="mt-2"/>
            </div>
            <!-- Phone -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="client_phone" value="Телефон Клиента"/>
                <div class="flex">
                    <span class="input-group-addon mt-1 block"><span>+7</span></span>
                    <jet-input id="client_phone" type="text" class="mt-1 block w-full phone-input"
                               v-model="form.client_phone"
                               placeholder="(914) 000-0000" v-phone autocomplete="client_phone"
                               pattern="[(][0-9]{3}[)] [0-9]{3}-[0-9]{4}" required/>
                    <jet-input-error :message="form.error('client_phone')" class="mt-2"/>
                </div>
            </div>
            <!-- Organization -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="client_org" value="Организация"/>
                <jet-input id="client_org" type="text" class="mt-1 block w-full" v-model="form.client_org"
                           placeholder="ООО Газпром" autocomplete="client_org"/>
                <jet-input-error :message="form.error('client_org')" class="mt-2"/>
            </div>
            <!-- Car mark -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="car_name" value="Марка машины"/>
                <jet-input id="car_name" type="text" class="mt-1 block w-full" v-model="form.car_name"
                           placeholder="Fiat Ducato" autocomplete="car_name"/>
                <jet-input-error :message="form.error('car_name')" class="mt-2"/>
            </div>
            <!-- Car number -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="car_number" value="Гос номер"/>
                <jet-input id="car_number" type="text" class="mt-1 block w-full car_num" v-model="form.car_number"
                           placeholder="A000AA03" autocomplete="car_number" v-uppercase/>
                <jet-input-error :message="form.error('car_number')" class="mt-2"/>
            </div>
            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="description" value="Описание заявки"/>
                <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none" rows="6"
                          id="description"
                          autocomplete="description" v-model="form.description">

                </textarea>
                <jet-input-error :message="form.error('description')" class="mt-2"/>
            </div>

        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Задача успешно создана
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Создать
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>

    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        name: "TaskFormCreate",
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },
        props: ['user'],
        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    client_name: '',
                    status: 'open',
                    client_phone: '',
                    client_org: '',
                    car_name: '',
                    car_number: '',
                    description: '',
                    create_by: this.user.id,
                }, {
                    bag: 'saveTask',
                    resetOnSuccess: false,
                }),

                photoPreview: null,
            }
        },

        methods: {
            saveTask() {
                this.form.post(route('task.store'), {
                    preserveScroll: true
                });
            },
        },

    }
</script>

<style scoped>

</style>
