<?php
$first_name = $orders['deliveryOrder']->user->first_name;
$last_name = $orders['deliveryOrder']->user->last_name;
$full_name =  $first_name . ' ' . $last_name;
?>
<p style="padding: 20px;">
    Hallo {{ $full_name }}<br>
    Vielen Dank für deinen Einkauf. Im Anhang erhältst du den Rechnungsbeleg.<br>
</p>
<p style="padding: 20px;">
    Freundliche Grüsse
</p>
<p style="padding: 20px;">
    Dein Centrocaffè-Team<br><br>
    Centrocaffè Fruci - Althardstasse 160 - CH-8105 Regensdorf<br>
    <a href="mailto:shop@centrocaffe.ch ">shop@centrocaffe.ch</a> - <a href="http://centrocaffe.ch/" target="_blank">www.centrocaffe.ch</a><br>
    {{-- MwSt-Nr. CHE-115.174.365<br><br> --}}
    www.centrocaffe.ch<br>
</p>





