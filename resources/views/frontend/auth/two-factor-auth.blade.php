<x-front-layout title="Two Auth Factor">


    <x-slot name="breadcrumbs">


        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Login</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ Route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot>

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ Route('two-factor.enable') }}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>You can enable / disable 2FA.</p>
                            </div>
                            @if (session('status') == 'two-factor-authentication-enabled')
                                <div class="mb-4 font-medium text-sm">
                                    Please finish configuring two factor authentication below.
                                </div>
                            @endif



                            <div class="button">
                                @if (!$user->two_factor_secret)
                                    <button class="btn" type="submit">Enable</button>
                                @else
                                <div class="text-center m-3">
                                    {!! $user->twoFactorQrCodeSvg() !!}
                                </div>

                                <ul class="text-center m-3">
                                    <h3>Recovery code</h3>
                                    @foreach ($user->recoverycodes() as $code)
                                        <li>{{$code}}</li>
                                    @endforeach
                                </ul>
                                    
                                    @method('delete')
                                    <button class="btn" type="submit">Diasble</button>
                                @endif

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->


</x-front-layout>
