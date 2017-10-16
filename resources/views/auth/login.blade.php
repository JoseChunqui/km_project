@extends('layouts.login')

@section('content')
  <v-app id="inspire">
    <v-container grid-list-xl text-xs-center >
      <v-layout row wrap>
        <v-flex xs12 sm4 offset-sm4>
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
