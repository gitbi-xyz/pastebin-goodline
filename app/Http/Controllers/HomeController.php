<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the user pastes list.
     *
     * @return Renderable
     */
    public function index()
    {
        $date = Carbon::now();
        $user_pastes = Paste::whereNull('expires_at')
            ->orWhere(function($query) use ($date) {
                $query->where('expires_at', '>=',$date);
            })->where('user_id',Auth::id())->paginate(2);
        return view('home',['pastes'=>$user_pastes]);
    }
}
