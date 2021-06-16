<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allUsers = User::query()
            ->select([
                'users.*',
                DB::raw('(select count(*) from users u where u.referrer_id = users.id) as cnt')
            ])
            ->orderBy('cnt', 'desc')
            ->paginate(3);

        return view('home', [
            'allUsers' => $allUsers
        ]);
    }
}
