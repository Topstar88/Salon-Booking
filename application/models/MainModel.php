<?php

class MainModel extends CI_Model{
    private $theme;

    public function __construct() {
        parent::__construct();
        $this->load->model('settings/ThemesModel');
    }

    public function admin_settings() {
        $this->load->model('AdminModel');
        return $this->AdminModel->adminDetails();
    }

    public function general_settings() {
        $this->load->model('settings/GeneralModel');
        return $this->GeneralModel->get();
    }

    public function ads_settings() {
        $this->load->model('settings/AdsModel');
        return $this->AdsModel->get();
    }
    
    public function meta_settings() {
        $this->load->model('settings/MetaModel');
        return $this->MetaModel->get();
    }
    
    public function analytics_settings() {
        $this->load->model('settings/AnalyticsModel');
        return $this->AnalyticsModel->get();
    }
    
    public function smtp_settings() {
        $this->load->model('settings/SmtpModel');
        return $this->SmtpModel->get();
    }
	
	 public function comment_settings() {
        $this->load->model('settings/CommentSettingsModel');
        return $this->CommentSettingsModel->get();
    }
    
    public function all_pages() {
        $this->load->model('settings/PagesModel');
        return $this->PagesModel->get();
    }
    
    public function recaptcha_settings() {
        $this->load->model('settings/RecaptchaModel');
        return $this->RecaptchaModel->get();
    }
    
    public function updates_settings() {
        $this->load->model('UpdatesModel');
        return $this->UpdatesModel->update_info();
    }
    
    public function theme() {
        return $this->ThemesModel->get();
    }

    public function theme_view() {
        $theme = $this->ThemesModel->get();
        return function($view, $data = null) use ($theme) { return $this->load->view('themes/'.$theme.'/'.$view, $data); };
    }
    
    public function theme_assets() {
        $theme = $this->ThemesModel->get();
        return function($path) use ($theme) { echo base_url('application/views/themes/'.$theme.'/assets/'.$path); return true; };
    }

    public function social_keys() {
        $this->load->model('settings/SocialKeysModel');
        return $this->SocialKeysModel->get();
    }

    public function pageData() {
        /* Loading all Basic Models */
        $this->load->model('settings/GeneralModel');
        $this->load->model('settings/MetaModel');
        $this->load->model('settings/AdsModel');
        $this->load->model('settings/RecaptchaModel');
        $this->load->model('settings/AnalyticsModel');
        $this->load->model('settings/PageModel');
        $this->load->model('settings/ThemesModel');
        $this->load->model('BlogModel');
        
        /* Initializing settings with Data from Cache or Database */

        $settings = array(
            'general'       => $this->GeneralModel->get(),
            'meta_tags'     => $this->MetaModel->get(),
            'ads'           => $this->AdsModel->get(),
            'recaptcha'     => $this->RecaptchaModel->get(),
            'analytics'     => $this->AnalyticsModel->get(),
            'pages'         => $this->PageModel->get(),
            'theme'         => $this->ThemesModel->get(),
            'blogStatus'    => $this->BlogModel->blogStatus()
        );

        $theme = $settings['theme'];

        /* Returning Anonymous functions to Retrieve Theme Specific Views & Assets */

        $settings['theme_view'] = function($view, $data = null) use ($theme) { return $this->load->view('themes/'.$theme.'/'.$view, $data); };
        $settings['assets']     = function($path) use ($theme) { echo base_url('application/views/themes/'.$theme.'/assets/'.$path); return true; };
        return $settings;
    }
}
?>