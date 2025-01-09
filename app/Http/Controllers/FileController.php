<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::orderBy("created_at","desc")->paginate(10);

        return view("File.index", compact("files"));
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
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

        $user = auth()->user();
        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $directory = 'uploads/docs/' . $user->name . '/' . $year .'/'. $month .'/'. $day;

        $originalName = $request->file->getClientOriginalName();
        $safeName = preg_replace('/[^a-zA-Z0-9_\.\-]/', '_', $originalName);
        $filePath = public_path($directory);

        $request->file->move($filePath, $safeName);

        return back()->with('success', 'File uploaded successfully!')
            ->with('file', $safeName);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
