<?php

declare(strict_types = 1);

namespace Tests\Models;

use App\Models\Login;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

test('hidden attributes', function (): void {
    $user = new User();

    $reflection = new ReflectionClass($user);
    $hidden     = $reflection->getProperty('hidden');
    $hidden->setAccessible(true);

    expect($hidden->getValue($user))->toBe([
        'password',
        'remember_token',
    ]);
});
/**
 * @throws ReflectionException
 */
test('casts method returns correct cast types', function (): void {
    $user = new User();

    $reflection = new ReflectionMethod($user, 'casts');

    $casts = $reflection->invoke($user);

    expect($casts)->toBe([
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_admin'          => 'boolean',
    ]);
});

test('permissions method returns belongs to many relationship', function (): void {
    $user = new User();

    $permissions = $user->permissions();

    expect($permissions)->toBeInstanceOf(BelongsToMany::class)
        ->and($permissions->getRelated())->toBeInstanceOf(Permission::class);
});

test('roles method returns belongs to many relationship', function (): void {
    $user = new User();

    $roles = $user->roles();

    expect($roles)->toBeInstanceOf(BelongsToMany::class)
        ->and($roles->getRelated())->toBeInstanceOf(Role::class);
});

test('logins method returns has many relationship', function (): void {
    $user = new User();

    $logins = $user->logins();

    expect($logins)->toBeInstanceOf(HasMany::class)
        ->and($logins->getRelated())->toBeInstanceOf(Login::class);
});

test('user implements auditable interface', function (): void {
    $user = new User();

    expect($user)->toBeInstanceOf(\OwenIt\Auditing\Contracts\Auditable::class);
});

test('user uses correct traits', function (): void {
    $user   = new User();
    $traits = class_uses_recursive($user::class);

    expect($traits)->toHaveKey(Auditable::class)
        ->and($traits)->toHaveKey(HasFactory::class)
        ->and($traits)->toHaveKey(Notifiable::class);
});
