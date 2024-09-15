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

use App\Models\FinanceHub\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
        return view('admin.financehub.categories.index', ['categories' => Categories::get()]);
    }

    /**
     * Method addOrUpdate
     *
     * @param int|string|null $id
     *
     * @return void
     */
    public function addOrUpdate($id = null)
    {
        try {
            if ($id != null) {
                return view('admin.financehub.categories.edit', [
                    'category' => Categories::find($id)
                ]);
            }
            return view('admin.financehub.categories.edit');
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('financehub_categories'));
        }
    }

    /**
     * Method save
     *
     * @param Request $request
     *
     * @return void
     */
    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if ($request->id) {
                $category = Categories::find($request->id);
                $category->name = $request->name;

                $successMessage = 'Successfully edit category.';
            } else {
                $category = new Categories();
                $category->name = $request->name;

                $successMessage = 'Successfully add category.';
            }

            if ($category->save()) {
                return redirect(route('financehub_categories'))->with('success', $successMessage);
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * Method delete
     *
     * @param int|string $id
     *
     * @return void
     */
    public function delete($id)
    {
        $category = Categories::find($id);

        try {
            if ($category->delete()) {
                return redirect(route('financehub_categories'))->with('success', 'Successfully delete category.');
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
        }

        return redirect(route('financehub_categories'))->with('error', 'Failed to delete category.');
    }
}
