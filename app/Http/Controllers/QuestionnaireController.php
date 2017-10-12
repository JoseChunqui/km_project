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
        $form = Form::findOrFail(1);
        return view('questionnaire', compact('form', 'token_expired'));
      }else{
        abort(401);
      }
    }
    public function store(Request $request)
    {
      $questionnaire = new Questionnaire();
      $questionnaire->token = $request->token;
      $questionnaire->form_id = '1';
      $questionnaire->data = $request->data;
      $questionnaire->save();

    }

    public function SendQuestionnaire(Request $request)
    {
        $email = $request->email;
        Mail::to($email)->send(new Cuestionario($this->generateToken($email)));

    }
    function generateToken($email)
    {
        $to_be_encrypted = $email.'|'.($this->app_passport);
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
}
