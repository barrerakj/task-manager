import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useCategories = defineStore('categories', () => {
    const categories = ref([])

    // Get all categories
    const fetchCategories = async () => {
        try {
            const response = await axios.get('/api/categories')
            categories.value = response.data
        } catch (error) {
            console.error('Error fetching categories:', error)
        }
    }

    // Create a new category
    const createCategory = async (categoryData) => {
        try {
            const response = await axios.post('/api/categories', categoryData)
            categories.value.push(response.data)
            return response.data
        } catch (error) {
            console.error('Error creating category:', error)
            throw error
        }
    }

    // Update an existing category
    const updateCategory = async (id, categoryData) => {
        try {
            const response = await axios.put(`/api/categories/${id}`, categoryData)
            const index = categories.value.findIndex(category => category.id === id)
            if (index !== -1) {
                categories.value[index] = response.data
            }
            return response.data
        } catch (error) {
            console.error('Error updating category:', error)
            throw error
        }
    }

    // Delete a category
    const deleteCategory = async (id) => {
        try {
            await axios.delete(`/api/categories/${id}`)
            const index = categories.value.findIndex(category => category.id === id)
            if (index !== -1) {
                categories.value.splice(index, 1)
            }
        } catch (error) {
            console.error('Error deleting category:', error)
            throw error
        }
    }

    return {
        categories,
        fetchCategories,
        createCategory,
        updateCategory,
        deleteCategory
    }
})