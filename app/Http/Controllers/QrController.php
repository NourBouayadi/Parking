<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QrController extends Controller
{
    public function store(Request $request)
    {
        $tickets = new Ticket();
        $tickets->matricule = $request->input('matricule');
        $tickets->created_at  = Carbon::now('Europe/Paris');
        $tickets->isPetite = $request->input('isPetite');
        $tickets->save();
        return redirect('dashboard');
    }
    public function index()
    {

        $tickets = Ticket::all();

        return view('dashboard', compact(['tickets']));

    }

     public function qr (Request $request){
            $ticket = new Ticket();
            $ticket->matricule = $request->input('data');
            $ticket->save();

      /*   $qr= "Matricule: ".$ticket->matricule." À: ".$ticket->created_at;

        \QrCode::format('png')
            ->size(250)
            ->generate($qr, public_path('/assets/img/qrcode.png'));
        echo '<img src="/assets/img/qrcode.png" ></img>';*/
    }
    public function calculer($id)
    {

        $prices = array
        (   array(15,0,0),
            array(30,0.80,1.10),
            array(45,1.6,2),
            array(60,2.4,2.9),
            array(75,2.8,3.4),
            array(90,3.2,3.9),
            array(105,3.5, 4.2),
            //2h
            array(120, 3.8, 4.5),
            array(135, 4.10, 4.8),
            array(150, 4.4, 5.1),
            array(165, 4.7, 5.4),
            //3h
            array(180, 5, 5.7),
            array(195, 5.3,6),
            array(210, 5.6, 6.3),
            array(225, 5.9, 6.6),
            //4h
            array(240,6.2,6.9),
            array(255,6.5,7.2),
            array(270,6.8,7.5),
            array(285,7.1,7.8),
            //5h
            array(300,7.4,8.1),
            array(315,7.7,8.4),
            array(330,8,8.7),
            array(345,8.3,9),
            //6h
            array(360,8.6,9.3),
            array(375,8.9,9.6),
            array(390,9.2,9.9),
            array(405,9.5,10.2),
            //7h
            array(420,9.8,10.5),
            array(435,10.1,10.8),
            array(450,10.4,11.1),
            array(465,10.7,11.4),
            //8h
            array(480,11,11.7),
            array(495,11.3,12),
            array(510,11.6,12.3),
            array(525,11.9,12.6),
            //9h
            array(540,12.2,12.90),
            array(555,12.5,13.2),
            array(570,12.8,13.5),
            array(585,13.1,13.8),
            //10h
            array(600,13.4,14.1),
        );
        $ticket = Ticket::find($id);

        $qr= "Matricule: ".$ticket->matricule." À: ".$ticket->created_at;

        \QrCode::format('png')
            ->size(250)
            ->generate($qr, public_path('/assets/img/qrcode.png'));
        echo '<img src="/assets/img/qrcode.png" ></img>';


        $price=0;
        if(empty($ticket->finished_at))
            $ticket->finished_at = Carbon::now('Europe/Paris');
        $ticket->difference =  $ticket->created_at->diffInRealMinutes($ticket->finished_at);
        //$ticket->save();
        //$ticket->price = $prices[$ticket->difference]*
        $day=true;
        for ($i=0; $i<sizeof($prices);$i++)
        {
            if($ticket->difference < $prices[$i][0])
            {
                $day=false;
                if($ticket->isPetite)
                    $ticket->price=$prices[$i][1];
                else
                    $ticket->price=$prices[$i][2];
                break;
            }
        }
        if($day){
            if($ticket->isPetite)
            {
                $ticket->price = 13.4;
            }
            else
            {
                $ticket->price = $ticket->difference*0.3/15;
            }
        }

        $ticket->save();
        \Debugbar::disable();
    echo $ticket->price.'/'.$ticket->finished_at;
    }
}
