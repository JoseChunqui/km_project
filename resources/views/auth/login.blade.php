@extends('layouts.login')

@section('content')

  <v-container grid-list-xl text-xs-center >
    <v-layout row wrap>
      <v-flex xs12 sm4 offset-sm4>
        <div>
          <form class="" action="index.html" method="post">
            <input type="email" class="bigText login" name="hiddenFieldToStopBrowserAutofill" style = "height : 0px; width : 0px; border : 0px"/>
            <input type="password" class="bigText login" name="hiddenFieldToStopBrowserAutofill" style = "height : 0px; width : 0px; border : 0px"/>
          </form>
        </div>
        <login-form
          action-form="{{ route('login') }}"
          method-form="POST"
          csrf-token="{{ csrf_token() }}"
          errors-form="{{ count($errors)>0 ? 'Email no encontrado o contraseña incorrecta': '' }}"
          old-email="{{ old('email') }}"
          link-reset-password="{{ route('password.request') }}"
        >
        </login-form>
      </v-flex>
    </v-layout>
  </v-container>
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <v-text-field
                        label="Name"
                        v-model="name"
                        :rules="nameRules"
                        :counter="10"
                        required
                        ></v-text-field>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
@push('js')
  {{-- <script src="{{asset('js/pages/admin.js')}}" charset="utf-8"></script> --}}
  <script src="{{asset('js/pages/login.js')}}" charset="utf-8"></script>
@endpush
