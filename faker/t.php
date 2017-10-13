<?php
    require_once 'autoload.php';
    date_default_timezone_set('America/Los_Angeles');
    $faker = Faker\Factory::create('en_SG');

    $TABLENAME = 'User';
    $PASSWORDFORALL = 'vanisgay';

    // Generate users
for($q = 0; $q < 1000; $q++) {
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
?>
