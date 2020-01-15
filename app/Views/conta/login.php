
<div class="login-form">

    <form action="/ContaController/login" method="post">
        <h2 class="text-center">Log in</h2>       
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
            <a class="pull-right" data-toggle="modal" data-target="#myModal">Esqueceu a senha</a>
        </div>        
    </form>
    <p class="text-center"><a href="/home/signup">Create an Account</a></p>
    <div class="container">
</div>
    
<div class="container">

  <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">   
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Digite o email cadastrado :</h4>
                    </div>
                    <div class="login-form">
                        <form action="/ContaController/forgot" method="post">
                            <input type="email" class="form-control" placeholder="Digite seu Email cadastrado" required="required" name="email" id="email">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <div class="clearfix">
                                <a href="/" class="pull-right">Voltar</a>
                            </div>        
                        </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        
        </div>
    </div>
  
</div>