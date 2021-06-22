<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show the main page.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Main page form handler.
     *
     * @return RedirectResponse
     */
    public function indexHandler(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'content' => 'required',
            'language' => 'required',
            'access_type' => 'required',
            'expires_at' => 'required',
        ]);
        $fields = [
            'name'  => $validated['name'],
            'access_type'  => $validated['access_type'],
            'url_path'  => Str::random(12),
            'language'  => $validated['language'],
            'content'  => $validated['content'],
        ];
        $expires_at = str_replace('-',' ',$validated['expires_at']);
        $fields['expires_at'] = $expires_at === 'never' ? null : date('Y-m-d H:i:s',strtotime('+' . $expires_at));

        if(Auth::check()){
            $fields['user_id'] = Auth::id();
        }elseif ($fields['access_type'] === 'private'){
            $fields['access_type'] = 'unlisted';
        }

        $paste = Paste::create($fields);

        return redirect()->route('paste', [$paste->url_path]);
    }

    /**
     * Paste page.
     *
     * @return Renderable
     */
    public function paste(string $url)
    {
        $date = Carbon::now();
        $paste = Paste::where('url_path', $url)->where(function ($query) use ($date) {
            $query->whereNull('expires_at')
                ->orWhere('expires_at', '>=',$date);
        })->with('user')->first();
        if(!$paste){
            abort(404);
        }elseif($paste->access_type === 'private' and (!Auth::check() or Auth::id() !== $paste->user_id)){
            abort(403);
        }
        return view('paste',['paste' => $paste]);
    }
}
