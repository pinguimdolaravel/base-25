<?php

declare(strict_types = 1);

namespace App\AuditResolvers;

use Illuminate\Support\Facades\Context;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\Resolver;

class ImpersonatorResolver implements Resolver
{
    public static function resolve(Auditable $auditable)
    {
        return Context::get('impersonator_id', null);
    }
}
