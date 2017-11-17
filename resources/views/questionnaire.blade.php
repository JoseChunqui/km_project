@extends('layouts.guest')

@section('content')
  @if($token_expired)
    <v-card>
      <v-card-media src="{{asset('/images/knowledge.png')}}" height="300px">
      </v-card-media>
      <v-card-title primary-title>
        <div>
          <h3 class="headline mb-0">El formulario ya fue llenado</h3>
        </div>
      </v-card-title>
    </v-card>
  @else
    <vue-questionnaire :data-range='{{json_encode($form->data)}}' save-link="{{ route('save_q')}}" csrf-token="{{ csrf_token() }}" function-form="create">
    </vue-questionnaire>
  @endif
@endsection
