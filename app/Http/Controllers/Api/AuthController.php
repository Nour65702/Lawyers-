<?php

namespace App\Http\Controllers\Api;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use App\Models\ProviderLicence;
    use Validator;
    use Image;
class AuthController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'phone'      => ['required', 'unique:users'],
        ]);
        if ($validator->fails()) {
            return response()->json([$validator->errors()], 401);
        }

        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/users/';
            $destinationPath = 'images/users';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  "https://localhost/$name";
        }

        $data = [
            'first_name'=> $request['first_name'],
            'last_name' => $request['last_name'],
            'email'     => $request['email'],
            'phone'    => $request['phone'],
            'address'   => $request['address'],
            'password'  => Hash::make($request['password']),
            'type'      => $request['type'],
            'status'    => 0,
            'image' => $data['image']
           
        ];

      
        // return $request;
     //   $user =  User::create([
       //    'first_name'=> $request['first_name'],
       //     'last_name' => $request['last_name'],
        //    'email'     => $request['email'],
         //   'phone'    => $request['phone'],
         //   'address'   => $request['address'],
        //    'password'  => Hash::make($request['password']),
        //    'type'      => $request['type'],
        //    'status'    => 0,
        //    'image' => $data['image']
      //  ]);

      $user = user::create($data);


        if($request->type =='provider'){
            $data = [
                'provider_id' => $user->id,
                'category_id' => $request->category_id,
                'active' => 0,
            ];
            ProviderLicence::create($data);
        }

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 200);

        

    }
    
    public function login(Request $request){
        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 20,
            'user' => auth('api')->user()
        ]);
    }  

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'logout successfully']);
    }

}
