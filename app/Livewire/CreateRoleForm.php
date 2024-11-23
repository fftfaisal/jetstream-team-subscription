<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateRoleForm extends Component
{
    public $permissions = [];

    public $name = '';

    public $selectingAllPermissions = false;

    public $selectedPermissions = [];

    protected $rules = [
        'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        'selectedPermissions' => ['required', 'array'],
        'selectedPermissions.*' => ['integer', 'exists:permissions,id'],
    ];

    public function mount($permissions): void
    {
        $this->permissions = $permissions;
    }

    public function updatedSelectingAllPermissions(): void
    {
        $this->selectedPermissions = $this->selectingAllPermissions ? $this->permissions->pluck('id')->toArray() : [];
    }

    public function createRole(): void
    {
        $this->validate(messages: [
            'selectedPermissions.required' => 'At least one permission is required.',
        ]);

        Role::create(['name' => $this->name])->permissions()->attach($this->selectedPermissions);

        $this->reset('name', 'selectedPermissions', 'selectingAllPermissions');

        $this->dispatch('role-created');
    }

    public function render(): View
    {
        return view('permissions.create-role-form');
    }
}
