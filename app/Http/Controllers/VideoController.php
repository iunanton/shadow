<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Jobs\ProcessVideo;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-flv,video/webm,video/x-msvideo',
        ]);

        $path = $request->file('video')->store('/', 'uploads');

        $id = pathinfo($path, PATHINFO_FILENAME);
        $name = $request->file('video')->getClientOriginalName();
        $title = pathinfo($name, PATHINFO_FILENAME);
        $owner = $request->user()->id;

        Video::create([
            'id' => $id,
            'title' => $title,
            'user_id' => $owner
        ]);

        ProcessVideo::dispatch($path);

        return redirect(action('VideoController@index'))
                   ->with('status', 'Successfully uploaded the video!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('video.show')->with('video', $video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
