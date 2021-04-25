 
<html>
<!-- Date de création: 08/09/2007 -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
</head>
<body>
 
<!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
<form enctype="multipart/form-data" action="upload.php" method="post">
  <!-- MAX_FILE_SIZE doit précéder le champs input de type file -->
  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->  
  Envoyez ce fichier : <input name="userfile" type="file" />
  <input type="submit" value="Envoyer le fichier" />
</form>
</body>
</html>

   
   