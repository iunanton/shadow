<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Message;
use App\Jobs\ProcessMessage;

class MessageController extends Controller
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
        $userId = Auth::user()->id;
        $messages = Message::where('status', 3)
            ->where('sender_id', $userId)
            ->orWhere('recipient_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('message.index', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('message.create', ['recipient' => $user]);
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
            'recipient' => 'required|string',
            'video' => 'required|string',
        ]);

        $data = explode(';base64,', $request->input('video'));
        $path = str_random(40);
        Storage::disk('uploads')->put($path, base64_decode($data[1]));

        $recipient = User::where('username', $request->input('recipient'))->firstOrFail();

        Message::create([
            'id' => $path,
            'sender_id' => $request->user()->id,
            'recipient_id' => $recipient->id,
        ]);

        ProcessMessage::dispatch($path)->onQueue('messages');

        return redirect(action('MessageController@index'))
                   ->with('status', 'Message successfully sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('message.show', ['message' => $message]);
    }

    public function getAsset(Message $message, $file)
    {
        //$this->authorize('view', $message);
        return Storage::disk('messages')->download("$message->id/$file")->setPrivate();
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
