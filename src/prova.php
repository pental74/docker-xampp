<?php
    function fun($x)
    {
        $a = "b"; $b = "c"; $c = "d";
        if (isset($$x))
        {
            fun ($$x);
            echo $x;

        }
    }
    fun ("a");
?>