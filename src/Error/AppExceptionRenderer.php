<?php
declare(strict_types=1);

namespace App\Error;

use App\Error\CustomException\UnprocessableEntityException;
use Authorization\Exception\AuthorizationRequiredException;
use Authorization\Exception\ForbiddenException;
use Cake\Core\Exception\CakeException;
use Cake\Error\ExceptionRenderer;
use Cake\Http\Exception\HttpException;
use Cake\Http\Response;

class AppExceptionRenderer extends ExceptionRenderer
{
    public function authorizationRequired(AuthorizationRequiredException $exception): Response
    {
        return $this->renderErrorTemplate($exception, 403);
    }

    public function forbidden(ForbiddenException $exception): Response
    {
        return $this->renderErrorTemplate($exception, 403);
    }

    public function UnprocessableEntity(UnprocessableEntityException $exception): Response
    {
        return $this->renderErrorTemplate($exception);
    }



    private function renderErrorTemplate(HttpException | CakeException $exception, ?int $code = null): Response
    {
        $this->clearOutput();

        $code = $code ?? $this->getHttpCode($exception);
        $message = $this->_message($exception, $code);
        $url = $this->controller->getRequest()->getRequestTarget();

        $response = $this->controller->getResponse();
        $response = $response->withStatus($code);
        $this->controller->setResponse($response);

        $viewVars = [
            'message' => $message,
            'url' => h($url),
            'error' => $exception,
            'code' => $code,
        ];
        $this->controller->set($viewVars);

        $template = "error$code";

        return $this->_outputMessage($template);
    }
}
