<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetEmail;
use App\Mail\WelcomeEmail;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\models\User;
use App\models\Token;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //REGISTER USER

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'gender' => 'required|max:10',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response([
                'message' => 'User with email already exist',
                'status' => 'fail',
                'statusCode' => '409'
            ], 409);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if ($user) {
            $mailData = [
                "name" => $request->name,
            ];

            Mail::to($request->email)->send(new WelcomeEmail($mailData));
        }
        return response([
            'message' => 'Successfully Created an Account You can Now Login',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }

    //LOGIN USER START HERE

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'User not found',
                'status' => 'fail',
                'statusCode' => '404'
            ], 404);
        }

        $token = $user->createToken('auth_token')->accessToken;
        return response([
            'access_token' => $token,
            'message' => 'Successfully Logged in',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }

    //UPDATE USER PROFILE START HERE

    public function update(Request $request)
    {

        if (auth()->user()) {
            $request->validate([
                'name' => 'nullable|max:255',
                'email' => 'required|email',
                'business_name' => 'nullable|max:255',
                'gender' => 'nullable|max:10',
                'address' => 'nullable|max:255',
                'img_url' => 'nullable|image|mimes:jpg,bmp,png,jpeg',
                'phone' => 'nullable|min:11|numeric'
            ]);
            if ($request->name == Null && $request->email == Null && $request->business_name == Null && $request->gender == Null && $request->address == Null && $request->phone == Null && $request->img_url == Null) {

                return response([
                    'message' => 'Weyrey Send at least one data',
                    'status' => 'fail',
                    'statusCode' => '401'
                ], 401);
            }
            $user = $request->user();
            if ($request->hasFile('img_url')) {
                if ($user->img_url) {
                    $old_path = public_path() . 'uploads/agents/profile_images/' . $user->img_url;
                    if (File::exists($old_path)) {
                        File::delete($old_path);
                    }
                }
                $image_name = 'profile-image-' . time() . '.' . $request->img_url->extension();
                $request->img_url->move(public_path('/uploads/agents/profile_images'), $image_name);
            } else {
                $image_name = $user->img_url;
            }

            //check name

            if ($request->name == Null) {
                $fullname = $user->name;
            } else {
                $fullname =  $request->name;
            }

            //email

            if ($request->email == Null) {
                $email = $user->email;
            } else {
                $email =  $request->email;
            }

            //business name

            if ($request->business_name == Null) {
                $business_name = $user->business_name;
            } else {
                $business_name =  $request->business_name;
            }

            //gender

            if ($request->gender == Null) {
                $gender = $user->gender;
            } else {
                $gender =  $request->gender;
            }

            //address

            if ($request->address == Null) {
                $address = $user->address;
            } else {
                $address =  $request->address;
            }

            //phone

            if ($request->phone == Null) {
                $phone = $user->phone;
            } else {
                $phone =  $request->phone;
            }

            $user->update([
                'name' => $fullname,
                'img_url' => $image_name,
                'email' => $email,
                'gender' => $gender,
                'address' => $address,
                'phone' => $phone,
                'business_name' => $business_name,
            ]);
            return response([
                'message' => 'User Details Successfully updated',
                'data' => $user,
                'status' => 'success',
                'statusCode' => '200'
            ], 200);
        }
    }

    //RESET PASSWORD START HERE

    public function reset(Request $request)
    {

        $request->validate([

            'email' => 'required|email'

        ]);

        // GET USERS 
        $user = User::where('email', $request->email)->first();

        // GET TOKEN 

        $tokenvalid = Token::where('user_email', $request->email)->first();

        // VERIFY IF USER EMAIL EXISTS
        if (!$user) {
            return response([
                'message' => 'User with email does not  exist',
                'status' => 'fail',
                'statusCode' => '401'
            ], 401);
        }
        //GENERATE OTP AND TOKEN
        $otpcode = rand(1000, 9999);
        $tokencode = rand(1000, 9999) . 'reset' . $otpcode . 'pass' . rand(1000, 9999);

        //CHECK IF EMAIL IS IN TOKEN TABLE BEFORE

        if ($tokenvalid) {
            $meet =  $tokenvalid->update([
                'token' => $tokencode,
                'otp' => $otpcode,
                'otp_active' => 'NO',
                'created_at' => now()
            ]);
            if ($meet) {
                $mailData = [
                    "otp" => $otpcode,
                ];
                Mail::to($request->email)->send(new ResetEmail($mailData));
            }
        } else {

            // ELSE CREATE NEW TOKEN 

            $token = Token::create([
                'user_email' => $request->email,
                'token' => $tokencode,
                'otp' => $otpcode
            ]);

            // CHECK IF TOKEN IS CREATED SUCCESSFULLY

            if (!$token) {
                return response([
                    'message' => 'error while resetting password',
                    'status' => 'fail',
                    'statusCode' => '401'
                ], 401);
            }
            // if ($token){
            //     $mailData =[
            //         "otp"=>$otpcode,
            //     ];
            //     Mail::to($request->email)->send(new ResetEmail($mailData));
            // }
        }
        return response([

            'message' => 'An Otp email has been sent to ' . $request->email . '.' . 'Kindly Check Your Mail/Spam',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }

    // CONFIRM OTP START HERE

    public function confirmOtp(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'otp' => 'required|min:4|max:4'

        ]);


        $Token = Token::where('user_email', $request->email)->first();
        $to = now();
        if ($Token) {
            $diff_in_mins = $to->diffInMinutes($Token->created_at);
            $datatoken = ['reset_token' => $Token->token];
        }

        if (!($Token) || ($Token->otp !== $request->otp) || ($Token->otp_active == "YES") || $diff_in_mins > 10) {
            return response([
                'message' => 'Otp is Invalid or Expired ',
                'status' => 'fail',
                'statusCode' => '401'
            ], 401);
        }

        if (($Token) && ($Token->otp == $request->otp) &&  ($Token->otp_active == "NO")) {


            $Token->update([
                'otp_active' => 'YES'
            ]);
        }

        return response([
            'message' => 'Otp Verified Successfully',
            'data' => $datatoken,
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }



    // AFTER CONFIRM OTP RESET PASS START HERE

    public function resetPass(Request $request)
    {
        $request->validate([

            'password' => 'required|min:6|max:255|confirmed'

        ]);


        $Token = Token::where('token', $request->token)->first();
        $to = now();
        if ($Token) {
            $diff_in_mins = $to->diffInMinutes($Token->created_at);
        }

        if (!($Token) || $diff_in_mins > 10) {
            return response([
                'message' => 'Token is Invalid or Expired ',
                'status' => 'fail',
                'statusCode' => '401'
            ], 401);
        }


        // GET USERS by email
        $user = User::where('email', $Token->user_email)->first();

        $passupdate =  $user->update([
            'password' => Hash::make($request->password)
        ]);

        if ($passupdate) {
            $Token->delete();
        }


        return response([
            'message' => 'Password Has Been Reset Successfully',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }

    // UPDATE PASSWORD LOGGED IN
    public function updatePass(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required|min:6|max:255',

            'password' => 'required|min:6|max:255|confirmed'

        ]);



        // GET USERS 
        $user = $request->user();

        if (!Hash::check($request->oldpassword, $user->password)) {
            return response([
                'message' => 'Incorrect Old Password',
                'status' => 'fail',
                'statusCode' => '401'
            ], 401);
        }

        // $passupdate =  $user->update([
        //     'password' => Hash::make($request->password)
        // ]);

        // if ($passupdate) {
           
        // }


        return response([
            'message' => 'Password Has Been Reset Successfully',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }



    //LOGOUT USER START HERE 

    public function logout(Request $request)
    {

        $request->user()->token()->revoke();
        return response([
            'message' => 'Successfully Logged Out',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
    }
}
