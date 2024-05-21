<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="タイトル">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タイトル
            </h2>
        </template>
        <template #default="{ dashboardTitleUrl, dashboardMenuUrl }">
            <!-- 変数からURLを使用 -->
            <a :href="dashboardTitleUrl">Title View</a>
            <a :href="dashboardMenuUrl">Menu View</a>
        </template>
    </AppLayout>
</template>
