<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
class ImageGalleryController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(7,1);
    }

    public function showPanelGalley()
    {
        $Navigation = $this->Navigation;
        
        return view('config.image_gallery', compact('Navigation'));
    }
}
