<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;
session_start();

use Mini\Model\Task;

class HomeController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $tags = array('Babysitting', 'Homework', 'House Cleaning', 'Car Washing');
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * Search for relevant tags from Tag table.
     */
    public function searchTags() {
        $Task = new Task();
        $search_string = $_POST['query'];
        $html = '<li><a href="index.html">Tag<br /></a></li>';

        if (strlen($search_string) >= 1 && $search_string !== ' ') {
            $result_array = $Task->findAllTagsContaining($search_string);
            if (isset($result_array)) {
                foreach ($result_array as $result) {
                    $tags = $result -> name;
                    $o = str_replace('Tag', $tags, $html);
                    echo($o);
                }
            } else {
                $o = str_replace('Tag', '<span class="label label-danger">No Tasks Found</span>', $html);
                echo($o);
            }
        } else {
            $o = '
                  <li><a href="index.html">Babysitting<br /></a></li>
                  <li><a href="index.html">Homework<br /></a></li>
                  <li><a href="index.html">House Cleaning<br /></a></li>
                  <li><a href="index.html">Car washing<br /></a></li>
                  ';
            echo($o);
        }
    }

}
