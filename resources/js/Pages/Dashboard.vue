<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TasksTable from '@/Pages/Task/TasksTable.vue';
import { useTasks } from '@/stores/tasks';
import { onMounted } from 'vue';

const taskStore = useTasks();

onMounted(() => {
    taskStore.fetchTasks();
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Task Manager
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <TasksTable :tasks="taskStore.tasks" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
