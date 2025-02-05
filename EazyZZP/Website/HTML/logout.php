<?php

// sessie vernietigen en doorverwijzen naar login pagina 
session_start();
session_destroy();
header("Location: ../HTML/login.php");
