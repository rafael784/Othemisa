<!-- https://sweetalert.js.org/guides/  importante -->
<!-- https://www.w3schools.com/jsref/tryit.asp?filename=tryjsref_loc_href -->
<?php
// Start the session

?>

<div class="login-form">
    <form action = "/ContaController/login" method="post" id="loginFormID">
        <label>Email</label>
            <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required="required" name="email" id="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="required" name="password" id="password">
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                <a class="pull-right" data-toggle="modal" data-target="#ModalforgotId">Esqueceu a senha</a>
            </div>
        
        <div id="server-results"><!-- For server results --></div>
    </form>
    <p class="text-center" >
        <a data-toggle="modal" data-target="#modalSignupId"> Crie uma conta </a>
    </p>
</div>

<div class="modal fade"  role="dialog" id="ModalforgotId">
    <div class="modal-dialog" id="dialogforgotId">
            <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Digite o email cadastrado :</h4>
                </div>
                <div class="login-form">
                    <form action="/ContaController/forgot" method="post" id = "forgotFormID">
                        <input type="email" class="form-control" placeholder="Digite seu Email cadastrado" required="required" name="email" id="email">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" value="Submit" id="sumitbutton">Submit</button>
                        </div>
                        <div class="clearfix">
                            <a href="/" class="pull-right">Voltar</a>
                        </div>        
                    </form>
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div>    
    </div>
</div>

<div class="modal fade" id="modalSignupId" role="dialog">   
    <div class="login-form">
        <form action="/ContaController/signup" method="post" id="signupModalId">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="text-center">Criar Conta</h2>       
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nome" required="required" name="nome" id="nome">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Sobre Nome" required="required" name="sobreNome" id="sobreNome">
            </div>

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" required="required" name="email" id="email">
            </div>

            <div class="form-group">
                <input type="tel" class="form-control" placeholder="Fone" required="required" name="fone" id="fone">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Cidade" required="required" name="cidade" id="cidade">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Bairro" required="required" name="bairro" id="bairro">
            </div>

            <div class="form-group">
                <input type="number" class="form-control" placeholder="Cep" required="required" name="cep" id="cep">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Register </button>
            </div>
        </form>
    </div>
</div>

<script>

$("#loginFormID").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		//("#server-results").html(response);
       
        swal(response['status'], response['infomation'] , response['class']).then(function(value){
            if(response['class'] == 'success') 
                window.location.href="\Pessoa";//a class == success, então o usuário agora está logado, pois deverá redirecionar para o controller pessoa
        });
	});
});

$("#forgotFormID").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	//$( '#media_delete_confirmation' ).remove();
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		//$("#server-results").html(response);
        swal(response['status'], response['infomation'] , response['class']);
    });
});

$("#signupModalId").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		//$("#server-results").html(response);
        swal(response['status'], response['infomation'] , response['class']); 
        
    });
});
</script>
