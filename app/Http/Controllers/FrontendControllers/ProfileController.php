<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function profile($uuid)
    {
        $data = $this->profileService->profile($uuid);

        return view('frontend.profile.your_profile', $data);
    }

    public function edit($uuid)
    {
        $data = $this->profileService->edit($uuid);

        return view('frontend.profile.edit', $data);
    }

    public function update(ProfileUpdateFormRequest $request, $id)
    {

        $request->validated();
        $this->profileService->update($request, $id);

        return back()->with('success', 'User information updated Successfully!');
    }
}
