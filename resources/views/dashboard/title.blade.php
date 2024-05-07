<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Components/Welcome.vue';
    </script>
    
    <template>
        <AppLayout title="一覧メニュー">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    一覧メニュー
                </h2>
            </template>
    
            <div class="py-12">
                <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <a href="{{ route('subjects.create') }}">
                                <x-primary-button>
                                    科目
                                </x-primary-button>
                            </a>
                            </div>
    
                        <div class="mb-4">
                            <a href="{{ route('ages.create') }}">
                                <x-primary-button>
                                    年代
                                </x-primary-button>
                            </a>
                        </div>

                        <div class="mb-4">
                            <a href="{{ route('countries.create') }}">
                                <x-primary-button>
                                    地域
                                </x-primary-button>
                            </a>
                        </div>

                        <div class="mb-4">
                            <a href="{{ route('dashboard') }}">
                                <x-primary-button>
                                    戻る
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
    