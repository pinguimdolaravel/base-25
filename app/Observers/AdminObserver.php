<?php

declare(strict_types = 1);

namespace App\Observers;

use App\Events\AskForReasonEvent;
use App\Models\AdminUpdate;
use App\Models\Role;

class AdminObserver
{
    public function updating(Role $model): void
    {
        if (auth()->user()->is_admin) {
            $update = AdminUpdate::create([
                'model'    => class_basename($model),
                'model_id' => $model->id,
                'changes'   => $model->getChanges(),
            ]);
            AskForReasonEvent::dispatch($update->id);
        }
    }
}
