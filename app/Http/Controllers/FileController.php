<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::orderBy('created_at', 'desc')->get();

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

        if (file_exists($filePath . '/' . $safeName)) {
            $safeName = pathinfo($safeName, PATHINFO_FILENAME) . '_' . time() . '.' . $request->file->extension();
        }

        $request->file->move($filePath, $safeName);

        $file = new File();
        $file->name = $request->name;
        $file->description = $request->description;
        $file->file_name = $safeName;
        $file->path = $directory;
        $file->user_id = $user->id;
        $file->save();

        return back()->with('success', 'File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        return view('File.show', compact('file'));
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
    public function destroy(File $file): RedirectResponse
    {
        $filePath = public_path($file->folder . '/' . $file->file_name);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $file->delete();

        return back()->with('success', 'Arquivo excluído com sucesso.');
    }

    public function download(File $file)
    {
        $filePath = public_path($file->folder . '/' . $file->file_name);

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->download($filePath, $file->file_name);
    }
}
