<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiReturnFormat;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use DB;
use App\Models\Menu;
use App\Models\Message;
use URL;
use App\Models\Disease;
use App\Models\Treatment;
use App\Models\Post;
use Image;
use File;
use Auth;
use App\Http\Controllers\Redirect;
use Session;

use Artisan;


class ApiController extends Controller
{
    use ApiReturnFormat;
    public function authenticate(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'phone_no' => 'required|regex:/(01)[0-9]{9}/',
                'password' => 'required|min:5|max:30',
            ]);
            
           if($validator->fails()){
            $user['message']=$validator->errors()->first();
            $user['error']='true';
            return $user;               
            }

            $credentials = $request->only('phone_no', 'password');
            $user = User::where('phone_no', $request->phone_no)->first();
            if($user != null){
                if (Hash::check($request->password, $user->password, [])) {
                    
                    $user['message']='Success';
                    $user['error']='false';
                }
                else {    
                        $user=null; 
                        $user['message']='Wrong Credentials';
                        $user['error']='true';
                }
                    return $user;
            }else{
                $user=null; 
                $user['message']='Wrong Credentials';
                $user['error']='true';
            }
    }

    public function register(Request $request)
    {
        
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone_no' => 'required|unique:users|regex:/(01)[0-9]{9}/',
                'email' => 'max:255|email:rfc,dns',
                'password' => 'confirmed|required_with:password_confirmed|min:5|max:30',
            ]);
            

            if($validator->fails()){
                $user['message']=$validator->errors()->first();
                $user['error']='true';
                return $user;  
                
            }
            // return $request;  
            $user= new User();
                $user->name = $request->name;
                $user->phone_no = $request->phone_no;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->doctor = $request->doctor;
                $user->reg_no = $request->reg_no;
                if ($request->file('image')) :
                    $validator = Validator::make($request->all(), [
                        'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png|max:2120',
                    ]);
            
            
                    if($validator->fails()){
                        $user['message']=$validator->errors()->first();
                        $user['error']='true';
                        return $user;    
                     }
                
                        $requestImage = $request->file('image');
                        $fileType = $requestImage->getClientOriginalExtension();
                        $originalImageName = date('YmdHis') . rand(1, 50) . '.' . $fileType;
                        $directory = 'image_gallery/';
                        $originalImageUrl = $directory . $originalImageName;
                        $imgOriginal=Image::make($requestImage)->stream();
                        Image::make($requestImage)->save($originalImageUrl);
                        $user->image = $originalImageUrl;
                    endif;

                $user->save();
            

            $user['message']='Registration Successful';
            $user['error']='false';

            return $user;

    }

    public function getAuthenticatedUser()
    {
                try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['user_not_found'], 404);
                    }

                } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
                } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
                } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
                }
                $user['message']='Success';
                $user['error']='false';

                return $user;
    }

    public function logout()
    {  
            try {
                JWTAuth::invalidate(JWTAuth::getToken());
                return $this->responseWithSuccess('Logout Successfully');
            } catch (JWTException $e) {
                JWTAuth::unsetToken();
                // something went wrong tries to validate a invalid token
                return $this->responseWithError(__('Error','Failed to logout, please try again.'));
                // return response()->json(['message' => 'Failed to logout, please try again.']);
            }
    }





    public function updateUserInfo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'phone_no'  => 'required|regex:/(01)[0-9]{9}/|unique:users,phone_no,'.$id,
            'email'     => 'max:255|email:rfc,dns',
            'password'  => 'required|min:5|max:30',
        ]);
        

        if($validator->fails()){
            $user['message']=$validator->errors()->first();
            $user['error']='true';
            return $user;  
            
        }
        // return $request;  
            $user           = User::find($id);
            $user->name     = $request->name;
            $user->phone_no = $request->phone_no;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            // $user->doctor = $request->doctor;
            // $user->reg_no = $request->reg_no;

            if ($request->file('image')) :
                $validator = Validator::make($request->all(), [
                    'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png|max:2120',
                ]);
        
        
                if($validator->fails()){
                    $user['message']=$validator->errors()->first();
                    $user['error']='true';
                    return $user;    
                 }
                 $image_path = $user->image;  // Value is not URL but directory file path

                 if(File::exists($image_path)) {
                     File::delete($image_path);
                 }
                    $requestImage = $request->file('image');
                    $fileType = $requestImage->getClientOriginalExtension();
                    $originalImageName = date('YmdHis') . rand(1, 50) . '.' . $fileType;
                    $directory = 'image_gallery/';
                    $originalImageUrl = $directory . $originalImageName;
                    $imgOriginal=Image::make($requestImage)->stream();
                    Image::make($requestImage)->save($originalImageUrl);
                    $user->image = $originalImageUrl;
                endif;

            $user->save();
        

        $user['message']='Update Successful';
        $user['error']='false';

        return $user;

    }

    public function changePassword(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|min:2|max:30'
            ]);

            if($validator->fails()){
                $user['message']=$validator->errors()->first();
                $user['error']='true';
                return $user;  
            }

            $current_password = User::find($request->user_id)->password;   

            if(Hash::check($request->new_password, $current_password))
            {
              $user_id = User::find($request->user_id)->id;
              $obj_user = User::find($user_id);
              $obj_user->password = Hash::make($request->new_password);
              $obj_user->save();

              $userR['message']='Success';
              $userR['error']='false';

              return $userR;
            }
            else
            {           
                $userR['message']='error';
                $userR['error']='true';
  
                return $userR;   
            }

        }

    public function test(Request $request){
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return 'ok';
    }


