@extends('layouts.app')

@section('content')
    <div id="g-login" class="container-fluid py-16 d-flex flex-column align-center gag-container-bg">
        <div class="col-12 col-md-4">
            <v-card id="loginform" class="px-5">
                <v-card-title class="px-5 pt-8 pb-0">Login</v-card-title>
                <v-card-text class="py-5">
                    <v-form autocomplete="off" method="POST" action="{{ route('login') }}" ref="form" v-model="loginValid"
                        lazy-validation>
                        @csrf
                        <v-text-field outlined required autocomplete="off" id="email" type="email" name="email"
                            label="{{ __('Email') }}" v-model="loginEmail" :rules="loginEmailrules" autofocus
                            @error('email') value="{{ old('email') }}" error
                            error-messages="{{ old('email') }} do not match in our records" @enderror>
                        </v-text-field>
                        <v-text-field outlined required autocomplete="off" id="password" label="{{ __('Password') }}"
                            type="password" name="password" v-model="loginPassword" :rules="loginPasswordrules"
                            @error('password') error error-messages="{{ $message }}" @enderror>
                        </v-text-field>
                        <v-btn width="100%" height="55" large grey lighten-1
                            :class="`mb-3 ${loginValid == true ? 'primary' : 'grey lighten-2'}`" type="submit"
                            :disabled="!loginValid" @click="loginValidate">{{ __('LOGIN') }}</v-btn>
                        <div class="d-flex justify-space-between align-center my-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">{{ __('Reset Password') }}</a>
                            @endif
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </div>
    </div>
@endsection
