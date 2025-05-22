<script setup>
import { ref, watch, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useTasks } from '@/stores/tasks';
import { useCategories } from '@/stores/categories';

const props = defineProps({
    show: {
        type: Boolean,
        required: true
    },
    task: {
        type: Object,
        default: () => ({
            id: null,
            title: '',
            content: '',
            due_date: '',
            category_id: '',
            is_completed: false
        })
    }
});

const emit = defineEmits(['close']);

const taskStore = useTasks();
const categoryStore = useCategories();

const getDefaultTask = () => ({
    id: null,
    title: '',
    content: '',
    due_date: '',
    category_id: '',
    is_completed: false,
    user_id: 1
});

const form = ref({
    title: props.task?.title ?? '',
    content: props.task?.content ?? '',
    due_date: props.task?.due_date ?? '',
    category_id: props.task?.category_id ?? '',
    is_completed: props.task?.is_completed ?? false,
    user_id: 1
});

// Watch for changes in the task prop
watch(() => props.task, (newTask) => {
    const defaultTask = getDefaultTask();
    form.value = {
        title: newTask?.title ?? defaultTask.title,
        content: newTask?.content ?? defaultTask.content,
        due_date: newTask?.due_date ?? defaultTask.due_date,
        category_id: newTask?.category_id ?? defaultTask.category_id,
        is_completed: newTask?.is_completed ?? defaultTask.is_completed,
        user_id: 1
    };
}, { deep: true });

const errors = ref({});
const processing = ref(false);

onMounted(() => {
    categoryStore.fetchCategories();
});

const handleSubmit = async () => {
    processing.value = true;
    errors.value = {};

    try {
        if (props.task.id) {
            await taskStore.updateTask(props.task.id, form.value);
        } else {
            await taskStore.createTask(form.value);
        }
        emit('close');
    } catch (error) {
        if (error.response?.data?.errors) {
            errors.value = error.response.data.errors;
        } else {
            console.error('Error submitting task:', error);
        }
    } finally {
        processing.value = false;
    }
};
</script>

<template>
    <Modal :show="show" @close="emit('close')">
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                {{ task.id ? 'Edit Task' : 'Add Task' }}
            </div>

            <div class="mt-4">
                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div>
                        <InputLabel for="title" value="Title" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <InputError v-if="errors.title" :message="errors.title[0]" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="content" value="Content" />
                        <textarea
                            id="content"
                            v-model="form.content"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            rows="3"
                        />
                        <InputError v-if="errors.content" :message="errors.content[0]" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="due_date" value="Due Date" />
                        <TextInput
                            id="due_date"
                            v-model="form.due_date"
                            type="date"
                            class="mt-1 block w-full"
                        />
                        <InputError v-if="errors.due_date" :message="errors.due_date[0]" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="category_id" value="Category" />
                        <select
                            id="category_id"
                            v-model="form.category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">Select Category</option>
                            <option 
                                v-for="category in categoryStore.categories" 
                                :key="category.id" 
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <InputError v-if="errors.category_id" :message="errors.category_id[0]" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <input
                            id="is_completed"
                            v-model="form.is_completed"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        />
                        <InputLabel for="is_completed" value="Mark as completed" class="ml-2" />
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
            <SecondaryButton @click="emit('close')" :disabled="processing">
                Cancel
            </SecondaryButton>

            <PrimaryButton
                class="ml-3"
                :class="{ 'opacity-25': processing }"
                :disabled="processing"
                @click="handleSubmit"
            >
                {{ task.id ? 'Update' : 'Create' }}
            </PrimaryButton>
        </div>
    </Modal>
</template>