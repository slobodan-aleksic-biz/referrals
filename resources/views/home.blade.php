@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Referral link') }}</div>
                <div class="card-body">
                    {{ route('register', [
                        'ref' => auth()->user()->id
                    ]) }}
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Number of referrals per user sorted by top referrals') }}</div>

                <div class="card-body">
                    @foreach ($allUsers as $user)
                        <div class="row">
                            <div class="col-7">
                                <div class="alert alert-info" role="alert">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="alert alert-info" role="alert">
                                    {{ 
                                        __(':num referral(s)', [
                                            'num' => $user->cnt
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
        </div>
    </div>
</div>
@endsection
