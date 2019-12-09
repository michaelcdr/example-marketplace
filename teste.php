<?php

    $text = "Cats chase mice";
    $filename = "somefile.txt";
    $fh = fopen("logs.txt", "a");
    fwrite($fh, "registro\n");
    fclose($fh);