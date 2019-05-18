<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        
        $profiles = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profiles->fill($form)->save();
        

        
        return redirect('admin/profile/create');
    }
    
    public function edit(Request $request){
        $profile = Profile::find($request->id);
        if(empty($profile)){
            abort(404);
        }
        return view('admin.profile.edit',['profiles_form' => $profile]);
    }
    
    public function update(Request $request){
        $this->validate($request,Profile::$rules);
        $profile = Profile::find($request->id);
        $profiles_form = $request->all();
        
        unset($profiles_form['_token']);
        $profile->fill($profiles_form)->save();
        
        return view('admin.profile.edit',['profiles_form' => $profile]);
    }
}
