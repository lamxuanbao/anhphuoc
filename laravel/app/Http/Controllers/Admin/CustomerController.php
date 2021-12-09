<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::orderBy('id','DESC')->paginate(15);

        return view('admin.pages.customer.index', [
            'customer' => $customer
        ])->withTitle('Danh sách khách hàng');
    }
}