public function message(Request $request){

    $validator = Validator::make($request->all(), [
        'sender_id' => 'required',
        'receiver_id' => 'required',
    ]);
    
   if($validator->fails()){
       return $this->responseWithError('Invalid Credentials', $validator->errors(), 422);
    }
    $message= new Message();
    $message->sender_id=$request->sender_id;
    $message->receiver_id=$request->receiver_id;
    $message->message=$request->message;

    if ($request->file('image')) :
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png|max:2120',
        ]);


        if($validator->fails()){
            $user['message']=$validator->errors()->first();
                    $user['error']='true';
                    return $user;  
         }
    
            $requestImage = $request->file('image');
            $fileType = $requestImage->getClientOriginalExtension();
            $originalImageName = date('YmdHis') . rand(1, 50) . '.' . $fileType;
            $directory = 'image_gallery/';
            $originalImageUrl = $directory . $originalImageName;
            $imgOriginal=Image::make($requestImage)->stream();
            Image::make($requestImage)->save($originalImageUrl);
            $message->image = $originalImageUrl;
        endif;
        $message->save();

        $message['error']='false';
        return $message;
}
public function viewMessageReceiver($user_id){
    $users= Message::
            join('users as sender', 'sender.id', '=', 'messages.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
            ->select('sender.id as sender_id','sender.name as sender_name', 'receiver.name as receiver_name', 'receiver.id as receiver_id')
            ->where(function($q) use ($user_id) {
                $q->where('sender_id', $user_id)
                ->orWhere('receiver_id', $user_id);
            })->distinct('receiver.name','receiver.id')->get();
    $userList=array();
    foreach($users as $user){
        if($user->sender_id == $user_id){
            $userFind = User::find($user->receiver_id);
            $newUser['id'] =$user->receiver_id;
            $newUser['name'] = $user->receiver_name;
            if($userFind->image != null){
                $newUser['image']                   = URL::to("/").'/'.$userFind->image;
            }else{
                $newUser['image']                   = asset('default-image/default.jpg');
            }
        }else{
            $userFind = User::find($user->sender_id);
            $newUser['id'] =$user->sender_id;
            $newUser['name'] = $user->sender_name;
            if($userFind->image != null){
                $newUser['image']                   = URL::to("/").'/'.$userFind->image;
            }else{
                $newUser['image']                   = asset('default-image/default.jpg');
            }
        }
        $userList[] = $newUser;
    }

    return $userList;
}
public function viewMessage($sender_id,$receiver_id){

    // $messages= Message::where('sender_id',$sender_id)->orWhere('receiver_id',$sender_id)->get();

    $messages= Message::
                join('users as sender', 'sender.id', '=', 'messages.sender_id')
                ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
                ->select('messages.*', 'sender.name as sender_name', 'receiver.name as receiver_name')
                ->where(function($q) use ($sender_id) {
                    $q->where('sender_id', $sender_id)
                    ->orWhere('receiver_id', $sender_id);
                })->where(function ($q) use ($receiver_id) {
                    $q->where('sender_id', $receiver_id)
                    ->orWhere('receiver_id', $receiver_id);
                })->orderBy('created_at', 'ASC')->get();

    $messageList=[]; 
    if(count($messages)==0){
        $message['id']                          = '';
        $message['sender_id']                   = '';
        $message['receiver_id']                 = '';
        $message['message']                     = '';
        $message['image']                       = '';
        $message['created_at']                  = '';
        $message['sender_name']                 = '';
        $message['receiver_name']               = '';
        $message['error']                       = true;

        $messageList[]=$message;
    }else{     
        foreach($messages as $messageItem){
       

            $message['id']                          = $messageItem->id;
            $message['sender_id']                   = $messageItem->sender_id;
            $message['receiver_id']                 = $messageItem->receiver_id;
            $message['message']                     = $messageItem->message;
            
            if($messageItem->image != null){
                $message['image']                   = URL::to("/").'/'.$messageItem->image;
            }else{
                $message['image']                   = null;
            }
            $message['created_at']                  = $messageItem->created_at;
            $message['sender_name']                 = $messageItem->sender_name;
            $message['receiver_name']               = $messageItem->receiver_name;
            $message['error']                       = false;
            $messageList[]=$message;
        }
        
    }
    return $messageList;
}


public function savePost(Request $request){

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'description' => 'required',
    ]);
    
   if($validator->fails()){
    $post['message']=$validator->errors()->first();
    $post['error']='true';
    return $post;               
    }

    $post               = new Post();
    $post->title        = $request->title;
    $post->user_id      = $request->user_id;
    $post->description  = $request->description;

    if ($request->file('image')) :
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,JPG,JPEG,jpeg,gif,png|max:2120',
        ]);


        if($validator->fails()){
            $post['message']=$validator->errors()->first();
            $post['error']='true';
            return $post;    
         }
    
            $requestImage = $request->file('image');
            $fileType = $requestImage->getClientOriginalExtension();
            $originalImageName = date('YmdHis') . rand(1, 50) . '.' . $fileType;
            $directory = 'image_gallery/';
            $originalImageUrl = $directory . $originalImageName;
            $imgOriginal=Image::make($requestImage)->stream();
            Image::make($requestImage)->save($originalImageUrl);
            $post->image = $originalImageUrl;
        endif;
        $post->save();

        $post['error']='false';
        $post['message']='success';
        return $post;
    

}

