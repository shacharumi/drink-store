<?php

require("User.php");
if (User::check()) {
    User::logout();
}
header("Location: ../");