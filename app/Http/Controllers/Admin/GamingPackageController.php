<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamingPackage;
use App\Models\GamingPlatform;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GamingPackageImport;
use App\Exports\GamingPackageExport;


class GamingPackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $packages = GamingPackage::orderBy('id', 'desc')->paginate(20);
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
        foreach ($platforms as $platform) {
            $platform->image = isset($platform->image) ? asset('storage/uploads/gaming-platforms/' . $platform->image) : asset('assets/img/game-placeholder.jpg');
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
            'package'           => 'required|unique:gaming_packages',
            'password'          => 'required',
            'gemini'            => 'required|unique:gaming_packages',
            'orionstars'        => 'required|unique:gaming_packages',
            'riversweeps'       => 'required|unique:gaming_packages',
            'vpower'            => 'required|unique:gaming_packages',
            'ultramonster'      => 'required|unique:gaming_packages',
            'firekirin'         => 'required|unique:gaming_packages',
            'bluedragons'       => 'required|unique:gaming_packages',
            'pandamaster'       => 'required|unique:gaming_packages',
        ];

        $messages = [
            'package.required'           => 'Please enter Package name',
            'package.unique'             => 'This Package name is already taken',
            'password.required'          => 'Please enter Default password',
            'gemini.required'            => 'Please enter Gemini Username',
            'gemini.unique'              => 'This Gemini Username is already taken',
            'orionstars.required'        => 'Please enter Orion Stars Username',
            'orionstars.unique'          => 'This Orion Stars Username is already taken',
            'riversweeps.required'       => 'Please enter Riversweeps Username',
            'riversweeps.unique'         => 'This Riversweeps Username is already taken',
            'vpower.required'            => 'Please enter V Power Username',
            'vpower.unique'              => 'This V Power Username is already taken',
            'ultramonster.required'      => 'Please enter Ultramonster Username',
            'ultramonster.unique'        => 'This Ultramonster Username is already taken',
            'firekirin.required'         => 'Please enter Firekirin Username.',
            'firekirin.unique'           => 'This Firekirin Username is already taken',
            'bluedragons.required'       => 'Please enter Blue Dragons Username',
            'bluedragons.unique'         => 'This Blue Dragons Username is already taken',
            'pandamaster.required'       => 'Please enter Panda Master Username.',
            'pandamaster.unique'         => 'This Panda Master Username is already taken',
        ];

        $this->validate($request, $rules, $messages);

        $package                = new GamingPackage();
        $package->package       = $request->package;
        $package->password      = $request->password;
        $package->gemini        = $request->gemini;
        $package->orionstars    = $request->orionstars;
        $package->riversweeps   = $request->riversweeps;
        $package->vpower        = $request->vpower;
        $package->ultramonster  = $request->ultramonster;
        $package->firekirin     = $request->firekirin;
        $package->bluedragons   = $request->bluedragons;
        $package->pandamaster   = $request->pandamaster;
        $package->save();

        return redirect()->route('admin.gaming-packages.index')->with('success', 'Gaming Package created successfully');
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
        $platforms = GamingPlatform::get();
        foreach ($platforms as $platform) {
            $platform->image = isset($platform->image) ? asset('storage/uploads/gaming-platforms/' . $platform->image) : asset('assets/img/game-placeholder.jpg');
            $platform->username = GamingPackage::where('id', $id)->value(Str::lower(str_replace(' ', '', $platform->platform)));
        }
        $package   = GamingPackage::find($id);
        return view('admin.gaming-packages.edit', compact('platforms', 'package'));
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
        $rules = [
            'package'           => ['required', 'unique:gaming_packages,package,' . $id],
            'password'          => ['required'],
            'gemini'            => ['required', 'unique:gaming_packages,gemini,' . $id],
            'orionstars'        => ['required', 'unique:gaming_packages,orionstars,' . $id],
            'riversweeps'       => ['required', 'unique:gaming_packages,riversweeps,' . $id],
            'vpower'            => ['required', 'unique:gaming_packages,vpower,' . $id],
            'ultramonster'      => ['required', 'unique:gaming_packages,ultramonster,' . $id],
            'firekirin'         => ['required', 'unique:gaming_packages,firekirin,' . $id],
            'bluedragons'       => ['required', 'unique:gaming_packages,bluedragons,' . $id],
            'pandamaster'       => ['required', 'unique:gaming_packages,pandamaster,' . $id],
        ];

        $messages = [
            'package.required'           => 'Please enter Package name',
            'package.unique'             => 'This Package name is already taken',
            'password.required'          => 'Please enter Default password',
            'gemini.required'            => 'Please enter Gemini Username',
            'gemini.unique'              => 'This Gemini Username is already taken',
            'orionstars.required'        => 'Please enter Orion Stars Username',
            'orionstars.unique'          => 'This Orion Stars Username is already taken',
            'riversweeps.required'       => 'Please enter Riversweeps Username',
            'riversweeps.unique'         => 'This Riversweeps Username is already taken',
            'vpower.required'            => 'Please enter V Power Username',
            'vpower.unique'              => 'This V Power Username is already taken',
            'ultramonster.required'      => 'Please enter Ultramonster Username',
            'ultramonster.unique'        => 'This Ultramonster Username is already taken',
            'firekirin.required'         => 'Please enter Firekirin Username.',
            'firekirin.unique'           => 'This Firekirin Username is already taken',
            'bluedragons.required'       => 'Please enter Blue Dragons Username',
            'bluedragons.unique'         => 'This Blue Dragons Username is already taken',
            'pandamaster.required'       => 'Please enter Panda Master Username.',
            'pandamaster.unique'         => 'This Panda Master Username is already taken',
        ];

        $this->validate($request, $rules, $messages);

        $package                = GamingPackage::find($id);
        $package->package       = $request->package;
        $package->password      = $request->password;
        $package->gemini        = $request->gemini;
        $package->orionstars    = $request->orionstars;
        $package->riversweeps   = $request->riversweeps;
        $package->vpower        = $request->vpower;
        $package->ultramonster  = $request->ultramonster;
        $package->firekirin     = $request->firekirin;
        $package->bluedragons   = $request->bluedragons;
        $package->pandamaster   = $request->pandamaster;
        $package->save();

        return redirect()->route('admin.gaming-packages.index')->with('success', 'Gaming Package updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GamingPackage::find($id)->delete();

        return redirect()->route('admin.gaming-packages.index')->with('success', 'Gaming Package deleted successfully');
    }

    public function importExport()
    {
        return view('admin.gaming-packages.import-export');
    }

    public function import(Request $request)
    {
       $this->validate($request,[
            'file' => 'required',
       ]);
       Excel::import(new GamingPackageImport(), $request->file);


       return redirect()->route('admin.gaming-packages.index')->with('success', 'All Gaming packages imported successfully!');
    }

    public function export(Request $request)
    {
        $this->validate($request,[
            'type' => 'required',
       ]);

       $data = $request->all();
		return Excel::download(new GamingPackageExport($data), 'packages.xlsx');

    }
}
