<?php

namespace Dotlogics\Grapesjs\App\Http\Controllers;

use Dotlogics\Media\App\Models\TempMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dotlogics\Grapesjs\App\Editor\AssetRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AssetController extends Controller
{
    use ValidatesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file' => 'bail|required|array|min:1',
            'file.*' => 'bail|required|max:102400'
        ]);

        $media = TempMedia::create()
            ->addMediaFromRequest('file')
            ->toMediaCollection('default');
        
        $response = [
            'data' => [
                $media->getFullUrl()
            ]
        ];

        return response()->json($response);
    }
}
