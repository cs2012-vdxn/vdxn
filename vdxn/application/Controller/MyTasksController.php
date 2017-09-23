<?php
namespace Mini\Controller;

class MyTasksController
{
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/mytasks/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
