<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Создание задачи
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div >
                    <FormCreate :user="$page.user"/>

                    <jet-section-border />
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormCreate from "@/Pages/Task/TaskFormCreate";
    import JetSectionBorder from "@/Jetstream/SectionBorder";
    export default {
        name: "TaskCreate",
        components: {
            AppLayout,
            FormCreate,
            JetSectionBorder,
        },

    }
</script>

<style scoped>

</style>
