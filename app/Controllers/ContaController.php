<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ContaModel;

define("PESSOA_MOCK", "Maria José da Silva");

class ContaController extends BaseController
{
	private function templateLogin()
	{
        echo view('templates/header');
        echo view('conta/login');
        echo view('templates/footer');
	}

    public function login()
    {
        try{
            $obj['conta'] = $this->validationContaforLogin($this->request->getVar('email'), true);
            
            if(!($obj['conta']['password'] === $this->request->getVar('password')))
            {
                throw new \Exception("senha Inválida");    
            }
        }
        catch(\Exception $e)
        {   
            $data = [
                'infomation' => $e->getMessage(),
                'status' => 'Não foi possível logar!',
                'class' => 'error' 
            ];

            echo view('informations/errorLogin', $data);
            $this->templateLogin();
        }
    }
	public function signup(){
        
        $PERMITED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $nome = $this->request->getVar('nome');
        $sobreNome = $this->request->getVar('sobreNome');
		$email = $this->request->getVar('email');
		$fone = $this->request->getVar('fone');
		$cidade = $this->request->getVar('cidade');
		$bairro = $this->request->getVar('bairro');
		$cep = $this->request->getVar('cep');
        $password = $this->gerenateRandomStrings($PERMITED_CHARS, 6);
        
        $conta = new ContaModel();
        
        try
        {
            $this->validationContaforLogin($email);
            $conta->save([
                'nome' => $nome, 'sobreNome' => $sobreNome, 
                'email' => $email, 'fone' => $fone, 
                'cidade' => $cidade, 'bairro' => $bairro, 
                'cep' =>  $cep, 'password' => $password                   
            ]);
            
            $this->sendEmailValidation($nome, $email, $password);
            $data = [
                'infomation' => 'Enviamos uma mesagem para o email : '.$email.' contendo suas credênciais de acesso (UserName + Password)' ,
                'status' => 'Conta criada com sucesso!',
                'class' => 'sucess' 
            ];
            echo view('informations/sucessLogin', $data);
            $this->templateLogin();
        }
        catch(\Exception $e)    
        {
            $data = [
                'infomation' => $e->getMessage(),
                'status' => 'A conta não foi criada, tente novamente mais tarde!',
                'class' => 'error' 
            ];
            echo view('informations/errorLogin', $data);
           $this->templateLogin();
            
        }
    }
    
    public function forgot(){        
        
        try{
            
            $obj['conta'] = $this->validationContaforLogin($this->request->getVar('email'),true);
            $this->sendEmailValidation($obj['conta']['name'], $obj['conta']['email'], $obj['conta']['password']);
            
            $data = [
                'infomation' => 'Enviamos um mesagem para '.$obj['conta']['email'].' contendo sua senha',
                'status' => 'Email enviado com sucesso!',
                'class' => 'sucess' 
            ];
            
            echo view('informations/sucessLogin', $data);
            $this->templateLogin();
        }
        catch(\Exception $e)
        {   
            $data = [
                'infomation' => $e->getMessage(),
                'status' => 'Sua senha Não foi enviada! Tente novamente mais tarde',
                'class' => 'error' 
            ];

            echo view('informations/errorLogin', $data);
            $this->templateLogin();
        }

    }

    private function gerenateRandomStrings($input, $strength = 8){
        $input_length = strlen($input);
        $random_string = '';

        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
 
        return $random_string;
    }

	private function sendEmailValidation($name, $email, $password){
		
        $body = "Muito obrigado por se juntar a nós, Sr(a) ".$name."<br><br> Já pode logar com as seguintes credenciais: <br><br> UserName: ".$email."<br><br> Password : ".$password;  
        $subject = "Othemisa - Credenciais";

        $headers = array(
            'Authorization: Bearer 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',
            'Content-Type: application/json'
        );

        $data = array(
            "personalizations" => array(
                array(
                    "to" => array(
                        array(
                            "email" => $email,
                            "name" => $name
                        )
                    )
                )
            ),
            "from" => array(
                "email" => "no-reply@Othemisa.com"
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )               
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    // se for usado para a opção "esqueceu sua senha"(forgot) esperamos que a busca retorne pelo menos um email, cetamos HasReturn = true
    // se for usado para "criação de conta"(signup) esperamos que a busca NÃO retorne nenhum email, cetamos HasReturn = False 
    private function validationContaforLogin($email, $HasReturn = false){
        
        $conta = new ContaModel();
        $retorno = $conta->getContaByEmail($email);

        if(empty($retorno) === $HasReturn)
        {
            if($HasReturn)
            {
                throw new \Exception("Não encontramos email");

            }
            else
            {
                throw new \Exception("Email Já cadastrado");
            }
        }
        return $retorno;
    }
}
