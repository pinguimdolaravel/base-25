<?php

declare(strict_types = 1);

use App\Brain\Auth\Processes\AuthProcess;
use Illuminate\Support\Facades\Bus;

use function Pest\Laravel\get;

it('should call AuthProcess', function () {
    Bus::fake();

    get(route('2fa.magic-link', ['token' => 'test-token']));

    Bus::assertDispatched(AuthProcess::class);
});

it('should redirect to dashboard on success', function () {
    Bus::fake([AuthProcess::class]);

    $response = get(route('2fa.magic-link', ['token' => 'valid-token']));

    $response->assertRedirect(route('dashboard'));
});

it('should redirect to login when invalid token', function () {
    $response = get(route('2fa.magic-link', ['token' => 'invalid-token']));

    $response->assertRedirect(route('login'));
});
