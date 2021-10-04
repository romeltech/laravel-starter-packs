@extends('layouts.app')

@section('content')
<div class="container-fluid py-16 d-flex flex-column align-center gag-container-bg">
    <div class="col-12 col-sm-6 col-md-4">
        <v-card id="loginform" class="px-5">
            <v-card-title class="px-5 pt-8 pb-0">{{ __('Reset Password') }}</v-card-title>
            <v-card-text class="py-5">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <v-text-field
                        outlined
                        required
                        autocomplete="email"
                        id="email"
                        type="email"
                        name="email"
                        label="{{ __('E-Mail Address') }}"
                        v-model="loginEmail"
                        :rules="loginEmailrules"
                        autofocus
                        @error('email')
                            value="{{ old('email') }}"
                            autofocus
                            error
                            error-messages="{{ old('email') }} do not match in our records"
                        @enderror
                    >
                    </v-text-field>
                    <v-btn
                        :class="`mb-3 ${loginValid == true ? 'primary' : 'grey lighten-2'}`"
                        type="submit"
                        :disabled="!loginValid"
                    >
                        {{ __('Send Password Reset Link') }}
                    </v-btn>
                </form>
                @if (session('status'))
                <v-alert
                    class="mt-3"
                    dense
                    text
                    type="success"
                >
                    {{ session('status') }}
                </v-alert>
                @endif
            </v-card-text>
        </v-card>
    </div>
</div>
@endsection
