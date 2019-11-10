@extends('layouts.app')
@section('content')
    <?php
    /*
     * PHP QR Code encoder
     *
     * Exemplatory usage
     *
     * PHP QR Code is distributed under LGPL 3
     * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
     *
     * This library is free software; you can redistribute it and/or
     * modify it under the terms of the GNU Lesser General Public
     * License as published by the Free Software Foundation; either
     * version 3 of the License, or any later version.
     *
     * This library is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
     * Lesser General Public License for more details.
     *
     * You should have received a copy of the GNU Lesser General Public
     * License along with this library; if not, write to the Free Software
     * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
     */

    echo "<h1>Générer un ticket</h1><hr/>";

    //config form
    echo ' <br><form action="/test" method="GET">
        Type de
        Matricule:&nbsp;<input name="data" value="Matricule" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L" selected>L - smallest</option>
            <option value="M" >M</option>
            <option value="Q">Q</option>
            <option value="H">H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';

    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'">'.$i.'</option>';

    echo '</select>&nbsp;
        <input type="submit" value="GENERATE"></form><hr/>';

    ?>
@endsection