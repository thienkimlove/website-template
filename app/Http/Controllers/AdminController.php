<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('permission');
    }

    /**
     * Save images
     * @param $file
     * @param null $old
     * @return string
     */
    public function saveImage($file, $old = null)
    {
        $filename = md5(time()) . '.' . $file->getClientOriginalExtension();
        Image::make($file->getRealPath())->save(public_path('files/'. $filename));

        if ($old) {
            @unlink(public_path('files/' .$old));
        }
        return $filename;
    }
}
