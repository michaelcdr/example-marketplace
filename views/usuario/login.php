<!doctype html>
<html lang="en">
    <head>
        <title>Loja Whatever - Sua loja de instrumentos músicais e acessórios</title>

        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" 
            rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
        <link rel="stylesheet" 
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" 
            href="css/login.css">
    </head>
    <body>  
        <!-- cabeçalho e navegação -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.html">
                        <span class="logo-strong">L</span>oja<span class="logo-strong">W</span>hatever</a>
                </div>
            </nav>
            <div class="spacer-header"></div>
        </header>
        <main>
           <div class="container-login">
                <div class="col-md-12">
                    <form class="form-signin mt-5" id="form-login" 
                        method="post" action="/logar">
                        <div class="card p-3">
                            <h1 class="h4 mb-3 font-weight-normal text-center ">
                                Olá! Para continuar, digite o seu login e senha
                            </h1>
                            <label for="login" class="sr-only">Login</label>
                            <input type="login" id="login" class="form-control" 
                                placeholder="E-mail" required="" 
                                autofocus="">
                            
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" id="password" class="form-control" 
                                placeholder="Senha" required="">
                        
                            <button class="btn btn-lg btn-block mt-3 btn-outline-dark"
                                 type="submit">Entrar
                            </button>
                        </div>
                    </form>
                </div>
           </div>
        </main>
        <footer class="mt-3 text-light"></footer>



        <!-- Optional JavaScript -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous"></script>

        <script>
            $(function(){
                $('form#form-login').submit(function(){

                    if (loginTaValido())
                        document.location = "/logar";

                    return false;
                });
            });

            function loginTaValido(){
                let email = $("#email").val();
                let password = $("#password").val();

                if (password != "" && password !=""){
                    return true;
                }
                return false
            }
        </script>
    </body>
</html>