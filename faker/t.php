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
for($i = 100; $i < 150; $i++) {
  $time = date_format($faker->dateTimeThisDecade($max="now"), "Y-m-d H:i:s");
  $biasedminbid = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
  $biasedmaxbid = $faker->biasedNumberBetween($min = 41, $max = 120, $function = 'sqrt');

  $creator_username = $usernames[rand(0, count($usernames) - 1)];
  $assignee_username = $creator_username;

  while($assignee_username == $creator_username) {
      $assignee_username = $usernames[rand(0, count($usernames) - 1)];
  }

  $creator_rating = rand(3, 5);
  $assignee_rating = rand(3, 5);
  $completed_at = '2017-10-17 00:00:00';
  $remarks = 'Good job!';

  $title = $faker->jobTitle." ".($i + 1);
  $template = "INSERT INTO `Task` (`title`, `description`, `created_at`, `updated_at`, `start_at`, `end_at`, `min_bid`, `max_bid` , `creator_username`, `assignee_username`, `deleted_at`, `creator_rating`, `assignee_rating`, `completed_at`,`remarks`)VALUES ('$title', '$faker->paragraph', '$time', '$time', '2017-10-16 00:00:00', '2017-10-21 00:00:00', '$biasedminbid', '$biasedmaxbid', '$creator_username', NULL, NULL, '$creator_rating', '$assignee_rating', '$completed_at', '$remarks');";
  echo $template."\n";
}
*/
/*
$task_titles = array('Library Assistant 101',
'Aircraft Launch Specialist 102',
'User Experience Researcher 103',
'Airframe Mechanic 104',
'Conveyor Operator 105',
'Real Estate Appraiser 106',
'Structural Metal Fabricator 107',
'Gas Processing Plant Operator 108',
'Chemical Equipment Tender 109',
'Command Control Center Specialist 110',
'Human Resource Director 111',
'Economist 112',
'Production Laborer 113',
'Furniture Finisher 114',
'Fashion Model 115',
'Forming Machine Operator 116',
'Human Resource Manager 117',
'Commercial and Industrial Designer 118',
'Brattice Builder 119',
'Stationary Engineer 120',
'Safety Engineer 121',
'Audio and Video Equipment Technician 122',
'Railroad Conductors 123',
'Telecommunications Equipment Installer 124',
'Model Maker 125',
'Agricultural Manager 126',
'Textile Machine Operator 127',
'Law Clerk 128',
'Precision Pattern and Die Caster 129',
'Architectural Drafter OR Civil Drafter 130',
'Carpet Installer 131',
'Assembler 132',
'Mechanical Equipment Sales Representative 133',
'Fashion Model 134',
'Dot Etcher 135',
'Hand Sewer 136',
'Recruiter 137',
'Milling Machine Operator 138',
'Computer Support Specialist 139',
'Director Of Talent Acquisition 140',
'Cooling and Freezing Equipment Operator 141',
'General Farmworker 142',
'Avionics Technician 143',
'Supervisor Correctional Officer 144',
'Weapons Specialists 145',
'Barber 146',
'Travel Guide 147',
'Taxi Drivers and Chauffeur 148',
'Dental Hygienist 149',
'Probation Officers and Correctional Treatment Specialist 150'
);

//$task_bid_winners = array();

$task_creator_username = array('shanel.wunsch',
'lexus.marks',
'carlie.klocko',
'jennie18',
'cemard',
'lexus.marks',
'ritchie.josefina',
'treutel.hosea',
'walter.carli',
'farrell.berniece',
'mclaughlin.major',
'kamille.mann',
'jsimonis',
'yabshire',
'schmitt.rachel',
'gutmann.briana',
'tgorczany',
'florine.jaskolski',
'florine.jaskolski',
'chaya.borer',
'gmckenzie',
'marques.ziemann',
'bryce.maggio',
'metz.marcella',
'victor03',
'francisco81',
'augustus.zieme',
'emayer',
'vince14',
'kamille.mann',
'clinton62',
'joelle51',
'zechariah.boyer',
'marques.ziemann',
'carlie.klocko',
'florine.jaskolski',
'metz.marcella',
'zechariah.boyer',
'kling.elizabeth',
'shanel.wunsch',
'treutel.hosea',
'jsimonis',
'emayer',
'treutel.hosea',
'murl24',
'ritchie.josefina',
'margarete12',
'grady.zelda',
'zelda76',
'kozey.jennifer'
);

for($q = 0; $q < 50; $q++) {
  $numBids = rand(3, 5);

  $title = $task_titles[$q];
  $creator_username = $task_creator_username[$q];

  $usernameskey = rand(0, count($usernames) - 1);
  $bidder_username = $usernames[$usernameskey];

  $cache = array();
  array_push($cache, $bidder_username);
  array_push($cache, $creator_username);

  $details = $faker->paragraph;
  $amount = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
  $created_at = '2017-10-17 00:00:00';
  $updated_at = '2017-10-18 00:00:00';

  $template = "INSERT INTO `Bid` (`task_title`, `task_creator_username`, `bidder_username`, `details`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$title', '$creator_username', '$bidder_username', '$details', '$amount', '$created_at', '$updated_at', NULL);";
  echo $template."\n";

  for($w = 0; $w < $numBids; $w++) {

    while (in_array($bidder_username, $cache)) {
      $usernameskey = rand(0, count($usernames) - 1);
      $bidder_username = $usernames[$usernameskey];
    }

    array_push($cache, $bidder_username);

    $details = $faker->paragraph;
    $amount = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
    $created_at = '2017-10-17 00:00:00';
    $updated_at = '2017-10-18 00:00:00';
    $template = "INSERT INTO `Bid` (`task_title`, `task_creator_username`, `bidder_username`, `details`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$title', '$creator_username', '$bidder_username', '$details', '$amount', '$created_at', '$updated_at', NULL);";
    echo $template."\n";
  }
}

*/

