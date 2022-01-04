<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Hai ricevuto una nuova segnalazione.</h1>
    <h3>Questi sono i dati dell'utente</h3>
    
   <h4>Nome: {{$contact['user']}}</h4> 
   <h4>Email: {{$contact['email']}}</h4> 
   <h4>Messaggio: {{$contact['message']}}</h4> 
    
</body>
</html>