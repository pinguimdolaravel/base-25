<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Enums\Can;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Override;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    #[Override]
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->setupLogViewer();
        $this->configModels();
        $this->configCommands();
        $this->configUrls();
        $this->configDate();
        $this->configGates();
    }

    /**
     * Sets up the LogViewer authentication to restrict access
     * based on whether the authenticated user is an admin.
     */
    private function setupLogViewer(): void
    {
        // LogViewer::auth(fn ($request) => $request->user()?->is_admin);
    }

    /**
     * Configures Eloquent models by disabling the requirement for defining
     * the fillable property and enforcing strict checking to ensure that
     * all accessed properties exist within the model.
     */
    private function configModels(): void
    {
        // --
        // Remove the need of the property fillable on each model
        Model::unguard();

        // --
        // Make sure that all properties being called exists in the model
        Model::shouldBeStrict();

        // ---
        // Automatically eager load relationships
        // Luan:: cuidado com tabelas grandes pq nao filtra por coluna
        Model::automaticallyEagerLoadRelationships();
    }

    /**
     * Configures database commands to prohibit execution of destructive statements
     * when the application is running in a production environment.
     */
    private function configCommands(): void
    {
        DB::prohibitDestructiveCommands(
            app()->isProduction()
        );
    }

    /**
     * Configures the application URLs to enforce HTTPS protocol for all routes.
     */
    private function configUrls(): void
    {
        URL::forceHttps();
    }

    /**
     * Configures the application to use CarbonImmutable for date and time handling.
     */
    private function configDate(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configGates(): void
    {
        foreach (Can::cases() as $permission) {
            Gate::define(
                $permission->value,
                function ($user) use ($permission) {
                    $check = $user
                        ->permissions()
                        ->whereName($permission->value)
                        ->exists();

                    Log::info('Checking permission: ' . $permission->value, ['user' => $user->id, 'check' => $check ? 'true' : 'false']);

                    return $check;
                }
            );
        }
    }
}