public function postList(){
    $posts=Post::join('users','users.id','=','posts.user_id')
    ->select('posts.*','users.name','users.email','users.image as user_image')
    ->orderBy('posts.id','ASC')->get();

    $postList=[]; 
    if(count($posts)==0){
        $post['id']                          = '';
        $post['title']                       = '';
        $post['description']                 = '';
        $post['image']                       = '';
        $post['name']                       = '';
        $post['email']                       = '';
        $post['user_image']                       = '';
        $post['created_at']                       = '';
        $post['error']                       = true;

        $postList[]=$post;
    }else{     
        foreach($posts as $postItem){
       
            $post['id']                          = $postItem->id;
            $post['title']                       = $postItem->title;
            $post['description']                 = $postItem->description;
            
            if($postItem->image != null){
                $post['image']                   = URL::to("/").'/'.$postItem->image;
            }else{
                $post['image']                   = asset('default-image/default.jpg');
            }
            $post['name']                        = $postItem->name;
            $post['email']                       = $postItem->email;

            if($postItem->user_image != null){
                $post['user_image']                   = URL::to("/").'/'.$postItem->user_image;
            }else{
                $post['user_image']                   = asset('default-image/default.jpg');
            }
            $post['created_at']                       = $postItem->created_at;
            $post['error']                       = false;
            $postList[]=$post;
        }
        
    }

    return $postList;

}
}
