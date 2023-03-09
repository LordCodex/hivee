<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Hostel;
use App\models\User;
use App\Http\Requests\StorehostelRequest;
use App\Http\Requests\UpdatehostelRequest;
use App\Http\Resources\HostelsResource;
use Illuminate\Support\Facades\File;

class HostelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return HostelsResource::collection(Hostel::all());
        // return Hostel::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorehostelRequest $request)
    {
        //
        if (auth()->user()) {
            $request->validate([
                'name' => 'required|max:255',
                'price' => 'required|max:255',
                'location' => 'required|max:255',
                'no_rooms' => 'required|max:255',
                'room_type' => 'required|max:255',
                'hostel_features' => 'required|max:255',
                'img_one' => 'required|image|mimes:jpg,bmp,png,jpeg',
                'img_two' => 'required|image|mimes:jpg,bmp,png,jpeg',
                'img_three' => 'required|image|mimes:jpg,bmp,png,jpeg'
            ]);

            $user = $request->user();
            if (!$user) {
                return response([
                    'message' => 'Error While Creating Hostel',
                    'status' => 'fail',
                    'statusCode' => '401'
                ], 401);
            }

            $Hostelcount = Hostel::where('user_id', $user->id)->count();
            if (($Hostelcount >= 3) && ($user->type == 'FREE')) {
                return response([
                    'message' => 'You Cant Create More Than 3 Hostels on Free Membership',
                    'status' => 'fail',
                    'statusCode' => '401'
                ], 401);
            }


            if ($request->hasFile('img_one')) {
                $image_name_one = 'hostel-image-' . $request->name . '-' . rand(1000, 9999) . '-' . $user->name . '-' . rand(1000, 9999) . time() . rand(1000, 9999) . '.' . $request->img_one->extension();
                $image_name_one = str_replace(' ', '-', $image_name_one);
                $request->img_one->move(public_path('/uploads/hostels/images'), $image_name_one);
                $image_name_one = url('uploads/hostels/images/' . $image_name_one);
            }
            if ($request->hasFile('img_two')) {
                $image_name_two = 'hostel-image-' . $request->name . '-' . rand(1000, 9999) . '-' . $user->name . '-' . rand(1000, 9999) . time() . rand(1000, 9999) . '.' . $request->img_two->extension();
                $image_name_two = str_replace(' ', '-', $image_name_two);
                $request->img_two->move(public_path('/uploads/hostels/images'), $image_name_two);
                $image_name_two = url('uploads/hostels/images/' . $image_name_two);
            }
            if ($request->hasFile('img_three')) {
                $image_name_three = 'hostel-image-' . $request->name . '-' . rand(1000, 9999) . '-' . $user->name . '-' . rand(1000, 9999) . time() . rand(1000, 9999) . '.' . $request->img_three->extension();
                $image_name_three = str_replace(' ', '-', $image_name_three);
                $request->img_three->move(public_path('/uploads/hostels/images'), $image_name_three);
                $image_name_three = url('uploads/hostels/images/' . $image_name_three);
            }


            Hostel::create([

                'name' => $request->name,
                'price' => $request->price,
                'location' => $request->location,
                'no_rooms' => $request->no_rooms,
                'room_type' => $request->room_type,
                'hostel_features' => $request->hostel_features,
                'img_one'  => $image_name_one,
                'img_two' =>  $image_name_two,
                'img_three' => $image_name_three,
                'user_id' => $user->id
            ]);

            return response([
                'message' => 'Successfully Created new Hostel',
                'status' => 'success',
                'statusCode' => '200'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(hostel $hostel)
    {
        //
        return HostelsResource::collection(Hostel::find($hostel));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(hostel $hostel)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatehostelRequest $request, hostel $hostel)
    {
        //

        if (auth()->user()) {
            $request->validate([
                'name' => 'nullable|max:255',
                'price' => 'nullable|max:255',
                'location' => 'nullable|max:255',
                'no_rooms' => 'nullable|max:255',
                'room_type' => 'nullable|max:255',
                'hostel_features' => 'nullable|max:255',
                'img_one' => 'nullable|image|mimes:jpg,bmp,png,jpeg',
                'img_two' => 'nullable|image|mimes:jpg,bmp,png,jpeg',
                'img_three' => 'nullable|image|mimes:jpg,bmp,png,jpeg'
            ]);
            if ($request->name == Null && $request->price == Null && $request->location == Null && $request->no_rooms == Null && $request->room_type == Null && $request->hostel_features == Null && $request->img_one == Null  && $request->img_two == Null  && $request->img_three == Null) {

                return response([
                    'message' => 'Weyrey Send at least one data',
                    'status' => 'fail',
                    'statusCode' => '401'
                ], 401);
            }
            $user = $request->user();
            if (!$user) {
                return response([
                    'message' => 'Error While Creating Hostel',
                    'status' => 'fail',
                    'statusCode' => '401'
                ], 401);
            }
            $hostel = Hostel::where('id', $request->hostel_id)->first();
            if (!$hostel) {
                return response([
                    'message' => 'Hostel Not Found',
                    'status' => 'fail',
                    'statusCode' => '404'
                ], 404);
            }
            if ($request->hasFile('img_one')) {
                if ($hostel->img_one) {
                    $old_path = $hostel->img_one;
                    if (File::exists($old_path)) {
                        File::delete($old_path);
                    }
                }
                $image_name_one = 'hostel-image-' . $request->name . '-' . rand(1000, 9999) . '-' . $user->name . '-' . rand(1000, 9999) . time() . rand(1000, 9999) . '.' . $request->img_one->extension();
                $image_name_one = str_replace(' ', '-', $image_name_one);
                $request->img_one->move(public_path('/uploads/hostels/images'), $image_name_one);
                $image_name_one = url('uploads/hostels/images/' . $image_name_one);
            } else {
                $image_name_one = $hostel->img_one;
            }
            if ($request->hasFile('img_two')) {
                if ($hostel->img_two) {
                    $old_path = $hostel->img_two;
                    if (File::exists($old_path)) {
                        File::delete($old_path);
                    }
                }
                $image_name_two = 'hostel-image-' . $request->name . '-' . rand(1000, 9999) . '-' . $user->name . '-' . rand(1000, 9999) . time() . rand(1000, 9999) . '.' . $request->img_two->extension();
                $image_name_two = str_replace(' ', '-', $image_name_two);
                $request->img_two->move(public_path('/uploads/hostels/images'), $image_name_two);
                $image_name_two = url('uploads/hostels/images/' . $image_name_two);
            } else {
                $image_name_two = $hostel->img_two;
            }
            if ($request->hasFile('img_three')) {
                if ($hostel->img_three) {
                    $old_path = $hostel->img_three;
                    if (File::exists($old_path)) {
                        File::delete($old_path);
                    }
                }
                $image_name_three = 'hostel-image-' . $request->name . '-' . rand(1000, 9999) . '-' . $user->name . '-' . rand(1000, 9999) . time() . rand(1000, 9999) . '.' . $request->img_three->extension();
                $image_name_three = str_replace(' ', '-', $image_name_three);
                $request->img_three->move(public_path('/uploads/hostels/images'), $image_name_three);
                $image_name_three = url('uploads/hostels/images/' . $image_name_three);
            } else {
                $image_name_three = $hostel->img_three;
            }

            //check name

            if ($request->name == Null) {
                $name = $hostel->name;
            } else {
                $name =  $request->name;
            }

            //price

            if ($request->price == Null) {
                $price = $hostel->price;
            } else {
                $price =  $request->price;
            }

            //location

            if ($request->location == Null) {
                $location = $hostel->location;
            } else {
                $location =  $request->location;
            }

            //no of rooms 

            if ($request->no_rooms == Null) {
                $no_rooms = $hostel->no_rooms;
            } else {
                $no_rooms =  $request->no_rooms;
            }

            //room type

            if ($request->room_type == Null) {
                $room_type = $hostel->room_type;
            } else {
                $room_type =  $request->room_type;
            }

            //hostel features

            if ($request->hostel_features == Null) {
                $hostel_features = $hostel->hostel_features;
            } else {
                $hostel_features =  $request->hostel_features;
            }

            $hostel->update([

                'name' => $name,
                'price' => $price,
                'location' => $location,
                'no_rooms' => $no_rooms,
                'room_type' => $room_type,
                'hostel_features' => $hostel_features,
                'img_one'  => $image_name_one,
                'img_two' =>  $image_name_two,
                'img_three'  => $image_name_three
            ]);

            return response([
                'message' => 'Successfully Updated Hostel',
                'status' => 'success',
                'statusCode' => '200'
            ], 200);
        }
    }

    //search
    public function search($name)
    {

        return HostelsResource::collection(Hostel::where("name", "like", "%" . $name . "%")->get());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(hostel $hostel)
    {

        $delete = $hostel->delete();

        return response([
            'message' => 'Successfully Deleted',
            'status' => 'success',
            'statusCode' => '200'
        ], 200);
        //
    }
}
