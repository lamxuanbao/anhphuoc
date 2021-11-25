<?php


namespace App\Http\Controllers\Storefront;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customers');
    }

    public function index()
    {
        $user = auth('customers')->user();
        return view('storefront.pages.profile', compact('user'))->withTitle(setting('title'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
        ])->validate();
        $user = auth('customers')->user();
        if (!is_null($request->get('password_old')) || !is_null($request->get('password'))) {
            if (!Hash::check($request->get('password_old'), $user->password)) {
                throw ValidationException::withMessages([
                    'password_old' => [trans('auth.password')],
                ]);
            }
        };
        Validator::make($request->all(), [
            'password' => ['nullable', 'required_with:password_old', 'min:6'],
            'password_confirmation' => ['nullable', 'required_with:password', 'same:password'],
        ])->validate();

        $except = ['_token', '_method', 'email', 'password_confirmation', 'password_old'];
        if (is_null($request->get('password'))) {
            $except[] = 'password';
        }
        $params = $request->except($except);
        if (isset($params['password'])) {
            $params['password'] = bcrypt($params['password']);
        }
        $user->fill($params);
        $user->save();
        return redirect()->route('auth.me');
    }
}
