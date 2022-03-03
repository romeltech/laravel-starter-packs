@extends('layouts.app')

@section('content')

    <div class="container-fluid py-16 d-flex flex-column align-center gag-container-bg">
        <div class="col-12 col-sm-6 col-md-4">
            <v-card id="loginform" class="px-5">
                <v-card-title class="px-5 pt-8 pb-0">{{ __('Reset Password') }}</v-card-title>
                <v-card-text class="py-5">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        {{-- v-model="loginEmail" --}}
                        {{-- :rules="loginEmailrules"  --}}
                        <v-text-field outlined required autocomplete="false" id="email" type="email" name="email"
                            label="{{ __('E-Mail Address') }}"
                            autofocus
                            value="{{ $email ?? old('email') }}" @error('email') autofocus error
                            error-messages="{{ $message }}" @enderror>
                        </v-text-field>
                        {{-- v-model="loginPassword"  --}}
                        {{-- :rules="loginPasswordrules" --}}
                        <v-text-field
                            outlined
                            required
                            autocomplete="off"
                            id="password"
                            label="{{ __('Password') }}"
                            type="password"
                            name="password"
                            @error('password') error error-messages="{{ $message }}" @enderror>
                        </v-text-field>
                        <v-text-field
                            outlined
                            required
                            autocomplete="confirm-password"
                            id="password-confirm"
                            label="{{ __('Confirm Password') }}"
                            type="password"
                            name="password_confirmation"
                            >
                        </v-text-field>
                        <v-btn
                            class="mb-3 primary"
                            type="submit"
                            >
                            {{ __('Reset Password') }}
                        </v-btn>
                    </form>
                    @if (session('status'))
                        <v-alert class="mt-3" dense text type="success">
                            {{ session('status') }}
                        </v-alert>
                    @endif
                </v-card-text>
            </v-card>
        </div>
    </div>
@endsection
