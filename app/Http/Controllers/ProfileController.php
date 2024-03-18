<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Tag;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $tags = Tag::all(); // タグの一覧を取得する（適切なモデルとして修正してください）
        
        return view('profile.edit', [
            'user' => $user,
            'tags' => $tags, // ビューにタグの一覧を渡す
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // ユーザー名とメールアドレスの更新
    $user->fill($request->safe()->only(['name', 'email']));

    // メールアドレスが変更された場合、メール確認情報をリセット
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // プロフィール画像の更新
    if ($request->hasFile('picture')) {
        $path = $request->file('picture')->store('profile-icons', 'public');
        $user->profile_photo_path = $path;
    }

    // タグの更新
    $user->tags()->sync($request->input('tags'));

    // ユーザー情報の保存
    $user->save();

    // プロフィール編集画面にリダイレクト
    return redirect()->route('profile.edit')->with('status', 'profile-updated');
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

    // ユーザーに関連する投稿を手動で削除
    $user->posts()->delete();

    // ユーザーアカウントを削除
    $user->delete();

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}
 
}
