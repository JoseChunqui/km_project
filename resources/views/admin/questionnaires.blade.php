@extends('layouts.admin')

@section('content')
  <v-layout row wrap>
    <v-flex xs12 sm12 md8 lg8 offset-md2 offset-lg2>
      <div class="table__overflow elevation-10">
        <table class="datatable table">
          <thead>
            <tr>
              <th>
                Apellidos
              </th>
              <th>
                Nombres
              </th>
              <th>
                Código
              </th>
              <th>
                Especialidad
              </th>
              <th>
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($questionnaires as $questionnaire)
              @php
                $data_decoded = json_decode($questionnaire->data)[0];
              @endphp
              <tr>
                <td>
                  {{$data_decoded->questions[0]->answer}}
                </td>
                <td>
                  {{$data_decoded->questions[1]->answer}}
                </td>
                <td>
                  {{$data_decoded->questions[2]->answer}}
                </td>
                <td>
                  {{$data_decoded->questions[3]->answer}}
                </td>
                <td>
                  <v-btn href="{{route('view_questionnaire', $questionnaire->id)}}">Ver</v-btn>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </v-flex>
  </v-layout>
@endsection
