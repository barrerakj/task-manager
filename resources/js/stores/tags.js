import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useTags = defineStore('tags', () => {
    const tags = ref([])

    // Get all tags
    const fetchTags = async () => {
        try {
            const response = await axios.get('/api/tags')
            tags.value = response.data
        } catch (error) {
            console.error('Error fetching tags:', error)
        }
    }

    // Create a new tag
    const createTag = async (tagData) => {
        try {
            const response = await axios.post('/api/tags', tagData)
            tags.value.push(response.data)
            return response.data
        } catch (error) {
            console.error('Error creating tag:', error)
            throw error
        }
    }

    // Update an existing tag
    const updateTag = async (id, tagData) => {
        try {
            const response = await axios.put(`/api/tags/${id}`, tagData)
            const index = tags.value.findIndex(tag => tag.id === id)
            if (index !== -1) {
                tags.value[index] = response.data
            }
            return response.data
        } catch (error) {
            console.error('Error updating tag:', error)
            throw error
        }
    }

    // Delete a tag
    const deleteTag = async (id) => {
        try {
            await axios.delete(`/api/tags/${id}`)
            const index = tags.value.findIndex(tag => tag.id === id)
            if (index !== -1) {
                tags.value.splice(index, 1)
            }
        } catch (error) {
            console.error('Error deleting tag:', error)
            throw error
        }
    }

    return {
        tags,
        fetchTags,
        createTag,
        updateTag,
        deleteTag
    }
})