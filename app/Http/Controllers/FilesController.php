<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{

    /**
     * Return all resources in JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filesCollection = collect();
        // Get the data from all the public files.
        foreach (Storage::disk('public')->files('files/') as $file)
        {
            $name = basename($file);
            $size = Storage::disk('public')->size($file);
            $path = Storage::disk('public')->url($file);
            $type = Storage::disk('public')->mimeType($file);
            
            $filesCollection->push(['name' => $name, 'size' => $size, 'path' => $path, 'type' => $type]);
        }
        return view('files.index', compact('filesCollection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}
