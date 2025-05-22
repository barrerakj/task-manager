<script setup>
    import Table from '@/Components/Table.vue';
    import { onMounted } from 'vue';

    const props = defineProps({
        tasks: {
            type: Array,
            required: true
        }
    });

    console.log('Tasks:', props.tasks);

    const columns = [
        { key: 'id', label: 'ID' },
        { key: 'title', label: 'Title' },
        { key: 'content', label: 'Content' },
        { key: 'is_completed', label: 'Status' },
        { key: 'created_at', label: 'Created' },
        { key: 'due_date', label: 'Due Date' },
    ];

    const handleEdit = (item) => {
        console.log('Edit:', item);
    };

    const handleDelete = (item) => {
        console.log('Delete:', item);
    };
</script>

<template>
    <Table 
        :items="props.tasks" 
        :columns="columns"
        @edit="handleEdit"
        @delete="handleDelete"
    >
        <!-- Custom slot for status column -->
        <template #status="{ value }">
            <span :class="value === 'active' ? 'text-green-600' : 'text-red-600'">
                {{ value }}
            </span>
        </template>
        
        <!-- Custom actions -->
        <template #actions="{ item }">
            <button @click="viewDetails(item)" class="text-blue-600 hover:text-blue-900 mr-2">
                View
            </button>
            <button @click="editUser(item)" class="text-indigo-600 hover:text-indigo-900">
                Edit
            </button>
        </template>
    </Table>
</template>

