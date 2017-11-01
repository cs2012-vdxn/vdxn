<?php
    require_once 'autoload.php';
    date_default_timezone_set('America/Los_Angeles');
    $faker = Faker\Factory::create('en_SG');

    $TABLENAME = 'User';
    $PASSWORDFORALL = '123';

    $usernames = array('berneice95',
    'felicita.prohaska',
    'floyd.okon',
    'tdach',
    'jsimonis',
    'streich.dorothy',
    'carleton.buckridge',
    'okessler',
    'grady.zelda',
    'carlee.haag',
    'chaya.borer',
    'bryce.maggio',
    'marques.ziemann',
    'vince14',
    'mikel05',
    'pierre01',
    'zelda76',
    'philip82',
    'raphael.toy',
    'aniya.champlin',
    'cemard',
    'yabshire',
    'gmckenzie',
    'metz.marcella',
    'florine.jaskolski',
    'emayer',
    'lexus.marks',
    'kreiger.wava',
    'eldon.hoeger',
    'jrosenbaum',
    'kamille.mann',
    'kozey.jennifer',
    'marks.ilene',
    'mclaughlin.major',
    'maggie.hilpert',
    'mack22',
    'savanna06',
    'kiana52',
    'brenden.mcdermott',
    'victor03',
    'clinton62',
    'farrell.berniece',
    'treutel.hildegard',
    'ritchie.josefina',
    'zhodkiewicz',
    'gutmann.briana',
    'sedrick30',
    'blanca43',
    'tbailey',
    'fisher.kraig',
    'augustus.zieme',
    'zechariah.boyer',
    'margarete12',
    'kuhic.brando',
    'ylittel',
    'godfrey.mitchell',
    'olson.gaetano',
    'rath.maximus',
    'lucy.larkin',
    'chaya.witting',
    'jewell.gaylord',
    'wmarquardt',
    'jerome.robel',
    'proob',
    'joelle51',
    'shanel.wunsch',
    'deondre.durgan',
    'gyundt',
    'gutmann.missouri',
    'walter.carli',
    'francisco81',
    'rowe.herminio',
    'tgorczany',
    'marc19',
    'jennie18',
    'kling.elizabeth',
    'tgottlieb',
    'hschuppe',
    'weston.langosh',
    'myrtle35',
    'carlie.klocko',
    'ejohnston',
    'treutel.hosea',
    'schmitt.rachel',
    'dwalker',
    'coberbrunner',
    'lbins',
    'christiana25',
    'coby.powlowski',
    'ynitzsche',
    'llewellyn24',
    'nader.jacinthe',
    'femard',
    'arau',
    'luettgen.winfield',
    'murl24',
    'lledner',
    'junior.runte',
    'bruce82',
    'kilback.else');

/*
    // Generate users
for($q = 0; $q < 100; $q++) {
    $time = date_format($faker->dateTimeThisDecade($max="now"), "Y-m-d H:i:s");
    $password = password_hash($PASSWORDFORALL, PASSWORD_DEFAULT);

    $template = "INSERT INTO $TABLENAME (`username`, `first_name`, `last_name`, `password_hash`, `contact`, `email`, `created_at`, `updated_at`, `deleted_at`, `user_type`) VALUES ('".htmlentities($faker->username)."', '$faker->firstName', '$faker->lastName', '$password', '$faker->fixedLineNumber', '$faker->email', '$time', '', '', 'User');";

    echo $template."\n";
}*/

// Generate tasks
/*
for($i = 0; $i < 50; $i++) {
  $time = date_format($faker->dateTimeThisDecade($max="now"), "Y-m-d H:i:s");
  $biasedminbid = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
  $biasedmaxbid = $faker->biasedNumberBetween($min = 41, $max = 120, $function = 'sqrt');

  $creator_username = $usernames[rand(0, count($usernames))];
  $assignee_username = $creator_username;

  while($assignee_username == $creator_username) {
      $assignee_username = $usernames[rand(0, count($usernames))];
  }

  $title = $faker->jobTitle." ".($i + 1);
  $template = "INSERT INTO `Task` (`title`, `description`, `created_at`, `updated_at`, `start_at`, `end_at`, `min_bid`, `max_bid` , `creator_username`, `assignee_username`, `deleted_at`, `creator_rating`, `assignee_rating`, `completed_at`,`remarks`)VALUES ('$title', '$faker->paragraph', '$time', '$time', '2017-10-16 00:00:00', '2017-10-21 00:00:00', '$biasedminbid', '$biasedmaxbid', '$creator_username', '$assignee_username', NULL, NULL, NULL, NULL, NULL);";
  echo $template."\n";
}
*/

