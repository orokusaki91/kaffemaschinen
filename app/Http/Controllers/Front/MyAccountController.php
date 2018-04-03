<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UploadUserImageRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\Database\Order;
use Illuminate\Support\Facades\Auth;
use App\Image\Facade as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        return view('front.user.my-account.home')
            ->with('user', $user);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('front.user.my-account.edit')
            ->with('user', $user);
    }

    /**
     * Update User Account
     */
    public function store(UserProfileRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->route('my-account.home');
    }

    public function uploadImage()
    {
        $user = Auth::user();

        return view('front.user.my-account.upload-image')
            ->with('user', $user);
    }

    /**
     * Function for Upload Profile Image
     */
    public function uploadImagePost(UploadUserImageRequest $request)
    {

        $user = Auth::user();

        $image = $request->file('profile_image');

        if (false === empty($user->image_path)) {
            $user->image_path->destroy();
        }

        $relativePath = '/users/' . $user->id;
        $path = $relativePath;


        $dbPath = 'uploads' . $relativePath . '/' . $image->getClientOriginalName();

        $this->directory(public_path($relativePath));

        Image::upload($image, $path);

        $user->update(['image_path' => $dbPath]);

        return redirect()->route('my-account.home')
            ->with('notificationText', 'Benutzerprofil Image wurde erfolgreich hochgeladen!');
    }

    /**
     * Orders
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', '=', $user->id)->get();

        return view('front.user.my-account.orders')
            ->with('orders', $orders)
            ->with('user', $user);
    }

    /**
     * Order View
     */
    public function orderView($id)
    {
        $user = Auth::user();
        $order = Order::where('id', '=', $id)->first();
        return view('front.user.my-account.orderView')
            ->with('order', $order)
            ->with('user', $user);
    }

    /**
     * Change password
     */
    public function changePassword()
    {
        $user = Auth::user();
        
        return view('front.user.my-account.change-password')
            ->with('user', $user);
    }

    public function changePasswordPost(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->update(['password' => bcrypt($request->get('password'))]);
            return redirect()->route('my-account.home')
                ->with('notificationText', 'User Password Changed Successfully!');
        } else {
            return redirect()->back()
                ->withErrors(['current_password' => 'Your Current Password Wrong!'])
                ->with('notificationError', 'Your Current Password Wrong');
        }
    }

    /**
     * Create Directories if not exists
     */
    public function directory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, '0777', true, true);
        }
        return $this;
    }
}