@php
  //Exporta a excel todas las respuestas a un cuestionario
  //Se asume que la primera sección de preguntas es de IDENTIFICACIÓN
  $questionnaires = json_decode($questionnaires);
  $first_questionnaire = $questionnaires[0];
  $levels = 1;
  foreach ($first_questionnaire->data as $section) {
    if($section->active){
      foreach ($section->questions as $question) {
        if($question->type == "table"){
          $current_level = count($question->files[0]->columns);
          if($levels < $current_level){
            $levels = $current_level;
          }
        }elseif($question->type == "multiquestion"){
          foreach ($question->questions as $sub_question) {
            if($sub_question->type == "table"){
              $current_level = count($sub_question->files[0]->columns);
              if($levels < $current_level){
                $levels = $current_level;
              }
            }
          }
        }
      }
    }
  }
  $levels -= 1;
@endphp
<table>
  <thead>
    @for($i = 0; $i< 2 ; $i++):
      <tr>
        @foreach ($questionnaires[0]->data as $section)
          @foreach ($section->questions as $question)
            @if($section->active)
              @if(in_array($question->type,["text","select","number","textarea","date"]))
                @if($i == 0)
                  <th rowspan="2">
                    {{isset($question->statement) ? $question->statement : 'Error'}}
                  </th>
                @else
                  <th></th>
                @endif
              @elseif($question->type == "table")
                @if($i == 0)
                  <th colspan="{{count($question->files[0]->columns)}}">
                    {{isset($question->statement) ? $question->statement : 'Error'}}
                  </th>
                @else
                  @foreach ($question->files[0]->columns as $column)
                    <th>
                      @if($column->editable)
                        {{isset($column->answer) ? $column->answer : 'Error'}}
                      @else

                        {{isset($column->value) ? $column->value : 'Error'}}: {{isset($column->answer) ? $column->answer : 'Error'}}
                      @endif
                    </th>
                  @endforeach
                @endif
              @elseif($question->type == "multiquestion")
                @foreach ($question->questions as $sub_question)
                  @if($sub_question->type == "table")
                    @if($i == 0)
                      <th colspan="{{count($sub_question->files[0]->columns)}}">
                        {{isset($sub_question->statement) ? $sub_question->statement : 'Error'}}
                      </th>
                    @else
                      @foreach ($sub_question->files[0]->columns as $column)
                        <th>
                          @if($column->editable)
                            {{isset($column->answer) ? $column->answer : 'Error'}}
                          @else
                            {{isset($column->value) ? $column->value : 'Error'}}: {{isset($column->answer) ? $column->answer : 'Error'}}
                          @endif
                        </th>
                      @endforeach
                    @endif
                  @endif
                @endforeach
              @endif
            @endif
          @endforeach
        @endforeach
      </tr>
    @endfor
  </thead>
  <tbody>
    @foreach ($questionnaires as $questionnaire)
      @for($i = 1; $i<= $levels ; $i++):
        <tr>
          @foreach ($questionnaire->data as $section)
            @if($section->active)
              @foreach ($section->questions as $question)
                @if(in_array($question->type,["text","select","number","textarea","date"]))
                  @if($i==1)
                    <td rowspan="{{$levels}}">
                      {{isset($question->answer) ? $question->answer : 'Error'}}
                    </td>
                  @else
                    <td></td>
                  @endif
                @elseif($question->type == "table")
                  @if(isset($question->files[$i]))
                    @foreach ($question->files[$i]->columns as $column)
                      <td>
                        @if(isset($column->value) && !empty($column->value))
                          <strong>{{$column->value}}</strong> {{isset($column->answer) ? $column->answer : 'Error'}}
                        @else
                          {{isset($column->answer) ? $column->answer : 'Error'}}
                        @endif
                      </td>
                    @endforeach
                  @else
                    @foreach ($question->files[0]->columns as $column)
                      <td></td>
                    @endforeach
                  @endif
                @elseif($question->type == "multiquestion")
                  @foreach ($question->questions as $sub_question)
                    @if($sub_question->type == "table")
                      @if(isset($sub_question->files[$i]))
                        @foreach ($sub_question->files[$i]->columns as $column)
                          <td>
                            @if(isset($column->value) && !empty($column->value))
                              <strong>{{$column->value}}</strong> {{isset($column->answer) ? $column->answer : 'Error'}}
                            @else
                              {{isset($column->answer) ? $column->answer : 'Error'}}
                            @endif
                          </td>
                        @endforeach
                      @else
                        @foreach ($sub_question->files[0]->columns as $column)
                          <td></td>
                        @endforeach
                      @endif
                    @endif
                  @endforeach
                @endif
              @endforeach
            @endif
          @endforeach
        </tr>
      @endfor
    @endforeach
  </tbody>
</table>
