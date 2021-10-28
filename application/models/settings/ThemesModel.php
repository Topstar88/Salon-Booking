<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class ThemesModel extends CI_Model {
    
    public function get() {
        $res = $this->db
                    ->limit(1)
                    ->get('themesettings')
                    ->row_array();
        return $res['theme'];
    }

    public function doesThemeExist($theme) {
        return file_exists(APPPATH.'views/themes/'.$theme.'/manifest.json') ? json_decode(file_get_contents(APPPATH.'views/themes/'.$theme.'/manifest.json'), true) : false;
    }
    
    public function getAvailableThemes() {
        $theme_dirs = array_filter(glob(APPPATH.'views/themes/*'), 'is_dir');
        $themes = array();

        foreach($theme_dirs as $i => $theme) {
            $manifest = json_decode(file_get_contents($theme.'/manifest.json'), true);
            $manifest['identifier'] = basename($theme);

            array_push($themes, array(
                'manifest'  => $manifest,
                'cover'     => base_url('application/views/themes/' . $manifest['identifier'] . '/' . $manifest['cover']),
                'thumbnail' => base_url('application/views/themes/' . $manifest['identifier'] . '/' . $manifest['thumbnail']),
            ));
        }

        return $themes;
    }

    public function set($fields) {
        $this->db
             ->set($fields)
             ->where('id', 1)
             ->update('themesettings');
    }
}