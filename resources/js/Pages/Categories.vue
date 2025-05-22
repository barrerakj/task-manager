<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CategoriesTable from '@/Pages/Category/CategoriesTable.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <CategoriesTable />
                </div>
            </div>
        </div>
    </AppLayout>
</template>