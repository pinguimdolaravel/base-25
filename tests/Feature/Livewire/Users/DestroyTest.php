<?php

declare(strict_types = 1);

use App\Brain\User\Tasks\DestroyUser;
use App\Livewire\Users\Destroy;
use Illuminate\Support\Facades\Bus;
use Livewire\Livewire;

it('should check if the task is being called', function () {
    Bus::fake([DestroyUser::class]);
    $user = App\Models\User::factory()->create();

    Livewire::test(Destroy::class)
        ->call('open', $user->id)
        ->call('handle');

    Bus::assertDispatched(DestroyUser::class);
});
