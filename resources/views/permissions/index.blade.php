<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles & Permissions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        @livewire('CreateRoleForm', ['permissions' => $permissions])

        <x-section-border />

        @livewire('ManageRole', ['roles' => $roles, 'permissions' => $permissions])
    </div>
</x-app-layout>
