<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Laravel\Jetstream\ConfirmsPasswords;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ManageRole extends Component
{
    use ConfirmsPasswords, WithPagination;

    public $permissions;

    public $selectedPermissions = [];

    public $name;

    public $managingRoleFor;

    public $roleIdBeingDeleted;

    public $managingRole = false;

    public $selectingAllPermissions = false;

    public $confirmingRoleRemoval = false;

    protected $listeners = [
        'role-created' => '$refresh',
        'role-updated' => '$refresh',
        'role-deleted' => '$refresh',
    ];

    public function mount($permissions): void
    {
        $this->permissions = $permissions;
    }

    public function manageRolePermissions($roleId): void
    {
        $this->ensurePasswordIsConfirmed();
        $this->managingRole = true;
        $this->managingRoleFor = Role::findOrFail($roleId);
        $this->name = $this->managingRoleFor->name;
        $this->selectedPermissions = $this->managingRoleFor->permissions->pluck('id')->toArray();
    }

    public function updateRole(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($this->managingRoleFor->id)],
            'selectedPermissions' => ['required', 'array'],
            'selectedPermissions.*' => ['integer', 'exists:permissions,id'],
        ], [
            'selectedPermissions.required' => 'At least one permission is required.',
        ]);

        $this->managingRoleFor->update(['name' => $this->name]);
        $this->managingRoleFor->permissions()->sync($this->selectedPermissions);
        $this->managingRole = false;

        $this->dispatch('role-updated');
    }

    public function updatedSelectingAllPermissions(): void
    {
        $this->selectedPermissions = $this->selectingAllPermissions ? $this->permissions->pluck('id')->toArray() : [];
    }

    public function confirmRoleDeletion($roleId): void
    {
        $this->confirmingRoleRemoval = true;

        $this->roleIdBeingDeleted = $roleId;
    }

    public function deleteRole(): void
    {
        $this->ensurePasswordIsConfirmed();
        $this->confirmingRoleRemoval = false;
        $role = Role::find($this->roleIdBeingDeleted);

        if (! $role || $role->team_id !== Auth::user()->currentTeam->id) {
            $this->dispatch('role-error');
            return;
        }

        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        $this->dispatch('role-deleted');
    }

    public function render(): View
    {
        $roles = Role::with('permissions')
            ->where('team_id', Auth::user()->currentTeam->id)
            ->withCount('users')
            ->paginate();

        return view('permissions.manage-role', compact('roles'));
    }
}
