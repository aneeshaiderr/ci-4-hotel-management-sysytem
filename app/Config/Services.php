<?php

namespace Config;

use CodeIgniter\Config\BaseService;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    protected $twig;

      public static function twig($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('twig');
        }

        // Twig loader pointing to app/Views
        $loader = new FilesystemLoader(APPPATH . 'Views');


        $twig = new Environment($loader, [
            'cache' => WRITEPATH . 'cache/twig',
            'debug' => true,
        ]);

   // Shield auth
      $auth = auth();
      $twig->addGlobal('user', $auth->user());
      $twig->addGlobal(
    'userPermissions',
    $auth->user() ? $auth->user()->getPermissions() : []
);

    $twig->addGlobal('user', $auth->user());
    $twig->addGlobal('userGroups', $auth->user() ? $auth->user()->getGroups() : []);
    $twig->addGlobal('current_uri', service('uri')->getSegment(1));

        $twig->addExtension(new \Twig\Extension\DebugExtension());

        // base_url()
        $twig->addFunction(new TwigFunction('base_url', function($uri = '') {
            return base_url($uri);
        }));

        // csrf_token()
        $twig->addFunction(new TwigFunction('csrf_token', function() {
            return csrf_token();
        }));

        // csrf_hash()
        $twig->addFunction(new TwigFunction('csrf_hash', function() {
            return csrf_hash();
        }));

        return $twig;

    }
   public function render(string $view, array $data = []): string
    {
        return $this->twig->render($view . '.twig', $data);
    }
}
