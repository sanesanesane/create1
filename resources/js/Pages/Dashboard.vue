<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="タイトル">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タイトル
            </h2>
        </template>

        <div class="py-12">
            <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('dashboard.title') }}">
                            <x-primary-button>
                                テスト
                            </x-primary-button>

                        </a>
                        </div>

                    <div class="mb-4">
                        <a href="{{ route('dashboard.menu') }}">
                            <x-primary-button>
                                テスト2
                            </x-primary-button>
                        </a>
                    </div>


                    

                    

</div>
</div>
</div>
</div>
        </div>
    </AppLayout>
</template>
