import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useTasks = defineStore('tasks', () => {
    const tasks = ref([])

    // Get all tasks
    const fetchTasks = async () => {
        try {
            const response = await axios.get('/api/tasks')
            tasks.value = response.data
        } catch (error) {
            console.error('Error fetching tasks:', error)
        }
    }

    // Create a new task
    const createTask = async (taskData) => {
        try {
            const response = await axios.post('/api/tasks', taskData)
            tasks.value.push(response.data)
            return response.data
        } catch (error) {
            console.error('Error creating task:', error)
            throw error
        }
    }

    // Update an existing task
    const updateTask = async (id, taskData) => {
        try {
            const response = await axios.put(`/api/tasks/${id}`, taskData)
            const index = tasks.value.findIndex(task => task.id === id)
            if (index !== -1) {
                tasks.value[index] = response.data
            }
            return response.data
        } catch (error) {
            console.error('Error updating task:', error)
            throw error
        }
    }

    // Delete a task
    const deleteTask = async (id) => {
        try {
            await axios.delete(`/api/tasks/${id}`)
            const index = tasks.value.findIndex(task => task.id === id)
            if (index !== -1) {
                tasks.value.splice(index, 1)
            }
        } catch (error) {
            console.error('Error deleting task:', error)
            throw error
        }
    }

    return {
        tasks,
        fetchTasks,
        createTask,
        updateTask,
        deleteTask
    }
})