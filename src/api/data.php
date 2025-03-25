<?php
    header ('Content-Tupe: application/json');
    $data = [
        ['nome'=>'Mario', 'cognome'=>'Rossi', 'email' => 'Mario@prova.it'],
        ['nome'=>'Paolo', 'cognome'=>'Neri', 'email' => 'Paolo@prova.it'],
        ['nome'=>'Carla', 'cognome'=>'Verdi', 'email' => 'Carla@prova.it']
    ];

    echo json_encode($data);
?>