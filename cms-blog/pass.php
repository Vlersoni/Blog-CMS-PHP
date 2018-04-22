<?php
    echo password_hash('secret',PASSWORD_DEFAULT, array('cost' => 12));
    // password_hash(fjalkalimi,lloi i algoritmit inkriptuers, array(kosto))
    echo "<br>";
    echo password_hash('secret',PASSWORD_BCRYPT, array('cost' => 12));

    echo "<br>";
    echo crypt('secret','$2y$10$iusesomecrazystrings22');
    echo "<br>";
    echo "<br>";


?>