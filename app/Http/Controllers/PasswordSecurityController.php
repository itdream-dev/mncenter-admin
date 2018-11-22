<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PasswordSecurity;
use Illuminate\Support\Facades\Hash;
class PasswordSecurityController extends Controller
{
  public function show2faForm(Request $request){
      $user = Auth::user();

      $google2fa_url = "";
      if($user->passwordSecurity()->exists()){
          $google2fa = app('pragmarx.google2fa');
          $google2fa->setAllowInsecureCallToGoogleApis(true);
          $google2fa_url = $google2fa->getQRCodeGoogleUrl(
              'MNCenter.online 2fa',
              $user->email,
              $user->passwordSecurity->google2fa_secret
          );
      }
      $data = array(
          'user' => $user,
          'google2fa_url' => $google2fa_url
      );
      return view('auth.2fa')->with('data', $data);
  }

  public function generate2faSecret(Request $request){
    $user = Auth::user();
    // Initialise the 2FA class
    $google2fa = app('pragmarx.google2fa');

    // Add the secret key to the registration data
    $google2fa->setAllowInsecureCallToGoogleApis(true);
    $backup_code = uniqid('2fa', true);
    PasswordSecurity::create([
        'user_id' => $user->id,
        'google2fa_enable' => 0,
        'google2fa_secret' => $google2fa->generateSecretKey(),
        'backup_code' => $backup_code
    ]);

    return redirect('/2fa')->with('success',"Secret Key is generated, Please verify Code to Enable 2FA");
  }

  public function enable2fa(Request $request){
    $user = Auth::user();
    $google2fa = app('pragmarx.google2fa');
    $google2fa->setAllowInsecureCallToGoogleApis(true);
    $secret = $request->input('verify-code');
    $valid = $google2fa->verifyKey($user->passwordSecurity->google2fa_secret, $secret);
    if($valid){
        $user->passwordSecurity->google2fa_enable = 1;
        $user->passwordSecurity->save();
        return redirect('2fa')->with('success',"2FA is Enabled Successfully.");
    } else {
        return redirect('2fa')->with('error',"Invalid Verification Code, Please try again.");
    }
  }

  public function disable2fa(Request $request){
    // $validatedData = $request->validate([
    //     'current-password' => 'required',
    // ]);

    $user = Auth::user();
    if (isset($user->passwordSecurity->backup_code)){
      if ($request->get('current-password') == $user->passwordSecurity->backup_code){
        $user->passwordSecurity->delete();
        return redirect('2fa');
      }
    }

    if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your  password does not matches with your account password. Please try again.");
    }


    $user = Auth::user();
    $user->passwordSecurity->google2fa_enable = 0;
    $user->passwordSecurity->save();
    return redirect('/2fa')->with('success',"2FA is now Disabled.");
  }
}
