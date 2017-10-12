@extends('layouts.login')

@section('content')
  <email-form
    action-form="{{ route('password.email') }}"
    method-form="POST"
    csrf-token="{{ csrf_token() }}"
    errors-form="{{ $errors->has('email') ? $errors->first('email'): '' }}"
    status-form="{{ session('status') ? session('status') : '' }}"
    old-email="{{ old('email') }}"
  >
  </email-form>
@endsection
