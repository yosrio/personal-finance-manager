<?php

/**
 * TransactionController
 *
 * PHP version 8.3
 *
 * @package  App\Http\Controllers\Admin\FinanceHub
 * @category Controllers
 * @author   Yos Rio
 * @license  http://opensource.org/licenses/MIT MIT License
 */

namespace App\Http\Controllers\Admin\FinanceHub;

use App\Models\FinanceHub\Transactions;
use App\Models\FinanceHub\Categories;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

/**
 * TransactionController
 *
 * This controller handles dashboard.
 */
class TransactionController extends \App\Http\Controllers\Controller
{
    /**
     * Method index
     *
     * @return string|null
     */
    public function index()
    {
        $transactions = Transactions::with('category')->get();
        return view('admin.financehub.transactions.index', ['transactions' => $transactions]);
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
            $categories = Categories::get();
            $types = ['income','expense'];

            if ($id != null) {
                $transaction = Transactions::with('category')
                                ->where('id', $id)
                                ->first();
                return view('admin.financehub.transactions.edit', [
                    'transaction' => $transaction,
                    'categories' => $categories,
                    'types' => $types
                ]);
            }
            return view('admin.financehub.transactions.edit', [
                    'categories' => $categories,
                    'types' => $types
                ]);
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
            return Redirect(route('financehub_transactions'))->with('error', 'Something went wrong.');
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
            'amount' => 'required|numeric',
            'description' => 'required',
            'type' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            Log::channel('exceptions')->warning(implode('\n', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if ($request->id) {
                $transaction = Transactions::find($request->id);
                $transaction->amount = $request->amount;
                $transaction->type = $request->type;
                $transaction->category_id = $request->category_id;
                $transaction->description = $request->description;

                $successMessage = 'Successfully edit transaction.';
            } else {
                $transaction = new Transactions();
                $transaction->user_id = auth()->user()->id;
                $transaction->amount = $request->amount;
                $transaction->type = $request->type;
                $transaction->category_id = $request->category_id;
                $transaction->description = $request->description;

                $successMessage = 'Successfully add transaction.';
            }

            if ($transaction->save()) {
                return redirect(route('financehub_transactions'))->with('success', $successMessage);
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
        $transaction = Transactions::find($id);

        try {
            if ($transaction->delete()) {
                return redirect(route('financehub_transactions'))->with('success', 'Successfully delete transaction.');
            }
        } catch (\Exception $e) {
            Log::channel('exceptions')->error($e);
        }

        return redirect(route('financehub_transactions'))->with('error', 'Failed to delete transaction.');
    }
}
