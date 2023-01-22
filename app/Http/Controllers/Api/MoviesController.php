<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Genres;
use App\Models\Authors;
use App\Models\Comments;
use App\Http\Resources\MoviesResource;
use Validator;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use function response;
use Illuminate\Support\Facades\File;

class MoviesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movies::with('genres')
                ->with('authors')
                ->with('tags')
                ->orderByDesc("id")->paginate(1);
        return response()->json([
            'movies' => $movies
        ], 200);
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
     * @bodyParam store_id int required title. Example: 'Harry Potter'
     * @bodyParam store_id int required summary. Example: 'This is a awesome movie'
     * @bodyParam status string Status. Example: provisional
     * @bodyParam start_date_option1 date Reservation start_date_option1
     * @bodyParam start_date_option2 date Reservation start_date_option2
     * @bodyParam start_date date Reservation start_date
     * @bodyParam customer_comment string Reservation customer_comment
     * @bodyParam memo string Reservation memo
     * @bodyParam rating int Example: 4
     * @bodyParam genres int[] Example: [2]
     * @bodyParam authors int[] Example: [2]
     * @bodyParam genres tags[] Example: [2]
     * @responseFile status=200 message data
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => ['required', 'max:20'],
                'summary' =>  ['required', 'max:200'],
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
                'rating' => 'numeric|min:3|max:8',
                'link' =>  ['required', 'max:100'],
                'genres' => 'required|array|min:1',
                'genres.*' => 'exists:genres,id',
                'authors' => 'required|array|min:1',
                'authors.*' => 'exists:authors,id',
                'tags' => 'array|min:1',
                'tags.*' => 'exists:tags,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            
            $movies = Movies::create($request->except(['genres','authors','tags']));
            
            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                // To store the file to the 'storage/app/public/image' folder,
                $file->storeAs('public/image', $filename);
                $movies->image = $filename;
                $movies->save();
            }
            if ($request->has('genres')) {
                foreach ((array)$request->get('genres') as $genresID) {
                    $movies->Genres()->attach($genresID);
                }
            }
            if ($request->has('authors')) {
                foreach ((array)$request->get('authors') as $authorsID) {
                    $movies->Authors()->attach($authorsID);
                }
            }
            if ($request->has('tags')) {
                foreach ((array)$request->get('tags') as $tagsID) {
                    $movies->Tags()->attach($tagsID);
                }
            }
            // return new MoviesResource($movies);
            return response()->json([
                'status' => 200,
                'message' => "Save Successfully!",
                'data' => $movies,
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
     * Get movie by ID
     *
     * @param Movies $movies
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        try {
            $movies = Movies::with('genres')
                            ->with('authors')
                            ->with('tags')
                            ->where('id',$id)->first();
            $comment = Comments::all()->where('movie_id', $id);
            
            return response()->json([
                'status' => 200,
                'data' => $movies,
                'comments' => $comment,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'messages' => ['movie does not exist'],
                ]
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit(Movies $movies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movies  $movies
     * @return \Illuminate\Http\Response
     * @bodyParam store_id int required title. Example: 'Harry Potter'
     * @bodyParam store_id int required summary. Example: 'This is a awesome movie'
     * @bodyParam status string Status. Example: provisional
     * @bodyParam start_date_option1 date Reservation start_date_option1
     * @bodyParam start_date_option2 date Reservation start_date_option2
     * @bodyParam start_date date Reservation start_date
     * @bodyParam customer_comment string Reservation customer_comment
     * @bodyParam memo string Reservation memo
     * @bodyParam rating int Example: 4
     * @bodyParam genres int[] Example: [2]
     * @bodyParam authors int[] Example: [2]
     * @bodyParam genres tags[] Example: [2]
     * @responseFile status=200 message data
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['max:20'],
            'summary' =>  ['required', 'max:200'],
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'rating' => 'numeric|min:3|max:8',
            'link' =>  ['max:100'],
            'genres' => 'array|min:1',
            'genres.*' => 'exists:genres,id',
            'authors' => 'array|min:1',
            'authors.*' => 'exists:authors,id',
            'tags' => 'array|min:1',
            'tags.*' => 'exists:tags,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {
            $movies = Movies::find($id);
            $movies->fill($request->all());

            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                // To store the file to the 'storage/app/public/image' folder,
                $file->storeAs('public/image', $filename);
                $movies->image = $filename;
                $movies->save();
            }
            if ($request->has('genres')) {
                foreach ((array)$request->get('genres') as $genresID) {
                    $movies->Genres()->attach($genresID);
                }
            }
            if ($request->has('authors')) {
                foreach ((array)$request->get('authors') as $authorsID) {
                    $movies->Authors()->attach($authorsID);
                }
            }
            if ($request->has('tags')) {
                foreach ((array)$request->get('tags') as $tagsID) {
                    $movies->Tags()->attach($tagsID);
                }
            }
            return response()->json([
                'status' => 200,
                'message' => "Update Successfully!",
                'data' => $movies
            ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'messages' => ['Update Fail'],
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $moviesDelete = Movies::find($id);
            $imageName = $moviesDelete->image;
            if( $moviesDelete ){
                $moviesDelete->delete();
                $image_path = "public/image".$imageName;  // Value is not URL but directory file path
                
                if(File::exists($image_path)) {
                    return response()->json([
                        'message' => "Foud"
                    ], 200);
                }
                return response()->json([
                    'status' => 200,
                    'message' => "Delete successfully!"
                ], 200);
            } else{
                    return response()->json([
                        'status' => 204,
                        'message' => "Delete Fail!"
                    ], 422);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'messages' => ['Delete Fail'],
                ]
            ]);
        }
    }
}
