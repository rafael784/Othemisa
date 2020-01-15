<script>
    function confirma(){
        if(!confirm("criar conta?")){
            return false;
        }
        return true;
    }
</script>

<div class="login-form">
    <form action="/ContaController/signup" method="post">
        <h2 class="text-center">Signup</h2>       
        
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
            <button onclick = "return confirma()" type="submit" class="btn btn-primary btn-block"> Register </button>
        </div>
    </form>
