<?php

/**
 * Description of AutoloadAppModel
 * @author merten
 */
class AutoloadAppModel extends DbConnect {

        public function __construct() {
                parent::__construct();
        }
        
        /**
         * Get list of apps which are actively linked to a page,
         * and are set to be NOT disabled in their app configuration.
         * 
         */
        public function getEnabledApps() {
                $q = new DbQuery();
                $q 
                        ->addSelect('a.folder')
                        ->addSelect('a.key')
                        ->addSelect('a.version')
                        ->addFrom('page_app', 'pa')
                        ->addJoin(new DbQueryStrJoinRight('app', 'a', 'pa.app_id=a.app_id'))
                        ->addWhere('a.disabled=0')
                        ->addGroupBy('a.app_id')
                ;
                
                $output = $this->select2( $q );
                if ($output->count() > 0)
                        return $output;
                return false;
        }
}

?>