$task_titles = array('Sawing Machine Operator 1',
'Nuclear Monitoring Technician 2',
'Private Detective and Investigator 3',
'Teacher 4',
'Cost Estimator 5',
'Fabric Mender 6',
'Executive Secretary 7',
'Oil Service Unit Operator 8',
'Dancer 9',
'Clinical School Psychologist 10',
'Occupational Therapist 11',
'Environmental Engineer 12',
'Hand Presser 13',
'Child Care 14',
'Epidemiologist 15',
'Precision Printing Worker 16',
'Cook 17',
'Librarian 18',
'Insurance Investigator 19',
'Gluing Machine Operator 20',
'Insulation Worker 21',
'Transformer Repairer 22',
'Central Office and PBX Installers 23',
'Central Office 24',
'Special Forces Officer 25',
'Meter Mechanic 26',
'Personal Trainer 27',
'Elevator Installer and Repairer 28',
'Coil Winders 29',
'Production Planner 30',
'Pump Operators 31',
'Building Cleaning Worker 32',
'Law Teacher 33',
'Landscape Architect 34',
'Bus Driver 35',
'Computer Hardware Engineer 36',
'Vocational Education Teacher 37',
'Real Estate Broker 38',
'Optometrist 39',
'Typesetting Machine Operator 40',
'Film Laboratory Technician 41',
'Telemarketer 42',
'Anthropologist OR Archeologist 43',
'Precision Mold and Pattern Caster 44',
'Highway Patrol Pilot 45',
'Recyclable Material Collector 46',
'Music Composer 47',
'Plating Operator 48',
'HR Specialist 49',
'Carpenter Assembler and Repairer 50',
);

$task_bid_winners = array();

$task_creator_username = ('pierre01',
'mack22',
'victor03',
'luettgen.winfield',
'victor03',
'tdach',
'shanel.wunsch',
'emayer',
'philip82',
'francisco81',
'augustus.zieme',
'mikel05',
'nader.jacinthe',
'kamille.mann',
'kamille.mann',
'rowe.herminio',
'savanna06',
'pierre01',
'cemard',
'aniya.champlin',
'farrell.berniece',
'kiana52',
'kilback.else',
'kamille.mann',
'mikel05',
'tgorczany',
'bryce.maggio',
'kilback.else',
'chaya.witting',
'chaya.witting',
'christiana25',
'maggie.hilpert',
'mack22',
'kilback.else',
'chaya.witting',
'mikel05',
'clinton62',
'streich.dorothy',
'mikel05',
'godfrey.mitchell',
'mack22',
'arau',
'mikel05',
'augustus.zieme',
'cemard',
'proob',
'brenden.mcdermott',
'kozey.jennifer',
'blanca43',
'eldon.hoeger'
);

for($q = 0; $q < 50; $q++) {
  $numBids = rand(3, 5);

  $key = rand(0, count($task_titles));
  $title = $task_titles[$key];
  $creator_username = $task_creator_username[$key];

  $bidder_username = $task_bid_winners[$key];
  $details = $faker->paragraph;
  $amount = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
  $created_at = '2017-10-17 00:00:00';
  $updated_at = '2017-10-18 00:00:00';
  $template = "INSERT INTO `Bid` (`task_title`, `task_creator_username`, `bidder_username`, `details`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$title', '$creator_username', '$bidder_username', '$details', '$amount', '$created_at', '$updated_at', NULL);";
  echo $template."\n";

  $cache = array();
  array_push($cache, $task_bid_winners[$key]);

  for($w = 0; $w < $numBids; $w++) {

    $random_username = $usernames[rand(0, count($usernames))];
    while (in_array($random_username, $cache)) {
      $random_username = $usernames[rand(0, count($usernames))];

      array_push($cache, $random_username);
    }

    $bidder_username = $random_username;
    $details = $faker->paragraph;
    $amount = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
    $created_at = '2017-10-17 00:00:00';
    $updated_at = '2017-10-18 00:00:00';
    $template = "INSERT INTO `Bid` (`task_title`, `task_creator_username`, `bidder_username`, `details`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$title', '$creator_username', '$bidder_username', '$details', '$amount', '$created_at', '$updated_at', NULL);";
    echo $template."\n";
  }
  echo "\n";
}

?>
