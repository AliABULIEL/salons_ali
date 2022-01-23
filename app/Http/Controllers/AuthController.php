<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PhoneCode;
use Illuminate\Support\Str;
use Plivo\RestClient;
use Illuminate\Support\Facades\Validator;

/**
 * @group Authentication
 */
class AuthController extends Controller
{
    /**
     * Register
     *
     * Register and send verification code to user phone number. use 12345 to test
     * @bodyParam business_id integer required business ID.  Example: 1
     * @bodyParam first_name string required User fist name. Example: Jon
     * @bodyParam last_name string required User last name.  Example: Snow
     * @bodyParam phone string required User phone number.  Example: 0501234567
     * @response {
     *        "message": "Verification code sent",
     *        "user": {
     *            "first_name": "Jon",
     *            "last_name": "Snow",
     *            "phone": "0501234567",
     *            "role": "Business client",
     *            "updated_at": "2021-01-07T14:41:57.000000Z",
     *            "created_at": "2021-01-07T14:41:57.000000Z",
     *            "id": 1
     *        }
     *    }
     * }
     * @response 422 {
     *     "message": "The given data was invalid.",
     *     "errors": {
     *         "phone": [
     *             "The phone has already been taken."
     *         ]
     *     }
     * }
    **/
    public function register(Request $request)
    {
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'phone' => 'unique:App\User,phone',
        //     'business_id' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'unique:App\User,phone',
            'business_id' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return [
                'message' => $errors->first(),
                'errors' => $errors
            ];         
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'role' => 'Business client',
            'business_id' => $request->business_id,
            'locale' => app()->getLocale(),
            'suspended' => false,
        ]);

        $this->sendCode($user);

        return [
            'message' => 'Verification code sent',
            // 'user' => $user->details(),
        ];
    }


    /**
     * Verify code
     *
     * Verify the verification code and return token.
     * @bodyParam phone string required User phone number.  Example: 0501234567
     * @bodyParam business_id string required User business_id number.  Example: 1
     * @bodyParam code string required Code sent with sms, use 11111 to test.  Example: 123456
     * @response {
     *     "message": "Code verified",
     *     "api_token": "yQi6wk53fWRxSpsRQn5k7E8Bp3gRspVlmEfOfeqVBaD9o0FIWdYFsATRo1Fb"
     * }
    **/
    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'business_id' => 'required',
            'code' => 'required'
        ]);

        $user = User::where('phone', $request->phone)
                    ->where('business_id', $request->business_id)
                    ->first();

        if(!$user) {
            return [
                'message' => 'This phone number not registered.',
                'api_token' => null,
                'user' => null,
            ];
        }

        $phoneCode = PhoneCode::where('code', $request->code)
                        ->where('phone', $request->phone)
                        ->first();

        if ($phoneCode) {
            $token = $user->createToken('api_token');
            
            $user->business_id = $request->business_id;

            $phoneCode->update([
                'verified_at' => now(),
            ]);

            return [
                'message' => 'Code verified',
                'api_token' => $token->plainTextToken,
                'user' => $user->details(),
            ];
        }

        if ($request->code == '11111') {
            $token = $user->createToken('api_token');
    
            return [
                'message' => 'Code verified',
                'api_token' => $token->plainTextToken,
                'user' => $user->details(),
            ];
        }

        return [
            'message' => 'Invalid code',
            'api_token' => null,
            'user' => null,
        ];
    }

    /**
     * Login
     *
     * Send verification code to user phone.
     * @bodyParam business_id integer required business ID.  Example: 1
     * @bodyParam phone string required User phone number.  Example: 0501234567
     * @response {
     *     "message": "Verification code sent.",
     * }
     * @response 422 {
     *     "message": "The given data was invalid.",
     *     "errors": {
     *         "phone": [
     *             "The phone has already been taken."
     *         ]
     *     }
     * }
    **/
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'business_id' => 'required'
        ]);

        $user = User::where('phone', $request->phone)
                    ->where('business_id', $request->business_id)
                    ->first();

        if($user) {
            $this->sendCode($user);

            return [
                'message' => 'Verification code sent',
            ];            
        }

        else {
            return [
                'message' => 'this phone number not registered',
                'errors' => [],
            ];
        }
    }



    public function sendCode($user)
    {
        $phoneCode = PhoneCode::create([
            'phone' => $user->phone,
            'code' => mt_rand(10000, 99999),
        ]);
            
        $client = new RestClient(env('PLIVO_AUTH_ID'), env('PLIVO_AUTH_TOKEN'));

        $client->messages->create(
            env('SMS_FROM'),
            ['972' . (int) $user->phone],
            "Your code is:\n" . $phoneCode->code,
        );

        return [
            'message' => 'Code sent'
        ];
    }
}
