<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFileRequest;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as Lara;
use Auth;

use Illuminate\Http\Request;

class FilesController extends Controller {
	protected $files;

	public function __construct() {
		$this->middleware("auth");
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$files = File::all();
		return view("files.index", compact("files"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("files.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateFileRequest $request)
	{
		$file = $request->file("file");
		if($file->isValid()) {
			$extension = $file->getClientOriginalExtension();
			$filename = $file->getFileName();
		
			Storage::disk("local")->put($filename.'.'.$extension, Lara::get($file));
			$upload = new File();
			$upload->filename = $filename;
			$upload->description = $request->input("description");
			$upload->filesize = $file->getClientSize();
			$upload->url = '';
			$upload->user_id = Auth::user()->id;
			$upload->save();
			flash("Your File Was Uploaded Successfully");
		
			return redirect()->route("files.index");
		}
		return redirect()->back()->withInput()->withErrors($file->getError());	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($filename)
	{
		$file = File::where("filename", "=", $filename)->firstOrFail();
		
		return view("files.show", compact("file"));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($filename)
	{
		$file = File::where("filename", "=", $filename)->firstOrFail();
		return view("uploads.edit", compact("file"));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($filename)
	{
		$file = File::where("filename", "=", $filename)->firstOrFail();
		$file->filename = $filename;
		$file->description = $request->input("description");
		$upload->filesize = '';
		$file->url = url("/".$filename.'.'.$extension);
		$file->user->save();
		flash("File edited Successfully");
		
		return redirect()->route("uploads.index");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($filename)
	{
		$file = File::where("filename", "=", $filename)->firstOrFail();
		$file->delete();
		
		return redirect()->route("files.index");
	}

}
