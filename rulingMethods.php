<?php
    class A{ 
        private $rules = array();
        public function DownloadSpeedGreaterThan100AndFiber()
        {
            $this->rules['condition'] = "WHERE downloadSpeed > 100 AND staticIp = 'No'";
            $this->rules['title'] = "Download Speed Greater Than 100 And No Static IP";

            return $this->rules;
        }
        
    }
    class B{
        private $rules = array();
        public function UploadSpeedLessThan100AndFiber()
        {
            $this->rules['condition'] = "WHERE uploadSpeed < 100 AND technology = 'Fiber'";
            $this->rules['title'] = "Upload Speed Less Than 100 And Fiber Technology";

            return $this->rules;
        }
        public function UploadSpeedLessThan100()
        {
            $this->rules['condition'] = "WHERE uploadSpeed < 105";
            $this->rules['title'] = "Upload Speed Less Than 105";

            return $this->rules;
        }
    }

    class C{
        private $rules = array();
        public function DownloadSpeedGreaterThan50AndDialup()
        {
            $this->rules['condition'] = "WHERE downloadSpeed > 50 AND technology = 'Dialup'";
            $this->rules['title'] = "Download Speed Greater Than 50 and Dialup Technology";

            return $this->rules;
        }
    }

    class D{
        private $rules = array();
        public function DownloadSpeedLessThan50AndFiber()
        {
            $this->rules['condition'] = "WHERE downloadSpeed < 50 AND technology = 'Dialup'";
            $this->rules['title'] = "Download Speed Less Than 50 and Dialup Technology";

            return $this->rules;
        }
    }
?>