<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscribeUser;
use App\Models\Package;
use App\Models\Post;
use App\Models\Notification;
use Validator;
use Image;
class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id'     => ['required'],
            'package_id'  => ['required'],
        ]);
        
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        }
        $last_sub = SubscribeUser::where('user_id',$request->user_id)->first();
        // if($last_sub != null){
        //     return response()->json([
        //         'details' => 'You are already subscribed to the package'
        //     ]);
        // }
        $package = Package::find($request->package_id);
        $data = [
            'user_id' => $request->user_id,
            'package_id' => $request->package_id,
            'price' => $package->price,
            'balance' => $package->balance,
            'status'=> '0'
        ];
        SubscribeUser::create($data);
        $not = [
            'sender' => null,
            'reciver' => $request->user_id ,
            'notification' => 'Please wait for admin approval'
        ];
        Notification::create($not);
        return response()->json([
            'details' => 'Please wait for admin approval'
        ]);
    }

    public function packages(){
        $packages = Package::all();
        return response()->json([
            'details' => $packages
        ]);
    }

    public function usePackage(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id'     => ['required'],
            'subscribe_id'     => ['required'],
            'balance'     => ['required'],
        ]);
        
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors());
        }

        $subscribe = SubscribeUser::find($request->subscribe_id);
        $balance = $subscribe->balance - $request->amount;
        if ($balance < 0) {
            $balance = 0;
        }
        $subscribe->balance = $balance;
        $subscribe->save();

        if ($balance == 0) {
            $not = [
                'sender' => null,
                'reciver' => $subscribe->user_id,
                'notification' => 'Your package balance is zero. Please subscribe to another package.'
            ];
            Notification::create($not);
        }

        return response()->json([
            'details' => 'Package used successfully'
        ]);
    }


    public function addPost(Request $request)
    {
        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/posts/';
            $destinationPath = 'images/posts';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  "https://localhost/$name";
        }

        $data = [
            'provider_id'=>$request->provider_id,
            'text' => $request->text,
            'image' => $data['image']
        ];
        Post::create($data);
        return response()->json([
            'details' => $data
        ]);
    }
}
