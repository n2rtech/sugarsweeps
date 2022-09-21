<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamingPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class GamingPlatformController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $platforms = GamingPlatform::all();
        return view('admin.gaming-platforms.list', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gaming-platforms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'platform' => 'required',
        ]);

        $platform                       = new GamingPlatform();
        $platform->platform             = $request->platform;
        $platform->download_link        = $request->download_link;
        $platform->status               = isset($request->status) ? 1 : 0;
        if($request->hasfile('image')){

            $image                      = $request->file('image');

            $name                       = $image->getClientOriginalName();

            $image->storeAs('uploads/gaming-platforms/', $name, 'public');

            $platform->image            = $name;

        }

        $platform->save();

        return redirect()->route('admin.gaming-platforms.index')->with('success', 'Gaming Platform added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $platform = GamingPlatform::find($id);
        if($platform->status == 1){
            $platform->status = 0;
            $platform->save();
            return redirect()->route('admin.gaming-platforms.index')->with('success', 'Gaming Platform disabled successfully');
        }else{
            $platform->status = 1;
            $platform->save();
            return redirect()->route('admin.gaming-platforms.index')->with('success', 'Gaming Platform enabled successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $platform = GamingPlatform::find($id);
        $platform->image = isset($platform->image) ? asset('storage/uploads/gaming-platforms/'.$platform->image) : 'https://via.placeholder.com/244' ;
        return view('admin.gaming-platforms.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'platform' => 'required',
        ]);

        $platform                       = GamingPlatform::find($id);
        $platform->platform             = $request->platform;
        $platform->download_link        = $request->download_link;
        $platform->status               = isset($request->status) ? 1 : 0;
        if($request->hasfile('image')){

            $image                      = $request->file('image');

            $name                       = $image->getClientOriginalName();

            $image->storeAs('uploads/gaming-platforms/', $name, 'public');

            if(isset($platform->image)){

                $path                   = 'public/uploads/gaming-platforms/'.$platform->image;

                Storage::delete($path);

            }

            $platform->image            = $name;

        }
        $platform->save();

        return redirect()->route('admin.gaming-platforms.index')->with('success', 'Gaming Platform updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $platform = GamingPlatform::find($id)->delete();
        return redirect()->route('admin.gaming-platforms.index')->with('success', 'Gaming Platform deleted successfully');
    }
}
