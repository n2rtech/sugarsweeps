<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamingPackage;
use App\Models\GamingPlatform;
use Illuminate\Http\Request;

class GamingPackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $packages = GamingPackage::paginate(20);
        return view('admin.gaming-packages.list', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $platforms = GamingPlatform::get();
        foreach($platforms as $platform){
            $platform->image = isset($platform->image) ? asset('storage/uploads/gaming-platforms/' . $platform->image) : asset('assets/img/game-placeholder.jpg') ;
        }
        return view('admin.gaming-packages.create', compact('platforms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'package'           => 'required',
            'password'          => 'required',
            'gemini'            => 'required',
            'orionstars'        => 'required',
            'riversweeps'       => 'required',
            'vpower'            => 'required',
            'ultramonster'      => 'required',
            'firekirin'         => 'required',
            'bluedragons'       => 'required',
            'pandamaster'       => 'required',
        ];

        $messages = [
            'package.required'           => 'Please enter Package name',
            'password.required'          => 'Please enter Default password',
            'gemini.required'            => 'Please enter Gemini Username',
            'orionstars.required'        => 'Please enter Orion Stars Username',
            'riversweeps.required'       => 'Please enter Riversweeps Username',
            'vpower.required'            => 'Please enter V Power Username',
            'ultramonster.required'      => 'Please enter Ultramonster Username',
            'firekirin.required'         => 'Please enter Firekirin Username.',
            'bluedragons.required'       => 'Please enter Blue Dragons Username',
            'pandamaster.required'       => 'Please enter Panda Master Username.',
        ];

        $this->validate($request, $rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import(){
        return view('admin.gaming-packages.import');
    }
}
