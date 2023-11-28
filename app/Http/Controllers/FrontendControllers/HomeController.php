<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\HomeService;
use App\Http\Requests\SearchFormRequest;

class HomeController extends Controller
{
    protected $homeService;
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    public function home()
    {
        $data = $this->homeService->home();
        return view('frontend.home', $data);
    }

    public function search(SearchFormRequest $request)
    {
        $data = $this->homeService->search($request);

        return view('frontend.search', $data);
    }
}
