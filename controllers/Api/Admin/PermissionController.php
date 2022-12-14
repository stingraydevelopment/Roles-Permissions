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

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

/**
 * Admin API Permission Controller
 * Admin controller for API calls to manage Permissions.
 * 
 * @category Controllers
 * @package  Equus
 * @author   Dan Castanera <dan@ctsfla.com>
 * @license  https://ctsfla.com/equus/proprietary-license Proprietary
 * @link     https://ctsfla.com/equus
 */
class PermissionController extends Controller
{
    /**
     * Delete Permission
     * 
     * @param Object $request 
     * 
     * @return Array Permission objects from the get function.
     */
    public function delete(Request $request)
    {
        $permission = Permission::find($request->id);
        $permission->delete();

        return $this->get();
    }

    /**
     * Filter Permissions
     * 
     * @param Object $request 
     * 
     * @return Array Filtered permissions.
     */
    public function filter(Request $request)
    {
        return Permission::where('name', 'like', '%' . $request->filter . '%')
            ->orderBy('name')
            ->get();
    }

    /**
     * Get Permissions
     * 
     * @return Array All active Permissions.
     */
    public function get()
    {
        return Permission::whereNull('deleted_at')->get();
    }

    /**
     * Insert Permission
     * 
     * @param Object $request Contains permission data
     * 
     * @return Array Permission objects from the get function.
     */
    public function insert(Request $request)
    {
        $permission = Permission::create($request->all());
        return $this->get();
    }

    /**
     * Update Permission
     * 
     * @param Object $request Contains permission data
     * 
     * @return Array Permission objects from the get function.
     */
    public function update(Request $request)
    {
        $permission = Permission::find($request->id);
        $permission->update($request->all());
        $permission->save();
        return $this->get();
    }
}
