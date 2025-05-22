<script setup>
    import Table from '@/Components/Table.vue';

    const users = [
        { id: 1, name: 'John Doe', email: 'john@example.com', status: 'active' },
        { id: 2, name: 'Jane Smith', email: 'jane@example.com', status: 'inactive' },
    ];

    const columns = [
        { key: 'name', label: 'Name' },
        { key: 'email', label: 'Email' },
        { key: 'status', label: 'Status' },
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
        :items="users" 
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