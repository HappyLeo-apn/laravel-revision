<?php

namespace App\Http\Controllers;

use App\Models\MyFriends;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyFriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friends = MyFriends::all();
        return response()->json($friends, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jsonData = $request->getContent();

        $data = json_decode($jsonData);
        $jsonFile = '../database/data/myFriends.json';
        $existingData = json_decode(file_get_contents($jsonFile), true);
        $existingData[] = $data;
        $updatedData = json_encode($existingData, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $updatedData);
        return response()->json(['Data stored successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(MyFriends $myFriends, $id)
    {
      $friend = MyFriends::where('id', $id)->get();

        return response()->json($friend, Response::HTTP_OK);
    }

    public function showAge($id){
        $friend = MyFriends::where('id', $id)->first();

        $age = $friend['age'];
        return response()->json($age);
    }

    public function showHobby($id){
        $friend = MyFriends::where('id', $id)->first();
        $hobby = json_decode($friend->hobby, false, 512, JSON_UNESCAPED_SLASHES);


        return response()->json($hobby);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyFriends $myFriends)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyFriends $myFriends)
    {
        //
    }
}
