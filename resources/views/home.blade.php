@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3">
                    <div class="alert alert-info" role="alert" style="height:150px">
                        <h5>
                            @if($page == App\Http\Enums\PageName::HOME)
                            {{ __('Number of my Referral(s):') }}
                            @else
                            {{ __('Number of :userName Referral(s):', ['userName' => $user->name]) }}
                            @endif
                            <hr>
                            <div class="text-center">
                                <a href="{{ route('show', $user->id) }}">
                                    {{ $numOfMyReferrals }}
                                </a>
                            </div>
                        </h5>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card" style="height:150px">
                        <div class="card-header">{{ __('Referral link') }}</div>
                        <div class="card-body" >
                            <h6>
                                {{ 
                                    route('register', [
                                        'ref' => $user->id
                                    ]) 
                                }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
   
            <br>
            <div class="card">
                <div class="card-header">
                    @if($page == App\Http\Enums\PageName::HOME)
                    {{ __('Number of referrals per user sorted by top direct referrals') }}
                    @else
                    {{ __("Number of ':userName' referrals sorted by top direct referrals", ['userName' => $user->name]) }}
                    @endif
                </div>

                <div class="card-body">
                    @if($allUsers->count() == 0) 
                        <h4 class="text-center">
                            {{  __('No referrals') }}
                        </h4>
                    @endif

                    @foreach ($allUsers as $userItem)
                        <div class="row">
                            <div class="col-7">
                                <div class="alert alert-info" role="alert">
                                    <a href="{{ route('show', $userItem->id) }}">
                                    {{ $userItem->name }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="alert alert-info" role="alert">
                                    {{ 
                                        __(':num referral(s)', [
                                            'num' => $userItem->cnt
                                        ]) 
                                    }}
                                </div>
                            </div>
                        </div>
                    
                    @endforeach
                </div>
                <div class="card-footer">
                    {!! $allUsers->links() !!}
                </div>
            </div>

            @if($page == App\Http\Enums\PageName::SHOW)
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="alert alert-info" role="alert" style="height:150px">
                            <h6>
                                {{ __("Num of ':userName' direct/indirect referrals", [
                                        'userName' => $user->name
                                    ]) 
                                }}
                                <hr>
                                <div class="text-center">
                                    {{count($allChildUsers)}}
                                </div>
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                {{ __("Number of ':userName' referrals sorted by top ':userName' direct/indirect referrals", ['userName' => $user->name]) }}
                            </div>
                            
                            <div class="card-body">
                                @if(count($allChildUsers) == 0) 
                                    <h4 class="text-center">
                                        {{  __('No referrals') }}
                                    </h4>
                                @endif
                                @foreach ($allChildUsers as $userItem)
                                    <div class="alert alert-info" role="alert">
                                        <a href="{{ route('show', $userItem->id) }}">
                                            {{ $userItem->name }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
             
                </div>

            @endif
        </div>
    </div>
</div>
@endsection
