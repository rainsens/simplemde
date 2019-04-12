<?php
namespace Rainsens\Simplemde\Handlers;

use Image;
use Storage;

class ImageUploadHandler
{
	protected $allowed_ext = ['jpeg', 'jpg', 'png', 'gif'];
	
	public function save($file, $folder, $max_width = false)
	{
		$folder_name = "uploads/$folder/" . date("Ym/d", time());
		$upload_path = Storage::disk('public')->path($folder_name);
		$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
		$filename = time() . '_' . str_random(10) . '.' . $extension;
		
		if (!in_array($extension, $this->allowed_ext)) {
			return false;
		}
		
		$file->move($upload_path, $filename);
		
		if ($max_width && $extension != 'gif') {
			$this->reduceSize($upload_path . '/' . $filename, $max_width);
		}
		
		return [
			'path' => "$folder_name/$filename",
			'storage_path' => "/storage/$folder_name/$filename",
			'full_path' => Storage::disk('public')->url($folder_name.'/'.$filename),
		];
	}
	
	public function reduceSize($file_path, $max_width)
	{
		$image = Image::make($file_path);
		$image->resize($max_width, null, function ($constraint) {
			$constraint->aspectRatio();
			$constraint->upsize();
		});
		$image->save();
	}
}
