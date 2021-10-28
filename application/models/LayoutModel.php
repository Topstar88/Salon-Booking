<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class LayoutModel extends CI_Model {

    public function scripts_settings() {
        $this->load->model('Settings/ScriptsModel');
        return $this->ScriptsModel->get();
    }
    
    public function ads_settings() {
        $this->load->model('Settings/AdsModel');
        return $this->AdsModel->get();
    }
    
    public function meta_settings() {
        $this->load->model('Settings/MetaModel');
        return $this->MetaModel->get();
    }
    
    public function analytics_settings() {
        $this->load->model('Settings/AnalyticsModel');
        return $this->AnalyticsModel->get();
    }
    
    public function smtp_settings() {
        $this->load->model('Settings/SmtpModel');
        return $this->SmtpModel->get();
    }
    
    public function all_pages() {
        $this->load->model('Settings/PagesModel');
        return $this->PagesModel->get();
    }
    
    public function recaptcha_settings() {
        $this->load->model('Settings/RecaptchaModel');
        return $this->RecaptchaModel->get();
    }

    public function social_keys() {
        $this->load->model('Settings/SocialKeysModel');
        return $this->SocialKeysModel->get();
    }


    public function layoutData() {
        /* Loading all Basic Models */
        $this->load->model('Settings/ScriptsModel');
        $this->load->model('Settings/MetaModel');
        $this->load->model('Settings/AdsModel');
        $this->load->model('Settings/RecaptchaModel');
        $this->load->model('Settings/AnalyticsModel');
        $this->load->model('Settings/PageModel');
        
        /* Initializing Settings with Data from Cache or Database */
        $settings = array(
            'scripts'   => $this->ScriptsModel->get(),
            'meta_tags' => $this->MetaModel->get(),
            'ads'       => $this->AdsModel->get(),
            'recaptcha' => $this->RecaptchaModel->get(),
            'analytics' => $this->AnalyticsModel->get(),
            'pages'     => $this->PageModel->get(),
        );
        return $settings;
    }
}