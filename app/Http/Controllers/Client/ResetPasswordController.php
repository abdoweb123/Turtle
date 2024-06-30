<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Client\Entities\Model as Client;

class ResetPasswordController extends BasicController
{

    public function showResetForm(Request $request, $token, $email)
    {
        // Retrieve the user based on the reset token from the password_resets table
        $client = DB::table('password_resets')->where('email',$email)->first();

        // Verify that the token in the URL matches the hashed token from the database
        if (!Hash::check($token, $client->token)) {
            // Handle the case where the tokens do not match
            session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.invalid_or_expired_token')]);
            return redirect()->route('Client.login');
        }

        // Pass the token and email to the password reset form view
        return view('Client.reset-pass')->with([
            'token' => $token,
            'email' => $client->email,
        ]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $client = Client::where('email', $request->email)->first();
        $clientToken = DB::table('password_resets')->where('email',$request->email)->value('token');

        if (!$client || !Hash::check($request->token, $clientToken)) {
            // Invalid token or email address
            session()->flash('toast_message', ['type' => 'error', 'message' => __('trans.invalid_token_or_email_address')]);
            return redirect()->back();
        }

        // Update the user's password
        $client->password = Hash::make($request->password);
        $client->save();

        // Clear the reset token
        DB::table('password_resets')->where('email',$client->email)->delete();

        // Redirect the user to the login page or dashboard
        session()->flash('toast_message', ['type' => 'success', 'message' => __('trans.your_password_has_been_reset_successfully')]);
        return redirect()->route('Client.login');
    }

} //end of class
