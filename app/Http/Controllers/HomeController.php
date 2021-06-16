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
        $user = auth()->user();

        [
            $numOfMyReferrals,
            $allUsers,
        ] = $this->defaultData($user);

        return view('home', [
            'numOfMyReferrals' => $numOfMyReferrals,
            'allUsers' => $allUsers,
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $numOfMyReferrals = User::numOfMyReferrals($user)->count();

        [
            $numOfMyReferrals,
            $allUsers,
        ] = $this->defaultData($user, false);

        return view('home', [
            'numOfMyReferrals' => $numOfMyReferrals,
            'allUsers' => $allUsers,
            'user' => $user,
        ]);
    }

    private function defaultData($user, $isIndex = true)
    {
        $numOfMyReferrals = User::numOfMyReferrals($user)->count();

        if($isIndex) {
            $allUsers = User::where('id', '!=', $user->id);
        } else {
            $allUsers = User::where('referrer_id', '=', $user->id);
        }

        $allUsers = $allUsers->select([
                'users.*',
                DB::raw('(select count(*) from users u where u.referrer_id = users.id) as cnt')
            ])
            ->orderBy('cnt', 'desc')
            ->paginate(3);

        return [
            $numOfMyReferrals,
            $allUsers
        ];
    }
}
