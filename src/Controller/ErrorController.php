<?php
/**
 * The error controller.
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * The start of the error controller class
 *
 * Class ErrorController
 * @package App\Controller
 */
class ErrorController extends Controller
{

    /**
     * Function that returns a 404 error page
     *
     * @Route("/error", name="error")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('error/404.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }
}
