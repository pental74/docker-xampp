 <!-- php echo $_SERVER['PHP_SELF']; ?> -->
 <form name="form_chat"  method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="text" class="m-2" name="nome_utente" value="Marco" required><br>
    <input type="text"  class="m-2" name="stanza" value="73" required><br>
    <textarea class="m-2" name="testo_messaggio">Questo è un messaggio di prova</textarea><br>
    <input type="submit" id="btn_visualizza" value="Visualizza Messaggi" name="visualizza" onclick="nascondi_form(true)">
    <input type="submit" id="btn_inserisci" value="Invia messaggio" name="inserisci" onclick="nascondi_form(true)">
</form>