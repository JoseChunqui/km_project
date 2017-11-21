@extends('layouts.admin')

@section('content')
  <vue-forms :data-courses="{{$courses}}" action-new-form="{{route('forms.store')}}" csrf-token="{{ csrf_token() }}" action-manage-form="{{route('forms.manage')}}"></vue-forms>
@endsection
