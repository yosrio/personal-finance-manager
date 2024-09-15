<?php

/**
 * CategoriesController
 *
 * PHP version 8.3
 *
 * @package  App\Http\Controllers\Admin\FinanceHub
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin\FinanceHub;

/**
 * CategoriesController
 *
 * This controller handles dashboard.
 */
class CategoriesController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        return view('admin.financehub.categories.index');
    }
}
