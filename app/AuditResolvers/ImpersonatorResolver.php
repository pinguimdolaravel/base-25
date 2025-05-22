<?php

declare(strict_types = 1);

namespace App\AuditResolvers;

use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;

class ImpersonatorResolver implements Resolver
{
    public static function resolve(Auditable $auditable)
    {
        return Session::get('impersonator_id') ?? null;
    }
}
