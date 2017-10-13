<?php
    require_once 'autoload.php';
    date_default_timezone_set('America/Los_Angeles');
    $faker = Faker\Factory::create('en_SG');

    $TABLENAME = 'User';
    $PASSWORDFORALL = 'vanisgay';

    // Generate users
/*for($q = 0; $q < 100; $q++) {
    $time = date_format($faker->dateTimeThisDecade($max="now"), "Y-m-d H:i:s");
    $password = password_hash($PASSWORDFORALL, PASSWORD_DEFAULT);

    $template = "INSERT INTO $TABLENAME
    (`username`,
      `first_name`,
      `last_name`,
      `password_hash`,
      `contact`,
      `email`,
      `created_at`,
      `updated_at`,
      `deleted_at`,
      `user_type`)
      VALUES (
        '$faker->username',
        '$faker->firstName',
        '$faker->lastName',
        '$password',
        '$faker->fixedLineNumber',
        '$faker->email',
        '$time',
        '',
        '',
        'User'
    )";

    echo $template;
}
*/
// Generate tasks

for($i = 0; $i < 100; $i++) {
  $time = date_format($faker->dateTimeThisDecade($max="now"), "Y-m-d H:i:s");
  $biasedminbid = $faker->biasedNumberBetween($min = 1, $max = 40, $function = 'sqrt');
  $biasedmaxbid = $faker->biasedNumberBetween($min = 41, $max = 120, $function = 'sqrt');
  $username = 'asdfasf';

  $template = "INSERT INTO `mini`.`Task` (
    `title`,
    `description`,
    `created_at`,
    `updated_at`,
    `start_at`,
    `end_at`,
    `min_bid`,
    `max_bid`,
    `creator_username`,
    `assignee_username`,
    `deleted_at`,
    `creator_rating`,
    `assignee_rating`,
    `completed_at`,
    `remarks`)
    VALUES (
      '$faker->jobTitle',
      '$faker->paragraph',
      '$time',
      '$time',
      '2017-10-16 00:00:00',
      '2017-10-21 00:00:00',
      '$biasedminbid',
      '$biasedmaxbid',
      '$username',
      '',
      NULL,
      NULL,
      NULL,
      NULL,
      NULL);";

      echo $template;
}
?>
