<div>
    <!-- Manage Team Members -->
    <div class="mt-10 sm:mt-0">
        <x-action-section>
            <x-slot name="title">
                {{ __('Manage Roles') }}
            </x-slot>

            <x-slot name="description">
                {{ __('All of the roles with the respective permissions.') }}
            </x-slot>

            <!-- Team Member List -->
            <x-slot name="content">
                <div class="space-y-6">
                    @foreach($roles as $role)
                        <div class="flex items-center justify-between">
                            <div class="break-all dark:text-white">
                                {{ $role->name }}
                            </div>
                            <div class="flex items-center ms-2">
                                <div class="text-sm text-gray-400">
                                    ({{ $role->users_count }}) {{ Str::plural('User', $role->users_count) }}
                                </div>

                                <x-confirms-password wire:then="manageRolePermissions({{ $role->id }})">
                                    <button type="button" class="cursor-pointer ms-6 text-sm text-gray-400 underline">
                                        {{ __('Permissions') }}
                                    </button>
                                </x-confirms-password>

                                <x-confirms-password wire:then="confirmRoleDeletion({{ $role->id }})">
                                    <button type="button" class="cursor-pointer ms-6 text-sm text-red-500">
                                        {{ __('Delete') }}
                                    </button>
                                </x-confirms-password>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-action-section>
    </div>

    <!-- Edit Role Modal -->
    <x-dialog-modal wire:model="managingRole">
        <x-slot name="title">
            {{ __('Edit Role') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid gap-4">
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div>
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
            </div>
        </x-slot>

        <x-slot:footer>
            <x-secondary-button wire:click="$toggle('managingRole')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('Update Role') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Role Confirmation Modal -->
    <x-confirmation-modal wire:model="confirmingRoleRemoval">
        <x-slot name="title">
            {{ __('Delete Role') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this role?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingRoleRemoval')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-2" wire:click="deleteRole" wire:loading.attr="disabled">
                {{ __('Delete Role') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