$task_creator = array('pierre01',
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
'eldon.hoeger',
'streich.dorothy',
'okessler',
'kling.elizabeth',
'olson.gaetano',
'marc19',
'kamille.mann',
'walter.carli',
'grady.zelda',
'olson.gaetano',
'carlie.klocko',
'treutel.hildegard',
'nader.jacinthe',
'schmitt.rachel',
'marc19',
'arau',
'fisher.kraig',
'schmitt.rachel',
'francisco81',
'rowe.herminio',
'weston.langosh',
'mack22',
'kiana52',
'ritchie.josefina',
'arau',
'femard',
'metz.marcella',
'tbailey',
'jennie18',
'chaya.witting',
'tbailey',
'savanna06',
'fisher.kraig',
'ylittel',
'tgottlieb',
'sedrick30',
'francisco81',
'wmarquardt',
'coberbrunner',
'zechariah.boyer',
'tdach',
'augustus.zieme',
'tgottlieb',
'clinton62',
'eldon.hoeger',
'junior.runte',
'augustus.zieme',
'jennie18',
'margarete12',
'raphael.toy',
'kuhic.brando',
'shanel.wunsch',
'lexus.marks',
'carlie.klocko',
'jennie18',
'cemard',
'lexus.marks',
'ritchie.josefina',
'treutel.hosea',
'walter.carli',
'farrell.berniece',
'mclaughlin.major',
'kamille.mann',
'jsimonis',
'yabshire',
'schmitt.rachel',
'gutmann.briana',
'tgorczany',
'florine.jaskolski',
'florine.jaskolski',
'chaya.borer',
'gmckenzie',
'marques.ziemann',
'bryce.maggio',
'metz.marcella',
'victor03',
'francisco81',
'augustus.zieme',
'emayer',
'vince14',
'kamille.mann',
'clinton62',
'joelle51',
'zechariah.boyer',
'marques.ziemann',
'carlie.klocko',
'florine.jaskolski',
'metz.marcella',
'zechariah.boyer',
'kling.elizabeth',
'shanel.wunsch',
'treutel.hosea',
'jsimonis',
'emayer',
'treutel.hosea',
'murl24',
'ritchie.josefina',
'margarete12',
'grady.zelda',
'zelda76',
'kozey.jennifer',
);

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
'Bridge Tender OR Lock Tender 51',
'Communications Teacher 52',
'Recordkeeping Clerk 53',
'Photographer 54',
'Motor Vehicle Inspector 55',
'Industrial Engineer 56',
'Computer Science Teacher 57',
'Court Clerk 58',
'Interviewer 59',
'Product Specialist 60',
'Clinical Laboratory Technician 61',
'Music Composer 62',
'Night Shift 63',
'Electrical and Electronic Inspector and Tester 64',
'Motorboat Operator 65',
'Tool and Die Maker 66',
'Welfare Eligibility Clerk 67',
'Log Grader and Scaler 68',
'Forensic Science Technician 69',
'Portable Power Tool Repairer 70',
'Online Marketing Analyst 71',
'Marriage and Family Therapist 72',
'Night Shift 73',
'Life Science Technician 74',
'User Experience Researcher 75',
'Visual Designer 76',
'Cutting Machine Operator 77',
'Producer 78',
'Meter Mechanic 79',
'Bindery Worker 80',
'Marking Clerk 81',
'Order Filler OR Stock Clerk 82',
'Elementary School Teacher 83',
'Manufactured Building Installer 84',
'Health Educator 85',
'Usher 86',
'Biochemist or Biophysicist 87',
'Fishing OR Forestry Supervisor 88',
'Roofer 89',
'Precision Devices Inspector 90',
'Pharmaceutical Sales Representative 91',
'RN 92',
'Cook 93',
'Fishing OR Forestry Supervisor 94',
'Credit Checker 95',
'Casting Machine Operator 96',
'Lifeguard 97',
'Media and Communication Worker 98',
'Business Operations Specialist 99',
'Telemarketer 100',
'Library Assistant 101',
'Aircraft Launch Specialist 102',
'User Experience Researcher 103',
'Airframe Mechanic 104',
'Conveyor Operator 105',
'Real Estate Appraiser 106',
'Structural Metal Fabricator 107',
'Gas Processing Plant Operator 108',
'Chemical Equipment Tender 109',
'Command Control Center Specialist 110',
'Human Resource Director 111',
'Economist 112',
'Production Laborer 113',
'Furniture Finisher 114',
'Fashion Model 115',
'Forming Machine Operator 116',
'Human Resource Manager 117',
'Commercial and Industrial Designer 118',
'Brattice Builder 119',
'Stationary Engineer 120',
'Safety Engineer 121',
'Audio and Video Equipment Technician 122',
'Railroad Conductors 123',
'Telecommunications Equipment Installer 124',
'Model Maker 125',
'Agricultural Manager 126',
'Textile Machine Operator 127',
'Law Clerk 128',
'Precision Pattern and Die Caster 129',
'Architectural Drafter OR Civil Drafter 130',
'Carpet Installer 131',
'Assembler 132',
'Mechanical Equipment Sales Representative 133',
'Fashion Model 134',
'Dot Etcher 135',
'Hand Sewer 136',
'Recruiter 137',
'Milling Machine Operator 138',
'Computer Support Specialist 139',
'Director Of Talent Acquisition 140',
'Cooling and Freezing Equipment Operator 141',
'General Farmworker 142',
'Avionics Technician 143',
'Supervisor Correctional Officer 144',
'Weapons Specialists 145',
'Barber 146',
'Travel Guide 147',
'Taxi Drivers and Chauffeur 148',
'Dental Hygienist 149',
'Probation Officers and Correctional Treatment Specialist 150');

