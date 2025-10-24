<?php

namespace App\Observers;

use App\Models\UserActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ActivityLogObserver
{
    public function created(Model $model): void
    {
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'module_name' => get_class($model),
            'action_type' => 'created',
            'action_details' => "Added a new record.",
            'old_value' => [],
            'new_value' => $model->except(['created_at', 'updated_at'])
        ]);
    }

    public function updated(Model $model): void
    {
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'module_name' => get_class($model),
            'action_type' => 'updated',
            'action_details' => "Updated a record.",
            'old_value' => Arr::except($model->getOriginal(), ['created_at', 'updated_at']),
            'new_value' => Arr::except($model->getAttributes(), ['created_at', 'updated_at']),
        ]);
    }

    public function deleted(Model $model): void
    {
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'module_name' => get_class($model),
            'action_type' => 'deleted',
            'action_details' => "Deleted a record.",
            'old_value' => $model->except(['created_at', 'updated_at']),
            'new_value' => []
        ]);
    }
}