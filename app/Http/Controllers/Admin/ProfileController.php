<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profiles = Profile::all();

        return view('admin.profile.index', ['profiles' => $profiles]);
    }

    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $profile->fill($form);
      $profile->save();

      return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
          abort(404);    
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
  
  
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);

        $profile = Profile::find($request->id);
        $profile_form = $request->all();

        $profile_form = $request->all();
        unset($profile_form['_token']);
  
        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
  
        $history = new ProfileHistory;
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
  
        return redirect('admin/profiles');
    }
    public function delete(Request $request)
    {
        $profile = Profile::find($request->id);
        // 削除する
        $profile->delete();
        return redirect('admin/profiles/');
    }  

}
