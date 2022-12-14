<?php

namespace Stingraydevelopment\RolesAndPermissions;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Stingraydevelopment\RolesAndPermissions\Skeleton\SkeletonClass
 */
class RolesAndPermissionsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'roles-and-permissions';
    }
}
