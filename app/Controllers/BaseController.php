<?php

namespace App\Controllers;

use App\Models\WebmetaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['url', 'form', 'cookie', 'site', 'text'];

    protected Session $session;
    protected \Config\Pelindo $pelindo;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->session = service('session');
        $this->pelindo = config('Pelindo');

        // Bahasa default website
        if (! $this->session->has('weblang')) {
            $this->session->set('weblang', $this->pelindo->defaultLanguage);
        }
    }

    /**
     * Render sebuah halaman lengkap dengan header dan footer.
     */
    protected function renderPage(string $view, array $data = []): string
    {
        $headerData = [
            'webmeta' => model(WebmetaModel::class)->getMeta(),
        ];

        return view('header', $headerData + $data)
            . view($view, $data)
            . view('footer', $headerData);
    }
}
