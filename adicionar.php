
<h1>Cadastro de usuarios</h1>

<hmtl>
    <head>
        <title>ola mundo</title>
        
                
		<link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="http://localhost/crud/assets/css/login.css" />
        <script type="text/javascript" src="http://localhost/crud/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://localhost/crud/assets/js/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
            
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="./" class="navbar-brand">Classificados Brasil</a>
                </div>

                
            </div>
              
 </nav>
<div class="container-fluid">


    <form method="POST" action="adicionar_action.php" enctype="multipart/form-data">

  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome">
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input type="text" class="form-control" id="email" name="email">
  </div>
   <div class="form-group">
    <label for="foto">foto</label>
    <input type="file" class="form-control" id="arquivo" name="fotos">
  </div>
  <input type="submit" value="cadastrar" class="btn btn-primary"/>
</form>
</div>
</body>
</html>