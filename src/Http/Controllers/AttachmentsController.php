<?php
namespace Rainsens\Simplemde\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Rainsens\Simplemde\Handlers\ImageUploadHandler;

class AttachmentsController extends Controller
{
	public function upload(Request $request, ImageUploadHandler $handler)
	{
		if ($image = $request->file('img')) {
			if ($result = $handler->save($image, 'images', 600)) {
				return Response::json(['filename' => $result['storage_path']]);
			}
		}
		return null;
	}
}
