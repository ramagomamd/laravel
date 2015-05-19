<?php namespace App\Repositories;
use App\Repositories\IFilesRepository;
use App\File;
use App\Http\Requests\CreateFileRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as Lara;

class FilesRepository {
	
	public function getAll() {
		return File::all();
	}
	
	public function saveFile(CreateFileRequest $request) {
		$file = $request->file("file");
		$extension = $file->getClientOriginalExtension();
		$filename = $file->getFileName();
		
		Storage::disk("local")->put($filename.'.'.$extension, Lara::get($file));
		
		$upload = new File();
		$upload->filename = $filename;
		$upload->description = $request->input("description");
		$upload->filesize = $file->getClientSize();
		$upload->url = url("/".$filename.'.'.$extension);
		return $upload->save();
	}
	
	public function uploadByFilename($filename) {
		return File::where("filename", "=", $filename)->firstOrFail();
	}
	
	public function updateFileByFilename($filename) {
		$file = File::where("filename", "=", $filename)->firstOrFail();
		$file->filename = $filename;
		$file->description = $request->input("description");
		$upload->filesize = '';
		$file->url = url("/".$filename.'.'.$extension);
		return $file->save();
		
	}
}