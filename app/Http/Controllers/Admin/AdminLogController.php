<?php

/**
 * AdminLogController
 *
 * PHP version 8.1
 *
 * @package  App\Http\Controllers\Admin
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin;

/**
 * AdminLogController
 *
 * This controller handles dashboard.
 */
class AdminLogController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        return view('admin.report.log_activity');
    }
}
