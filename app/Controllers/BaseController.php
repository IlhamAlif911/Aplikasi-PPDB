<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\KodeAplikasi;
use App\Models\KategoriKode;



/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $data = [];
    

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [
        'form',
        'url',
        'html',
        'utilities'
    ];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        //  App Variables
        $this->data['app_name'] = 'SMK WIDYA MANDALA TAMBAK';
        $this->data['setting'] = $this->getSettings();
        $this->data['layout'] = 'layouts/default';
        $this->data['active'] = 'index';
        $this->data['title'] = 'Home';
        $this->data['type'] = 'product-grid';

        // Plugins Variables
        // isTour, isSelect2, isMasonry, isFlatpickr, isVectorMap, isFslightbox, isSweetalert, isChoisejs, isFormWizard, isQuillEditor, isCircleProgress, isNoUISlider, isSignaturePad, isUppy, isSwiperSlider, isCropperjs, isBarRatting, isPrism, isBtnHover
        $this->data['plugins'] = [];

        // or else
        $this->data['isTour']           = false;
        $this->data['isSelect2']        = false;
        $this->data['isMasonry']        = false;
        $this->data['isFlatpickr']      = false;
        $this->data['isVectorMap']      = false;
        $this->data['isFslightbox']     = false;
        $this->data['isSweetalert']     = false;
        $this->data['isChoisejs']       = false;
        $this->data['isFormWizard']     = false;
        $this->data['isQuillEditor']    = false;
        $this->data['isCircleProgress'] = false;
        $this->data['isNoUISlider']     = false;
        $this->data['isSignaturePad']   = false;
        $this->data['isUppy']           = false;
        $this->data['isSwiperSlider']   = false;
        $this->data['isCropperjs']      = false;
        $this->data['isBarRatting']     = false;
        $this->data['isTreeView']       = false;
        $this->data['isPrism']          = false;
        $this->data['isBtnHover']       = false;
        $this->data['isFullCalendar']   = false;
        $this->data['isViewer']         = false;

        // Setting Variables
        $this->data['isSidebar'] = true;
        $this->data['isNavbar'] = true;
        $this->data['isBanner'] = false;
        $this->data['isPageContainer'] = true;
        
    }

    protected function getSettings()
    {
        $userModel = new \App\Models\AppSetting();
        $setting = $userModel->get_settings('layout_setting', true)->first();
        return $setting->value ?? '{"setting": {"footer": {"value": "default"}, "app_name": {"value": "Hope UI"}, "page_layout": {"value": "container-fluid"}, "theme_color": {"value": "theme-color-default"}, "sidebar_type": {"value": []}, "theme_scheme": {"value": "light"}, "header_banner": {"value": "default"}, "header_navbar": {"value": "default"}, "sidebar_color": {"value": "sidebar-white"}, "theme_font_size": {"value": "theme-fs-md"}, "body_font_family": {"value": null}, "theme_transition": {"value": null}, "sidebar_menu_style": {"value": "sidebar-default navs-rounded-all"}, "heading_font_family": {"value": null}, "theme_scheme_direction": {"value": "ltr"}, "theme_style_appearance": {"value": []}}, "storeKey": "huisetting", "saveLocal": ""}';
    }
    public function codeAll($nama_kategori){
        $kode = new KodeAplikasi();
        $kategori = new KategoriKode();
        $datakategori = $kategori->where('nama_kategori',$nama_kategori)->first();
        $dataKode = $kode->where('id_kategori',$datakategori->id)->findall();
        return $dataKode;
    }

    public function code($id){
        $kode = new KodeAplikasi();
        $dataKode = $kode->where('id', $id)->first();
        return $dataKode;
    }

    public function codeWithName($nama_opsi){
        $kode = new KodeAplikasi();
        $dataKode = $kode->where('nama_opsi', $nama_opsi)->first();
        return $dataKode;
    }
    
    function formatTanggal($date){
        // menggunakan class Datetime
        $pecah = explode('-', $date);
        return $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
    }

    function formatTanggalReverse($date){
        // menggunakan class Datetime
        $date=str_replace("/","-",$date);
        $pecah = explode('-', $date);
        return $pecah[2].'-'.$pecah[1].'-'.$pecah[0];
    }

    function formatBulan(){
        $bulan=[
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulan;
    }
}
