<script setup>
    import Table from '@/Components/Table.vue';
    import TasksAddEditModal from './TasksAddEditModal.vue';
    import { ref } from 'vue';
    import { useTasks } from '@/stores/tasks';

    const props = defineProps({
        tasks: {
            type: Array,
            required: true
        }
    });

    const taskStore = useTasks();
    const showModal = ref(false);
    const selectedTask = ref(null);

    const columns = [
        { key: 'id', label: 'ID' },
        { key: 'title', label: 'Title' },
        { key: 'content', label: 'Content' },
        { key: 'category.name', label: 'Category' },
        { key: 'is_completed', label: 'Status' },
        { key: 'created_at', label: 'Created' },
        { key: 'due_date', label: 'Due Date' },
    ];

    const handleEdit = (task) => {
        selectedTask.value = task;
        showModal.value = true;
    };

    const handleDelete = async (task) => {
        if (confirm('Are you sure you want to delete this task?')) {
            await taskStore.deleteTask(task.id);
        }
    };

    const handleAddNew = () => {
        selectedTask.value = {
            id: null,
            title: '',
            content: '',
            due_date: '',
            category_id: '',
            is_completed: false
        };
        showModal.value = true;
    };

    const closeModal = () => {
        showModal.value = false;
        selectedTask.value = null;
    };
</script>

<template>
    <div>
        <div class="m-4 flex justify-end">
            <button
                @click="handleAddNew"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Add New Task
            </button>
        </div>

        <Table 
            :items="props.tasks" 
            :columns="columns"
            @edit="handleEdit"
            @delete="handleDelete"
        >
            <!-- Custom slot for status column -->
            <template #is_completed="{ value }">
                <span :class="value ? 'text-green-600' : 'text-red-600'">
                    {{ value ? 'Completed' : 'Pending' }}
                </span>
            </template>
        </Table>

        <TasksAddEditModal
            :show="showModal"
            :task="selectedTask"
            @close="closeModal"
        />
    </div>
</template>

