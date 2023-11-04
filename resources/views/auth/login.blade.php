@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft bg-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Selamat Datang Kembali !</h5>
                                            <p>Login untuk melanjutkan ke SBI Dashboard.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('assets/admin/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <!----><!---->
                                <form class="p-2 mt-3" method="POST" action="{{ route('login.authenticate') }}">
                                    @csrf
                                    <div class="mb-3" id="input-group-1" role="group">
                                        <label id="__BVID__622414___BV__BV_label___" for="input-1"
                                            class="form-label d-block">Email</label>
                                        <div class="">
                                            <input id="input-1" class="form-control" type="text"
                                                placeholder="Enter email" name="email" />
                                        </div>

                                        @error('email')
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="mb-3" id="input-group-2" role="group">
                                        <label id="__BVID__870424___BV__BV_label___" for="input-2"
                                            class="form-label d-block">Password</label>
                                        <div class="">
                                            <input id="input-2" class="form-control" type="password"
                                                placeholder="Enter password" name="password" />
                                        </div>
                                        @error('password')
                                            <small class="text-danger" role="alert">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary btn-md btn-block" type="submit">
                                            <!---->
                                            <div class="btn-content">Log In</div>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>
                                © 2023 SBI Admin | Crafted with
                                <i class="mdi mdi-heart text-danger"></i> by Team
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
