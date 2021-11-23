<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id')->paginate(15);

        return view('admin.pages.customer.index', [
            'customers' => $customers
        ])->withTitle('Danh sách khách hàng');
    }
}
