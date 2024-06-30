<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Client\ForgetRequest;
use App\Http\Requests\Client\LoginRequest;
use App\Http\Requests\Client\ProfileRequest;
use App\Http\Requests\Client\RegisterRequest;
use App\Http\Requests\Client\UpdateProfileRequest;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Client\Entities\Model as Client;
use Modules\Country\Entities\Region;
use Modules\Order\Entities\Model as Order;

class AuthController extends BasicController
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username_or_email', 'password');

        $field = $this->usernameOrEmail($credentials);

        // Merge the authentication field into the credentials array
        $credentials = array_merge([$field => $credentials['username_or_email']], $credentials);

        $remember = $request->has('remember');

        // Attempt to authenticate the user
        if (auth('client')->attempt([$field => $credentials['username_or_email'], 'password' => $credentials['password']], $remember)) {

            $this->convertGuestDataToClient();

            session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.loginSuccessfully')]);
            return redirect()->route('Client.account');
        }

        session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.invalid_login_credentials')]);
        return redirect()->back();
    }


    public function register(RegisterRequest $request)
    {
        $client = Client::create([
            'country_id' => $request->get('country_id') ?? Country()->id,
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        auth('client')->login($client);
        $this->convertGuestDataToClient();

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.loginSuccessfully')]);

        return redirect()->route('Client.account');
    }


    public function account(ProfileRequest $request)
    {
        $client_id = client_id();
        Client::where('id', auth('client')->id())->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        DB::table('wishlist')->where('client_id', $client_id)->update(['client_id' => auth('client')->id()]);
        toast(__('trans.updatedSuccessfully'), 'success');

        return redirect()->route('Client.account');
    }

    /*** get account page ***/
    public function getAccountPage()
    {
        $Orders = Order::query()->where('client_id',client_id())->orderBy('id','desc')->get();
        $regions = Region::query()->where('country_id',1)->where('status',1)->get();
        return view('Client.my-account',compact('Orders','regions'));
    }


    // To convert [wishlist, orders, addresses, cart] of guest to client
    public function convertGuestDataToClient()
    {
        $guest_id = session()->get('client_id');
        if ($guest_id){
            DB::table('wishlist')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
            DB::table('orders')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
            DB::table('addresses')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
            DB::table('cart')->where('client_id', $guest_id)->update(['client_id' => auth('client')->id()]);
        }
    }


    public function updateAccountDetails(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        // Update email if provided
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        // Update password if provided
        if ($request->filled('password')) {
            // Validate current password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => __('trans.provided_password_does_not_match')]);
            }

            // Update password
            $user->password = Hash::make($request->password);
        }
        $user->save();

        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.profile_updated_successfully')]);

        return redirect()->back();

    }


    public function sendResetLinkEmail(Request $request)
    {
        $client = Client::where('email', $request->nameOrEmail)->orWhere('name', $request->nameOrEmail)->first();

        if (!$client) {
            session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.invalid_data_credentials')]);
            return redirect()->back();
        }

        // Generate a password reset token and save it in the database
        $token = app('auth.password.broker')->createToken($client);

        // Send the email with the password reset link
        Mail::to(['main@turtlebh.com', setting('email'), $client->email])->send(new ResetPassword($token,$client));

        $success = 1;
        return view('Client.lost-password', compact('success'));
    }


    public function forget(ForgetRequest $request)
    {
        Client::where('phone', $request->phone)->update(['password' => Hash::make($request->password)]);
        $Client = Client::where('phone', $request->phone)->first();
        auth('client')->login($Client);
        toast(__('trans.loginSuccessfully'), 'success');

        return redirect()->route('Client.home');
    }


    public function logout()
    {
        if (auth('client')->check()) {
            auth('client')->logout();
        }
        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.logoutSuccessfully')]);

        return redirect()->route('Client.login');
    }


    // Determine username or email
    public function usernameOrEmail($credentials)
    {
        // Check if the provided input is a valid email address
        $isEmail = filter_var($credentials['username_or_email'], FILTER_VALIDATE_EMAIL);

        // Attempt authentication using email or username
        if ($isEmail) {
            $field = 'email';
        } else {
            $field = 'name';
        }
        return $field;
    }

}//end of class
