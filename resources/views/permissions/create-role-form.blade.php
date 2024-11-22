<div>
    <!-- Add new Role -->
    <div class="mt-10 sm:mt-0">
        <x-form-section submit="createRole">
            <x-slot name="title">
                {{ __('Create Role') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Add a new role for the site users, allowing it to control user ability.') }}
            </x-slot>

            <x-slot name="form">
                <!-- Role -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>

                <!-- Description -->
{{--                <div class="col-span-6 sm:col-span-4">--}}
{{--                    <x-label for="description" value="{{ __('Description') }}" />--}}
{{--                    <x-input id="description" type="text" class="mt-1 block w-full" wire:model="description" />--}}
{{--                    <x-input-error for="description" class="mt-2" />--}}
{{--                </div>--}}

                <!-- Permissions -->
                <div class="col-span-6 sm:col-span-6">
                    <div class="flex items-center mb-3">
                        <x-label for="permissions" value="{{ __('Permissions') }}" />
                        <label class="flex items-center ms-5">
                            <x-checkbox wire:model.live="selectingAllPermissions" />
                            <span class="ml-2">{{ __('Select All') }}</span>
                        </label>
                    </div>
                    <div class="mt-1 grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($permissions as $permission)
                            <label class="flex items-center">
                                <x-checkbox wire:model="selectedPermissions" value="{{ $permission->id }}" />
                                <span class="ml-2">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error for="selectedPermissions" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-action-message class="text-green-600 me-3" on="role-created">
                    {{ __('Role created.') }}
                </x-action-message>

                <x-button>
                    {{ __('Add') }}
                </x-button>
            </x-slot>
        </x-form-section>
    </div>
</div>
