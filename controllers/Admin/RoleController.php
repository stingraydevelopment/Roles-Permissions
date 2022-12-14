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
 * Admin Role Controller
 * Admin controller to manage roles.
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
     * Admin roles main index page.
     * 
     * @return View
     */
    public function index()
    {
        return view('admin.roles');
    }
}
