@extends('layouts.app')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">Nombre Total de Voitures</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left"><?php echo App\Ticket::count();?></span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">Voitures stationnées</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left"><?php echo App\Ticket::where("price", "=", NULL)->count();?></span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5">Places Libres</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">15</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-life-ring"></i>
                            </div>
                            <div class="mr-5">Gain Total</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left"><?php echo App\Ticket::where("price", "!=", NULL)->sum("price");?> €</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Tableau des voitures</div>
                <div class="card-body">
                    <div class="table-responsive">

                            <div class="row"><div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">Matricule</th>
                                            <th rowspan="1" colspan="1">Date et Heure d'entrée</th>
                                            <th rowspan="1" colspan="1">Date et Heure de Sortie</th>
                                            <th rowspan="1" colspan="1">Tarif</th>
                                            <th rowspan="1" colspan="1">Ticket</th>

                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Matricule</th>
                                            <th rowspan="1" colspan="1">Date et Heure d'entrée</th>
                                            <th rowspan="1" colspan="1">Date et Heure de Sortie</th>
                                            <th rowspan="1" colspan="1">Tarif</th>
                                            <th rowspan="1" colspan="1">Ticket</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>

                                            @foreach($tickets as $ticket)
                                           <tr role="row" class="odd" id="">
                                            <td class="sorting_1">{{$ticket->matricule}}</td>
                                            <td>{{$ticket->created_at}}</td>
                                            <td id="date{{$ticket->id}}">{{$ticket->finished_at}}</td>
                                            <td>
                                             @if (empty($ticket->price))
                                                    <button class="btn btn-primary" id="{{$ticket->id}}" onclick="tarif(this)">tarif</button>
                                                @else
                                                 {{$ticket->price}}
                                             @endif

                                            </td>
                                            <td>

                                                @if (!empty($ticket->price))
                                                    <a class="btn btn-primary" href="/imprimer/{{$ticket->id}}" target="_blank">Imprimer</a>
                                                @endif

                                            </td>
                                        </tr>
                                              @endforeach
                                          </tbody>
                                    </table>
                                    <ul>
                                        {{ $tickets->fragment('foo')->links() }}

                                    </ul>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Parking 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <script>
        function tarif(button) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var rep=this.responseText.split("/");
                    button.parentElement.innerHTML=rep[0];
                    document.getElementById("date"+button.id).innerHTML=rep[1];

                }
            };
            xhttp.open("GET", "/price/"+button.id, true);
            xhttp.send();
        }
    </script>




@endsection