<?php

function link_to_css(string $linkcss): void{
    echo " <link rel='stylesheet' href='" . $linkcss . "'>";
    }
function title_html(string $title): void{
    echo "<title>" . $title . "</title>";
    
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>