<?php

namespace Kizi\Core\Models\Traits\Approval;

use Illuminate\Database\Eloquent\Model;

class ApprovableObserver
{
    public function creating(Model $model)
    {
        $this->suspendIfApprovalStatusIsNotInitialized($model);
    }

    public function updating(Model $model)
    {
        $this->suspendIfHasApprovalRequiredModification($model);
    }

    protected function suspendIfApprovalStatusIsNotInitialized(Model $model)
    {
        if ($model->isDirty($model->getApprovalStatusColumn())) {
            return;
        }
        $this->suspend($model);
    }

    protected function suspendIfHasApprovalRequiredModification(Model $model)
    {
        $modifiedAttributes = array_keys(
            $model->getDirty()
        );
        foreach ($modifiedAttributes as $name) {
            if ($model->isApprovalRequired($name)) {
                $this->suspend($model);
                return;
            }
        }
    }

    protected function suspend(Model $model)
    {
        $model->setAttribute(
            $model->getApprovalStatusColumn(),
            ApprovalStatuses::PENDING
        );
    }
}
