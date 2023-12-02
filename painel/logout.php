<?php
require_once("../php/session_start.php");
session_destroy();
header("Location: ../login");