<?php

/**
 * Description of Biografija_upload_config
 *
 * @author Radja
 */
class Biografija_upload_config {
    
    public static function get($recezentId = null) {
        $CI =& get_instance();
        $config_upload = $CI->config->item('upload');
        $config_upload['allowed_types'] = 'pdf';
        $config_upload['file_name'] = 'biografija';
        $config_upload['overwrite'] = true;
        $config_upload['file_ext_tolower'] = true;
        if (null !== $recezentId) {
            $config_upload['upload_path'] = './uploads/recezent_' . (int)$recezentId;
        }
        
        return $config_upload;
    }
    
}
