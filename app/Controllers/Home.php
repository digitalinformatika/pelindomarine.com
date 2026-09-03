<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use App\Models\HomepageModel;
use App\Models\NewsModel;
use App\Models\SearchModel;
use App\Models\ServicesModel;
use CodeIgniter\HTTP\RedirectResponse;

class Home extends BaseController
{
    protected HomepageModel $homepageModel;
    protected CompanyModel $companyModel;
    protected NewsModel $newsModel;
    protected ServicesModel $servicesModel;
    protected SearchModel $searchModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger,
    ): void
    {
        parent::initController($request, $response, $logger);

        $this->homepageModel = model(HomepageModel::class);
        $this->companyModel  = model(CompanyModel::class);
        $this->newsModel     = model(NewsModel::class);
        $this->servicesModel = model(ServicesModel::class);
        $this->searchModel   = model(SearchModel::class);
    }

    public function index(): string
    {
        $this->homepageModel->cekMasaWelcomeScreen();

        return $this->renderPage('homepage', [
            'welcome'     => $this->homepageModel->getWelcome(),
            'homebanners' => $this->homepageModel->getHomeBanners(),
            'homebody'    => $this->homepageModel->getHomebody(),
            'homecert'    => $this->homepageModel->getHomeCert(),
            'homevessel'  => $this->homepageModel->getHomeVessel(),
            'homedockgal' => $this->homepageModel->getHomeDockGal(),
            'homenews'    => $this->homepageModel->getHomeNews(),
            'homelinks'   => $this->homepageModel->getHomeLinks(),
            'homemaps'    => $this->homepageModel->getHomeMaps(),
        ]);
    }

    public function lineOfBusiness(): string
    {
        return $this->renderPage('line_of_business');
    }

    public function aboutUs(): string
    {
        return $this->renderPage('company/about_us', [
            'companydata' => $this->companyModel->getCompany(),
        ]);
    }

    public function profiles(): string
    {
        return $this->renderPage('company/profiles', [
            'companydata' => $this->companyModel->getCompany(),
        ]);
    }

    public function regulatory(): string
    {
        return $this->renderPage('company/regulatory', [
            'companydata' => $this->companyModel->getCompany(),
            'companydocs' => $this->companyModel->getCompanyDocs(),
        ]);
    }

    public function news(int $offset = 0): string
    {
        $perPage = $this->pelindo->newsPerPage;

        $currentPage = (int) floor($offset / $perPage) + 1;
        $pagerLinks  = service('pager')->makeLinks(
            $currentPage,
            $perPage,
            $this->newsModel->cntDatanews(),
        );

        return $this->renderPage('company/news', [
            'newslist'   => $this->newsModel->datanews($perPage, $offset),
            'newstop'    => $this->newsModel->getNewsTop(),
            'pagerLinks' => $pagerLinks,
        ]);
    }

    /**
     * @return RedirectResponse|string
     */
    public function readnews(?string $slug = null)
    {
        $newsdetail = $this->newsModel->getNewsDetail($slug);

        if (! isset($newsdetail['NAMA'])) {
            return redirect()->to(base_url());
        }

        return $this->renderPage('company/readnews', [
            'newsdetail' => $newsdetail,
            'title'      => $newsdetail['NAMA'],
            'newslist'   => $this->newsModel->getNewsList(),
            'homenews'   => $this->homepageModel->getHomeNews(7),
        ]);
    }

    public function careers(): string
    {
        return $this->renderPage('company/careers', [
            'companyjobs' => $this->companyModel->getCompanyJobs(),
        ]);
    }

    public function vessel(): string
    {
        $keyword = $this->request->getPost('keyword');

        return $this->renderPage('services/vessel', [
            'vesselcat'    => $this->servicesModel->getVesselCat(),
            'vessels'      => $this->servicesModel->getVessels(),
            'allvessel'    => $this->servicesModel->getVesselsAll(),
            'searchresult' => $this->servicesModel->getKeyword($keyword),
            'fkeyword'     => $keyword,
        ]);
    }

    public function service(): string
    {
        return $this->renderPage('services/service');
    }

    public function shipyard(): string
    {
        return $this->renderPage('services/shipyard');
    }

    public function marinecare(): string
    {
        $data     = [];
        $formData = [];

        if ($this->request->getPost('contactSubmit')) {
            $formData = $this->request->getPost();

            $sent = $this->sendContactEmail([
                'name'     => $formData['name'] ?? '',
                'category' => $formData['category'] ?? '',
                'email'    => $formData['email'] ?? '',
                'subject'  => $formData['subject'] ?? '',
                'company'  => $formData['company'] ?? '',
                'message'  => $formData['message'] ?? '',
            ]);

            if ($sent) {
                $formData       = [];
                $data['status'] = [
                    'type' => 'success',
                    'msg'  => 'Your contact request has been submitted successfully.',
                ];
            } else {
                $data['status'] = [
                    'type' => 'error',
                    'msg'  => 'Some problems occured, please try again.',
                ];
            }
        }

        $data['postData'] = $formData;

        return $this->renderPage('marinecare', $data);
    }

    public function ppid(): string
    {
        return $this->renderPage('ppid');
    }

    public function search(): string
    {
        $keyword = $this->request->getPost('keyword');

        return $this->renderPage('search', [
            'searchresult' => $this->searchModel->searchKeyword($keyword),
            'fkeyword'     => $keyword,
        ]);
    }

    /**
     * Toggle bahasa website lalu kembali ke halaman sebelumnya.
     */
    public function language(): RedirectResponse
    {
        $current = session('weblang');
        session()->set('weblang', $current === 'english' ? 'indonesia' : 'english');

        return redirect()->back();
    }

    private function sendContactEmail(array $mailData): bool
    {
        $email = service('email');

        $mailContent = '
            <h2>Contact Request Submitted</h2>
            <p><b>Name: </b>' . esc($mailData['name']) . '</p>
            <p><b>Email: </b>' . esc($mailData['email']) . '</p>
            <p><b>Subject: </b>' . esc($mailData['subject']) . '</p>
            <p><b>Company: </b>' . esc($mailData['company']) . '</p>
            <p><b>Message: </b>' . esc($mailData['message']) . '</p>
        ';

        $email->setTo($this->pelindo->contactEmail);
        $email->setFrom($mailData['email'], $mailData['name']);
        $email->setSubject('Pelindomarine.com - Contact Submitted by ' . $mailData['name']);
        $email->setMessage($mailContent);
        $email->setMailType('html');

        return $email->send();
    }
}
