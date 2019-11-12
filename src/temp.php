<?php
    // get the existing research keywords array
    $r_keys = $document['research_keywords'];
    for($i=0; $i<count($r_keys); $i++){
        echo "<form class='form-inline' action='/remove_research_keyword.php' method='post'>";
        echo "<input type='hidden' id='remove_research_keyword' name='remove_research_keyword' value="."\"".$r_keys[$i]."\"".">";
        echo "<button  style='margin-right:2em;' class='btn btn-sm btn-secondary'><small>".$r_keys[$i]."</small></button>";
        echo "<button type='submit' class='btn btn-sm btn-danger'>Delete</button></form>";
    }
?>