<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderLicence;
use App\Models\LegalAdvice;
use App\Models\ReplyAdvice;
use App\Models\SubscribeUser;
use App\Models\Notification;
use App\Models\User;
use Validator;
use Image;
use Carbon\Carbon;
class LegalAdviceController extends Controller
{
    // add question for advice
    public function addQuestion(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'question'     => ['required'],
            'user_id'      => ['required'],
            'category_id'  => ['required'],
        ]);
        
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(),401);
        }
        $questions = LegalAdvice::where('user_id',$request->user_id)->count();
        if( $questions >= 1){
            $subscribe = SubscribeUser::with('package')->where('user_id',$request->user_id)
            ->latest('created_at')->first();
            if($subscribe == null){
                return response()->json([
                    'details' => 'please subscripe in any package'
                ]);
            }else{
                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $subscribe->created_at);
                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());

                $diff_in_days = $to->diffInDays($from);
                if ($subscribe->balance == 0) {
                    return response()->json([
                        'details' => 'Your package balance is zero. Please subscribe to another package.'
                    ]);
                } else {
                    $subscribe->balance = $subscribe->balance - 1;
                    $subscribe->save();
                } 
            }
            
   
        } 
     

        if($request->file('image')){
            $image=$request->file('image');
            $input['image'] = $image->getClientOriginalName();
            $path = 'images/question/';
            $destinationPath = 'images/question';
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.time().$input['image']);
            $name = $path.time().$input['image'];
            
           $data['image'] =  "https://localhost/$name";
        }
        $data = [
            'question'     => $request->question,
            'user_id'      => $request->user_id ,
            'category_id'  => $request->category_id ,
            'status'       => '1',
            'image'        => $data['image'],
        ];
        LegalAdvice::create($data);
        return response()->json([
            'details' => $data,
        ]);
    }
    // user question 
    public function myQusetion(Request $request)
    {
        $questions = LegalAdvice::with('category')
        ->where('user_id',$request->user_id)
        ->get();

        return response()->json([
            'details' => $questions,
        ]);
    }
    // details & replies for user questions
    public function detailsQuestion(Request $request)
    {
        $details = LegalAdvice::with('replies.provider')
        ->where('id',$request->question_id)
        ->first();

        return response()->json([
            'details' => $details,
        ]);
    }
    // provider question يلي بحقلو يجاوب عليها 
    public function providerLegalAdvice(Request $request)
    {
        $provider_licenses = ProviderLicence::where('provider_id',$request->provider_id)
        ->where('active',1)
        ->pluck('category_id');
        $questions = LegalAdvice::whereIn('category_id',$provider_licenses)->get();
        return response()->json([
            'details' => $questions
        ]);
    }
    // provider reply 
    public function providerReplies(Request $request)
    {
        $questions = ReplyAdvice::where('question_id',$request->question_id)
        ->where('provider_id',$request->provider_id)->get();
        return response()->json([
            'details' => $questions
        ]);
    }
    // add reply to question 
    public function replyQuestion (Request $request)
    {
        // return 'df';
        
        $validatedData = Validator::make($request->all(), [
            'question_id'  => ['required'],
            'provider_id'  => ['required'],
            'reply'        => ['required'],
        ]);
        
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(),301);
        }
        $question = LegalAdvice::find($request->question_id);
        $data = [
            'question_id' => $request->question_id,
            'provider_id' => $request->provider_id,
            'reply' => $request->reply
        ];
        ReplyAdvice::create($data);
        
        $not = [
            'reciver' => $question->user_id,
            'sender' => $request->provider_id,
            'notification' => 'Your question has been answered. You can see that'
        ];
        Notification::create($not);
        return response()->json([
            'details' => $data
        ]);
    }

    // user notifications
    public function notifications(Request $request)
    {
        $nots = Notification::with('sender_user')->where('reciver',$request->user_id)->get();
        return response()->json([
            'details' => $nots
        ]);
    }

    // search provider

    public function searchProvider(Request $request)
    {
        $providers = User::where( 'first_name', 'LIKE', '%'.$request->who.'%' )->where('type','provider')
        ->orWhere('last_name','LIKE','%'.$request->who.'%')->where('type','provider')
        ->get();
        return response()->json([
            'details'=>$providers
        ]);
    }
        
}
