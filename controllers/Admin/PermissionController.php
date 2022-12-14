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

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Admin Permission Controller
 * Admin controller to manage permissions.
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
     * Admin permission main index page.
     * 
     * @return View
     */
    public function index()
    {
        return view('admin.permissions');
    }
}
