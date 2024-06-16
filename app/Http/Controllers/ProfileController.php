<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, Category $category): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ])->with(['categories' => $category->get()]);;
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
    
       
        $user = $request->user();

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        $categoryIds = $request->input('category_array');
        $user->categories()->sync($categoryIds);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    public function store(Request $request, User $user)
    {
        $input_user = $request['user'];
        $input_categories = $request->categories_array;  //subjects_arrayはnameで設定した配列名
        
        //先にstudentsテーブルにデータを保存
        $user->fill($input_user)->save();
        
        //attachメソッドを使って中間テーブルにデータを保存
        $user->categories()->attach($input_categories); 
        return Redirect::to('/');
    }
}