$tags = array(
  'fuga',
  'corporis',
  'corrupti',
  'nesciunt',
  'et',
  'dolores',
  'nam',
  'aut',
  'saepe',
  'eos',
  'qui',
  'dolorem',
  'tenetur',
  'odit',
  'incidunt',
  'est',
  'voluptates',
  'reprehenderit',
  'nisi',
  'enim',
  'sit',
  'ullam',
  'architecto',
  'quasi',
  'placeat',
  'laboriosam',
  'nemo',
  'inventore',
  'ut',
  'beatae',
  'modi',
  'ad',
  'ea',
  'excepturi',
  'praesentium',
  'ratione',
  'veniam',
  'ex',
  'sunt',
  'deleniti',
  'dicta',
  'dolore',
  'repellat',
  'voluptas',
  'nostrum',
  'voluptatibus',
  'exercitationem',
  'laudantium',
  'tempore',
  'dolorum'
);
/*
for ($i = 0; $i < 150; $i++) {

  $tasktitle = $task_titles[$i];
  $creator = $task_creator[$i];
  $tag = $tags[rand(0, 49)];

  $cache = array();

  for($w = 0; $w < rand(1, 5); $w++){
    $tag = $tags[rand(0, 49)];
    while (in_array($tag, $cache)) {
      $tag = $tags[rand(0, 49)];
    }
    array_push($cache, $tag);

    $template = "INSERT INTO `Tag_task` (`tag_name`, `task_creator_username`, `task_title`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$tag', '$creator', '$tasktitle', '', NULL, NULL);";
    echo $template."\n";
  }
}*/

/*
// Tag creation
$cache = array();
for($i = 0; $i < 50; $i++) {
    $word = $faker->word;
    while (in_array($word, $cache)) {
        $word = $faker->word;
    }
    array_push($cache, $word);
    $template = "INSERT INTO `Tag` (`name`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$word', '2017-11-02 00:00:00', '2017-11-02 00:00:00', NULL);"."\n";
    echo $template;
}*/

$categories = array('Minor Repairs',
'Mounting',
'Assembly',
'Help Moving',
'Delivery',
'BabySitting');

// add to categories tasks
for ($i = 0; $i < 150; $i++) {

  $tasktitle = $task_titles[$i];
  $creator = $task_creator[$i];

  $category = $categories[rand(0, count($categories) - 1)];

  $template = "INSERT INTO `Category_task` (`category_name`, `task_title`, `task_creator_username`, `created_at`, `updated_at`, `deleted_at`) VALUES ('$category', '$tasktitle', '$creator', '2017-11-02 00:00:00', NULL, NULL);";
  echo $template."\n";

}

?>
