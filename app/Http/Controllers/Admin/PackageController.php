<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function packages()
    {
        $packages = Package::all();
        return view('dashboard.package.packages',[
            'packages' => $packages
        ]);
    }
    public function addPackage(Request $request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price
        ];
        Package::create($data);
        return redirect()->back();
    }
    public function updatePackage(Request $request)
    {
        $package = Package::find($request->package_id);
        $package->name = $request->name;
        $package->price = $request->price;
        $package->save();
        return redirect()->back(); 
    }
    public function deletePackage($package_id)
    {
        $package = Package::find($package_id)->delete();
        return redirect()->back();
    }
}
