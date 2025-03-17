<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePictureUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
  /**
   * Display the user's profile form.
   */
  public function edit(): Response
  {
    return Inertia::render('Profile/ProfileView');
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit');
  }

  public function updateProfilePicture(ProfilePictureUpdateRequest $request): RedirectResponse
  {
    $data = $request->validated();
    /** @var User $user */
    $user = auth()->user();

    if (isset($data['img_profile'])) {
      $data['img_profile'] = $this->setImageUrl(
        $request->file('img_profile'),
        now()->toIso8601String()
      );

      $user->img_profile = $data['img_profile'];
    } else {
      $user->img_profile = 'https://ui-avatars.com/api/?name=' . $user->firstname.$user->lastname .'background=random&rounded=true';
    }

    $user->save();

    return Redirect::route('profile.edit');
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request): RedirectResponse
  {
    $request->validate([
      'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }

  protected function setImageUrl($file, string $name): string
  {
    $ext = $file->extension();
    $path = $file->storeAs('profile-pictures', Str::slug($name) . '.' . $ext, 'public');

    return '/storage/' . $path;
  }
}
