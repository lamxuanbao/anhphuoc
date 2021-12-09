<?php
/**
 * Created by PhpStorm.
 * User: nhockizi
 * Date: 12/9/21
 * Time: 09:43
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Deposit;

class DepositController extends Controller
{
    public function index()
    {
        $deposit = Deposit::orderBy('status', 'ASC')
                          ->orderBy('id', 'DESC')
                          ->paginate(15);

        return view(
            'admin.pages.deposit.index',
            [
                'deposit' => $deposit,
            ]
        )->withTitle('Danh sách ký gửi');
    }

    public function view($id)
    {
        $deposit         = Deposit::findOrFail($id);
        $deposit->status = true;
        $deposit->save();

        return view('admin.pages.deposit.view', compact('deposit'))->withTitle('Chi tiết ký gửi');
    }

    public function destroy($id)
    {
        Deposit::destroy($id);

        return redirect()->route('admin.deposit');
    }
}
