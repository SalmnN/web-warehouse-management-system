<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Welcome Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl md:col-span-3 border border-gray-100">
                    <div class="p-8 text-gray-900">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back!</h3>
                        <p class="text-gray-600">You are logged in to the Warehouse Management System. Use the navigation menu to manage your inventory.</p>
                        
                        <div class="mt-6 flex flex-wrap gap-4">
                            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                                Add New Product
                            </a>
                            <a href="{{ route('incoming-items.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">
                                Record Incoming
                            </a>
                            <a href="{{ route('outgoing-items.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                                Record Outgoing
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
