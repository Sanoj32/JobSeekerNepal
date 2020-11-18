<?php

use App\Jobs;
use App\User;
$user = User::first();
$job  = Jobs::first();
$user->savedjobs()->toggle($user);
