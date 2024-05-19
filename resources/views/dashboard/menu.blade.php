<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>
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
</x-app-layout>
