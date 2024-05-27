<script setup>
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="タイトル">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タイトル
                </h2>
        </template>


        <a :href="route('dashboard.title')">
                            てすと
                        </a>


        <a :href="route('dashboard.menu')">test</a>
                            
                            
                            
                        
    </AppLayout>
</template>