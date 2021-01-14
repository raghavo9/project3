<?php


namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();

        $html_code="<body style=\"background-image: url('/images/not_found_2.png');background-position: center; background-repeat: no-repeat;background-attachment: fixed; background-size: cover; \"></body>";

/*

        $message = sprintf(
            '<h1>You have landed to the error page , with error :</h1><h2>: %s </h2> with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

  
  */

        $message = sprintf('%s',$html_code);


        $response = new Response();
        $response->setContent($message);


        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
        //return $this->render('not_found_error/error_page1.html.twig');                    by raghavo9
    }
}


?>