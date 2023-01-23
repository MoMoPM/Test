<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Comments;
use Validator;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Http\JsonResponse;
// use function response;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'comment' => 'required|min:8|max: 100',
            'movie_id' => 'required|numeric|exists:movies,id',
        ],[
            'email.email' => 'Pls input correct Email',
            'movie_id.exists' => 'Movie does not exist',
        ]);
        if($validate->fails()){
            return response()->json($validate->errors(), 422);
        }
        try {
            Comments::create($request->all());
            return response()->json([
                'status' => 200,
                'message' => "Save Successfully!",
                'data' => $request->all(),
            ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'messages' => ['Fail'],
                ]
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
