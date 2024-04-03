<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Tag;
use Cloudinary;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Tag $tag): View
    {
        return view('auth.register')->with(['tags' => $tag->get()]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tags_array' => ['required', 'array', 'min:1'], // タグを少なくとも1つ以上選択する必要がある
        ], [
            'tags_array.required' => '少なくとも1つのタグを選択してください。',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // プロフィール画像の保存
        $input_user = $request->only(['user']); // $request->input('user')ではなく$request->only(['user'])です

    if ($request->hasFile('image')) {
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input_user['profile_photo_path'] = $image_url;
    }elseif ($request->has('remove_picture')) {
        // 画像を削除する場合は、プロフィール画像パスを null に設定
        $input_user['profile_photo_path'] = null; // $input_user->profile_photo_path ではなく $input_user['profile_photo_path'] です
    }
        $user->fill($input_user)->save();

        event(new Registered($user));

        Auth::login($user);

        $input_tags = $request->tags_array ?? [];
        $user->tags()->attach($input_tags);

        return redirect('/index');
    }
}
