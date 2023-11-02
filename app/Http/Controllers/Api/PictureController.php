<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function index()
    {
        $pictures = Picture::all( 'apartment_id', 'img_url');

        return response()->json([
            'success'   => true,
            'results'   => $pictures
        ]);
    }
}