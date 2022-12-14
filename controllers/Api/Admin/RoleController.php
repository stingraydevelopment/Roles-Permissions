<?php

/**
 * PHP Version 7.4.9
 * 
 * @category Controllers
 * @package  Equus
 * @author   Dan Castanera <dan@ctsfla.com>
 * @license  https://ctsfla.com/equus/proprietary-license Proprietary
 * @link     https://ctsfla.com/equus
 */

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

/**
 * Admin API Role Controller
 * Admin controller for API calls to manage Roles.
 * 
 * @category Controllers
 * @package  Equus
 * @author   Dan Castanera <dan@ctsfla.com>
 * @license  https://ctsfla.com/equus/proprietary-license Proprietary
 * @link     https://ctsfla.com/equus
 */
class RoleController extends Controller
{
    /**
     * Delete Role
     * 
     * @param Object $request 
     * 
     * @return Array Role objects from the get function.
     */
    public function delete(Request $request)
    {
        $role = Role::find($request->id);
        $role->delete();

        return $this->get();
    }

    /**
     * Filter Roles
     * 
     * @param Object $request 
     * 
     * @return Array Filtered roles.
     */
    public function filter(Request $request)
    {
        return Role::where('name', 'like', '%' . $request->filter . '%')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get Roles
     * 
     * @return Array All active Roles.
     */
    public function get()
    {
        return Role::whereNull('deleted_at')->where('id', '!=', '1')->get();
    }

    /**
     * Insert Role
     * 
     * @param Object $request Contains role data
     * 
     * @return Array Role objects from the get function.
     */
    public function insert(Request $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permission_ids);
        return $this->get();
    }

    /**
     * Update Role
     * 
     * @param Object $request Contains role data
     * 
     * @return Array Role objects from the get function.
     */
    public function update(Request $request)
    {
        $role = Role::find($request->id);
        $role->update($request->all());
        $role->save();
        $role->permissions()->sync($request->permission_ids);
        return $this->get();
    }
}
