<?php

use App\Livewire\ManagePermisson;
use App\Livewire\ManageRole;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ManageRole::class, ['roles' => [], 'permissions' => []])
        ->assertStatus(200);
});
