@extends('layouts.login')

@section('content')
  <v-app id="inspire">
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
  </v-app>
@endsection
@push('js')
  {{-- <script src="{{asset('js/pages/admin.js')}}" charset="utf-8"></script> --}}
  <script src="{{asset('js/pages/login.js')}}" charset="utf-8"></script>
@endpush
