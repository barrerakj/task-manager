<script setup>
import { computed } from 'vue';

const props = defineProps({
    // Array of objects to display in the table
    items: {
        type: Array,
        required: true,
        default: () => []
    },
    // Array of column definitions
    columns: {
        type: Array,
        required: true,
        default: () => []
    },
    // Whether to show actions column
    hasActions: {
        type: Boolean,
        default: true
    }
});

// Helper function to get nested object value
const getNestedValue = (obj, path) => {
    return path.split('.').reduce((current, key) => 
        current ? current[key] : undefined, obj
    );
};

// Define emits
defineEmits(['edit', 'delete']);
</script>

<template>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <!-- Table Header -->
            <thead class="bg-gray-50">
                <tr>
                    <th v-for="column in columns" 
                        :key="column.key"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    >
                        {{ column.label }}
                    </th>
                    <th v-if="hasActions" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(item, index) in items" :key="index" class="hover:bg-gray-50">
                    <td v-for="column in columns" 
                        :key="column.key"
                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                    >
                        <!-- Custom cell slot if provided -->
                        <slot :name="column.key" :item="item" :value="getNestedValue(item, column.key)">
                            {{ getNestedValue(item, column.key) }}
                        </slot>
                    </td>
                    <!-- Actions column -->
                    <td v-if="hasActions" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <slot name="actions" :item="item">
                            <button 
                                @click="$emit('edit', item)"
                                class="text-indigo-600 hover:text-indigo-900 mr-2"
                            >
                                Edit
                            </button>
                            <button 
                                @click="$emit('delete', item)"
                                class="text-red-600 hover:text-red-900"
                            >
                                Delete
                            </button>
                        </slot>
                    </td>
                </tr>
                <!-- Empty state -->
                <tr v-if="!items.length">
                    <td :colspan="columns.length + (hasActions ? 1 : 0)" class="px-6 py-4 text-center text-gray-500">
                        <slot name="empty">
                            No items found.
                        </slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>