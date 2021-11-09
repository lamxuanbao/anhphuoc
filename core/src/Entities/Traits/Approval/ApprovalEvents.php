<?php

namespace Kizi\Core\Models\Traits\Approval;

trait ApprovalEvents
{
    /**
     * Register a approving model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function approving($callback)
    {
        static::registerModelEvent('approving', $callback);
    }

    /**
     * Register a approved model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function approved($callback)
    {
        static::registerModelEvent('approved', $callback);
    }

    /**
     * Register a suspending model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function suspending($callback)
    {
        static::registerModelEvent('suspending', $callback);
    }

    /**
     * Register a suspended model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function suspended($callback)
    {
        static::registerModelEvent('suspended', $callback);
    }

    /**
     * Register a rejecting model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function rejecting($callback)
    {
        static::registerModelEvent('rejecting', $callback);
    }

    /**
     * Register a rejected model event with the dispatcher.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function rejected($callback)
    {
        static::registerModelEvent('rejected', $callback);
    }

    public function getObservableEvents()
    {
        return array_merge(parent::getObservableEvents(), [
            'approving',
            'suspending',
            'rejecting',
            'approved',
            'suspended',
            'rejected',
        ]);
    }
}
