<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation_code</title>

    <style>

        /* Utility */
        .a-i-center{
            align-items: center
        }
        
        .c-blue{
        color: rgb(22, 54, 131);
        }
        .d-flex{
            display: flex
        }
        .f-colum{
            flex-direction: column;
        }
        .j-c-center{
            justify-content: center
        }
        .t-none{
            text-decoration: none;
        }

    </style>
</head>
<body>

    <div class="d-flex f-colum j-c-center a-i-center">

        <div>
            <img src="{{asset('img/logonew.png')}}" alt="logo Besana" height="100">
        </div>

        <h2 class="c-blue">Hi {{$Name}}, thank you for register in <strong> Besana</strong> !</h2>
        <p>Please, confirm your email</p>
        <p>codigo: {{$confirmation_code}}</p>
     
    
        <a class="t-none" href="{{ url('/register/verify/' . $confirmation_code) }}">
            Click for confirm your email
        </a>
    </div>
    
</body>
</html>