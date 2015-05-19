<?php namespace App\Repositories;

interface IFilesRepository {
	
	public function getAll();
	
	public function saveFile();
	
	public function uploadByFilename($filename);
	
	public function updateFileByFilename($filename);
}