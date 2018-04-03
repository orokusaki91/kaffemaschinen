<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Database\Address;
use Illuminate\Support\Facades\Auth;
class AddressController extends Controller
{
    /**
     * Display a listing of the user addresses.
     */
    public function index()
    {
        $user = Auth::user(); // LOGED IN USER
        $addresses = Address::where('user_id', '=', $user->id)->get(); // VRACA ADRESE TRENUTNOG USERA IZ BAZE

        return view('front.address.my-account.address')
            ->with('user', $user)
            ->with('addresses', $addresses);
    }

    public function show($id)
    {
        $address = Address::find($id);

        if ($address !== null){
            $address->delete();
        }

        return redirect()->route('my-account.address.index');
    }

    public function destroy($id)
    {
    }

    public function create()
    {
        $user = Auth::user(); // LOGED IN USER

        return view('front.address.my-account.new')
            ->with('user', $user);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $address = new Address;

        $address->type = $request->type;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->address1 = $request->address;
        $address->address2 = $request->address2;
        $address->postcode = $request->postcode;
        $address->city = $request->city;
        $address->phone = $request->phone;

        $user->addresses()->save($address);

        return redirect()->route('my-account.address.index');
    }
}