@extends('layouts.guest')

@section('content')
    <v-app id="inspire">
      <div class="container mt-5">
        <v-layout row wrap>
          <v-flex xs12 sm12 md6 lg4 offset-md3 offset-lg4>
            <form action="{{route('getAccess')}}" method="post">
              {{ csrf_field() }}
              <v-card color="blue-grey darken-2" class="white--text">
                <v-card-title primary-title>
                  <div class="headline">Accede al cuestionario</div>
                </v-card-title>
                <v-card-text>
                  <div class="mt-4">
                    <div>
                      Ingresa la clave del cuestionario
                    </div>
                    <v-text-field label="Clave" class="white--text" name="clave" dark>
                    </v-text-field>
                  </div>
                  <div class="mt-4">
                    <div>
                      Ingresa tu correo electrónico
                    </div>
                    <v-text-field label="E-mail" class="white--text" name="email" dark>
                    </v-text-field>
                  </div>
                </v-card-text>
                <v-card-actions>
                  <v-btn flat dark type="submit">Enviar</v-btn>
                </v-card-actions>
              </v-card>
            </form>
          </v-flex>
        </v-layout>
      </div>
    </v-app>
@endsection
