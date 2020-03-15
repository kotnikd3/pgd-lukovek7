<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:update,news')->only(['edit', 'update', 'destroy']);
    }
    
    /**
     * Return all resources in JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Vrni vse novice, ki so casovno urejene po atributu 'created_at', v JSON.
        return News::latest()->paginate(10);
        // Vrni vse novice, z uporabnikom, ki so casovno urejene po atributu 'created_at', v JSON.
        // return News::with('owner')->latest()->get()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create', ['type' => News::TYPE]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Avtorizacija ni potrebna, saj lahko vsak avtentificiran uporabnik ustvari novico.
        request()->validate([
            'title' => ['required', 'string', 'max:255', 'min:5'],
            'body' => ['required', 'string', 'max:2000', 'min:10'],
            'pictures.*' => ['mimes:jpeg,png,jpg', 'max:8192'], // Najvec 8 MB.
            'type' => ['required']
        ]);


        $news = News::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'user_id' => auth()->id(),
            'type' => $request['type']
        ]);

        // Mail::to($news->owner->email)->send(

        // );

        if ($request->hasFile('pictures')) {
            // Če ne obstaja direktorij z imenom ID ustvarjene novice ...
            if(!Storage::disk('public')->exists('news/' . $news->id)) {
                // ... ga ustvari.
                Storage::disk('public')->makeDirectory('news/' . $news->id);
            }
            // Skozi vse slike.
            foreach ($request->file('pictures') as $file) {
                $fileName = $file->getClientOriginalName();
                $fileExt = $file->getClientOriginalExtension();
                // Shrani sliko v ustrezen direktorij.
                Storage::disk('public')->put('news/' . $news->id . '/' . $fileName, file_get_contents($file));
            }

        }

        session()->flash('created', 'Novica z naslovom ' . $request['title'] . " ustvarjena.");
        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        // $this->authorize('update', $news);
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        // $this->authorize('update', $news);

        request()->validate([
            'title' => ['required', 'string', 'max:255', 'min:5'],
            'body' => ['required', 'string', 'max:2000', 'min:10'],
            'pictures.*' => ['mimes:jpeg,png,jpg', 'max:8192'], // Najvec 8 MB.
            'type' => ['required']
        ]);

        // Posodobi naslov in telo novice.
        $news->update(request(['title', 'body', 'type']));

        // Posodobi slike, nalozi nove.
        if ($request->hasFile('pictures')) {
            // Če ne obstaja direktorij z imenom ID ustvarjene novice ...
            if(!Storage::disk('public')->exists('news/' . $news->id)) {
                // ... ga ustvari.
                Storage::disk('public')->makeDirectory('news/' . $news->id);
            }
            // Skozi vse slike.
            foreach ($request->file('pictures') as $file) {
                $fileName = $file->getClientOriginalName();
                //$fileExt = $file->getClientOriginalExtension();
                // Shrani sliko v ustrezen direktorij.
                Storage::disk('public')->put('news/' . $news->id . '/' . $fileName, file_get_contents($file));
            }
        }

        if($request->delete) {
            // Izbrisi obkljukane slike.
            foreach ($request->delete as $file) {
                Storage::disk('public')->delete($file);
            }

            // Ce je mapa prazna jo izbrisi.
            if (count(Storage::disk('public')->files('news/' . $news->id)) < 1) {
                Storage::disk('public')->deleteDirectory('news/' . $news->id);
            }
        }

        session()->flash('update', 'Novica z naslovom ' . $news->title . " posodobljena.");

        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        // $this->authorize('update', $news);

        $news->delete();

        // Izbrisemo mapo z vsemi slikami.
        if(Storage::disk('public')->exists('news/' . $news->id)) {
            Storage::disk('public')->deleteDirectory('news/' . $news->id);
        }
        
        // session()->flash('delete', 'Novica z naslovom ' . $news->title . " izbrisana.");
        
        return response()->json($news, 200);
    }
}
