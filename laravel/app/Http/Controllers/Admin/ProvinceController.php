<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    public function index()
    {
        $province = Province::orderBy('id','DESC')
                            ->paginate(15);

        return view('admin.pages.province.index', compact('province'))->withTitle('Danh sách Tỉnh/Thành phố');
    }

    public function create()
    {
        $province = new Province();

        return view('admin.pages.province.create', compact('province'))->withTitle('Tạo Tỉnh/Thành phố');
    }

    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                ],
            ]
        )
                 ->validate();
        Province::create($request->except('_token', '_method'));

        return redirect()->route('admin.province');
    }

    public function edit($id)
    {
        $province = Province::findOrFail($id);

        return view('admin.pages.province.update', compact('province'))->withTitle('Chỉnh sửa Tỉnh/Thành phố');
    }

    public function update($id, Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                ],
            ]
        )
                 ->validate();
        Province::findOrFail($id)->update($request->except('_token', '_method'));

        return redirect()->route('admin.province');
    }

    public function destroy($id)
    {
        Province::destroy($id);

        return redirect()->route('admin.province');
    }
}
