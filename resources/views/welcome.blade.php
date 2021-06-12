<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <title>Trace & Origin: Auto Partage</title>
    </head>
    <style>
        .titre{ 
            color:#3e887d; 
            text-align: center;
        }
        p{
            font-family:Georgia, 'Times New Roman', Times, serif;
            text-align: center;
            font-size: 20px;
        }
        .titre::first-letter{
            font-size: 100px;
        }
        .btn{
            width: 150px;
        }
    </style>
    <body>
        @include('partials.nav')
        <div class="container" style="margin-top:150px;">
            <div class="row">
                <div class="col-md-4" style="margin-top:0px;" >
                        <h1 class="titre">Auto Partage</h1>
                        <p>
                            Mettez à la disposition de vos membres une ou plusieurs véhicules.
                            Chaque membre ne finance la véhicule que pour la durée de son besoin.
                        </p><br>
                        <a class="btn btn-success float-left" href="{{url('vehicules/create')}}">Formulaire d'installation</a>
                        <a class="btn btn-success float-end" href="{{url('interventions/create')}}">Formulaire d'intervention</a>
                </div>
                <div class="col-md-8">
                    <img src="{{asset('icons/car_sharing.PNG')}}" class="float-end">
                </div>
            </div>
        </div>
    </body>
</html>
