<?php

/**
 * Description of AutoloadApp
 * @author merten
 */
class AutoloadApp extends Instance {

        public function __construct(DbConnect $model = null, $view = null) {
                parent::__construct($model, $view);
        }

        public function getFrameworkFolders() {
                $output = $this->getModel()->getEnabledApps();
                $folders = array();
                $output->each(function( $value, $id ) use (&$folders) {
                                $dir = FOLDER_APP . $value['folder'] . '/' . $value['key'] . '/' . $value['version'] . '/framework/';
                                if (is_dir($dir))
                                        array_push($folders, $dir);
                        });
                return $folders;
        }

}

?>