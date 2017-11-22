<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Questionnaire;
use App\Form;

/**To send emails**/
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\Cuestionario;

class QuestionnaireController extends Controller
{
    protected $app_passport = 'Administración del Conocimiento';

    public function index(Request $request)
    {
      return view('index');
    }

    public function create($token, Request $request)
    {
      if($this->validateToken($token)){
        $token_expired = false;
        if(Questionnaire::where('token','=',$token)->exists()){
          $token_expired = true;
        };
        $form_id = $this->getFormFromToken($token);
        $form = Form::findOrFail($form_id);
        return view('questionnaire', compact('form', 'token_expired'));
      }else{
        abort(401);
      }
    }
    public function store(Request $request)
    {
      $questionnaire = new Questionnaire();
      $questionnaire->token = $request->token;
      $questionnaire->form_id = $this->getFormFromToken($request->token);
      $questionnaire->data = json_decode($request->data);
      $questionnaire->save();
    }

    public function SendQuestionnaire(Request $request)
    {
        $email = $request->email;
        $key = $request->clave;
        //Búsqueda en DB del formulario
        $form = Form::where('key', $key)->first();
        if($form){
          Mail::to($email)->send(new Cuestionario($this->generateToken($email, $form->id)));
          echo "Formulario enviado a su correo electrónico. Revise su bandeja de entrada";
        }else{
          echo "La clave de formulario ingresada es incorrecta";
        }
    }
    function generateToken($email, $form_id)
    {
        $to_be_encrypted = $email.'|'.($this->app_passport).'|'.($form_id);
        return encrypt($to_be_encrypted);
    }

    function validateToken($token)
    {
        $to_be_encrypted = true;
        try {
          $decrypted = decrypt($token);
          $array_decrypted = explode("|", $decrypted);
          if(count($array_decrypted) < 2){
            $to_be_encrypted = false;
          }elseif($array_decrypted[1] != $this->app_passport){
            $to_be_encrypted = false;
          }
        } catch (DecryptException $e) {
          $to_be_encrypted = false;
        }

        return $to_be_encrypted;
    }

    //After valdate
    function getFormFromToken($token){
      $decrypted = decrypt($token);
      $array_decrypted = explode("|", $decrypted);
      return $array_decrypted[2];
    }
}
