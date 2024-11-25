<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

/**
 * Home Controller
 *
 */
class HomeController extends AppController
{
    public function index(): Response
    {
        return $this->render('index', 'master');
    }
}
