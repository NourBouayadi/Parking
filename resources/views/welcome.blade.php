@extends('layouts.app')
@section('content')
<div class="col-md-10">
    <br><br>
    <form action="/test" method="get">
        <div class="form-group">
            <label for="exampleInputEmail1">Matricule</label>
            <input name="matricule" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enterez le matricule">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Type de Voiture</label>
            <select name="isPetite" class="custom-select">
                <option value="1" selected>Petite</option>
                <option value="0" >Grande</option>

            </select>&nbsp;
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

 @endsection