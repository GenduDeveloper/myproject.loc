<?php

require __DIR__ . '/../vendor/autoload.php';

try {
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        throw new \MyProject\Exceptions\NotFoundException();
    }


    unset($matches[0]);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);
} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates');
    $view->setVar('user', \MyProject\Models\Users\UserAuthService::getUserByToken());
    $view->renderHtml('errors/500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new MyProject\View\View(__DIR__ . '/../templates');
    $view->setVar('user', \MyProject\Models\Users\UserAuthService::getUserByToken());
    $view->renderHtml('errors/404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates');
    $view->setVar('user', \MyProject\Models\Users\UserAuthService::getUserByToken());
    $view->renderHtml('errors/401.php', ['error' => $e->getMessage()], 401);
} catch (\MyProject\Exceptions\ForbiddenException|\MyProject\Exceptions\AccessDeniedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates');
    $view->setVar('user', \MyProject\Models\Users\UserAuthService::getUserByToken());
    $view->renderHtml('errors/403.php', ['error' => $e->getMessage()], 403);
} catch (\MyProject\Exceptions\UserNotFoundException|\MyProject\Exceptions\ArticlesNotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/../templates');
    $view->setVar('user', \MyProject\Models\Users\UserAuthService::getUserByToken());
    $view->renderHtml('errors/404.php', ['error' => $e->getMessage()], 404);
}
