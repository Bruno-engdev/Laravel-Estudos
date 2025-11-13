
<?php

    foreach($cat as $linha)
    {
        echo "<p>" .
             $linha->cat_nome .
             " - " .
             $linha->id .
             "</p>";
    }

?>
