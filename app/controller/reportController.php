<?php

error_reporting(0);

class reportController {
    public function view(){
        $data = array();
        $tmp_data = array();

        if ($handle = opendir(APP_ROOT.'/storage/')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $entry = explode('_',$file);
                    $tmp_data[] = array('num' => $entry[0], 'file' => $file, 'date' => substr($entry[1],0,-4));
                }
            }
            closedir($handle);
        }

        foreach($tmp_data as $tmp){
            $data[date('Ym',$tmp['date'])][] = $tmp;
        }

        foreach($data as $k => $d){
            usort($d, function($a, $b) {
                return $a['date'] - $b['date'];
            });
            $data[$k] = $d;
        }

        krsort($data);

        return $data;
    }


    public function api_stream_file(){
        $file = $_POST['file'];

        if(file_exists(APP_ROOT.'/storage/'.$file)){
            $data = base64_encode(file_get_contents(APP_ROOT.'/storage/'.$file));
        }else{
            //ERROR
        }

        echo $data;
    }

    public function api_generate(){

        $settings = array(
            'START' => AUSB_START,
            'CURRENT_DATE' => date('d.m.Y'),
            'NR' => 1,
            'COMPANY' => 'H3-Netservice GmbH',
            'ABTEILUNG' => 'IT',
            'WEEK_START' => '01.02.19970',
            'WEEK_ENDE' => '07.02.19970',
            'JAHR' => 1 /*1/2/3*/
        );

        $sets = Set::all(array('conditions' => array('set_date >= ?',date('Ymd', strtotime($settings['START'])))));

        $reportList = array();

        foreach($sets as $set){
            if($set->set_date >= date('Ymd', strtotime($settings['START']))){
                $reportList[substr($set->set_date,0,4).date('W', strtotime(substr($set->set_date,-2,2).'.'.substr($set->set_date,-4,2).'.'.substr($set->set_date,0,4)))][] = $set;
            }
        }

        ksort($reportList);

        foreach($reportList as $stamp => $days){

            $settings['WEEK_START'] = date('d.m.Y', strtotime(substr($stamp, 0, 4)."-W".substr($stamp, 4)."-1"));
            $settings['WEEK_ENDE']  = date('d.m.Y', strtotime('+4 days', strtotime($settings['WEEK_START'])));

            if(strtotime($settings['WEEK_ENDE']) < strtotime($settings['START'])){
                continue;
            }

            $settings['CURRENT_DATE'] = $settings['WEEK_ENDE'];

            if((int)substr($settings['START'],-4) < (int)substr($settings['WEEK_START'],-4)){
                $settings['JAHR'] = (int)substr($settings['WEEK_START'],-4) - (int)substr($settings['START'],-4) +1;
            }

            $overAllGesamt = 0;
            $content = file_get_contents(APP_ROOT.'/views/report/pdf/report.ptp');

            foreach($settings as $setting => $value){
                $content = str_replace('[%'.$setting.'%]', $value, $content);
            }

            $workedDays = array('MO' => false, 'DI' => false, 'MI' => false, 'DO' => false, 'FR' => false);

            foreach($days as $day){
                $date = substr($day->set_date,-2,2).'.'.substr($day->set_date,-4,2).'.'.substr($day->set_date,0,4);
                switch(date('N', strtotime($date))){
                    case 1:
                        $step = 'MO';
                        $workedDays['MO'] = true;
                        break;
                    case 2:
                        $step = 'DI';
                        $workedDays['DI'] = true;
                        break;
                    case 3:
                        $step = 'MI';
                        $workedDays['MI'] = true;
                        break;
                    case 4:
                        $step = 'DO';
                        $workedDays['DO'] = true;
                        break;
                    case 5:
                        $step = 'FR';
                        $workedDays['FR'] = true;
                        break;
                    default:
                        $step = 'MO';
                        $workedDays['MO'] = true;
                        break;
                }

                $data = json_decode($day->object_data);

                $text = '';
                $einzel = '';
                $gesamt = 0;

                foreach($data as $time){
                    $text .= $time->project_name.' - '.$time->service_name.'<br />';
                    $einzel .= number_format($time->minutes/60,2).'<br />';
                    $gesamt += number_format(($time->minutes/60),2);
                }

                $overAllGesamt += $gesamt;

                $content = str_replace('[%'.$step.'_TEXT%]', $text, $content);
                $content = str_replace('[%'.$step.'_EINZEL%]', $einzel, $content);
                $content = str_replace('[%'.$step.'_GESAMT%]', number_format($gesamt,2), $content);
            }

            foreach($workedDays as $day => $work){
                if($work == false){
                    $content = str_replace('[%'.$day.'_TEXT%]', 'Keine Tätigkeiten', $content);
                    $content = str_replace('[%'.$day.'_EINZEL%]', '', $content);
                    $content = str_replace('[%'.$day.'_GESAMT%]', '', $content);
                }
            }


            $content = str_replace('[%WOCHE_GESAMT%]', number_format($overAllGesamt,2), $content);

            require_once APP_ROOT."/libs/dompdf/dompdf_config.inc.php";

            $dompdf = new DOMPDF();
            $dompdf->load_html(stripslashes(utf8_decode($this->charsetFix($content))));
            $dompdf->set_paper("a4", "portrait");

            $dompdf->render();
            $pdfoutput = $dompdf->output();

            $pdf_file = APP_ROOT.'/storage/'.$settings['NR'].'_'.strtotime($settings['WEEK_ENDE']).'.pdf';

            file_put_contents($pdf_file, $pdfoutput);

            $settings['NR']++;

        }



        /*Status*/
        //echo "\t\t\t".$settings['NR']." reports ".($settings['NR']>1?'have':'has')." been generated...\n";
        echo $settings['NR'];
    }

    /*Function to prevent Dompdf to loose special chars...*/
    private function charsetFix($str){
        $holder = array(
            'ä' => '&auml;',
            'Ä' => '&Auml;',
            'ö' => '&ouml;',
            'Ö' => '&Ouml;',
            'ü' => '&uuml;',
            'Ü' => '&Uuml;',
            'ß' => '&szlig;'
        );

        foreach($holder as $chr => $enco){
            $str = str_replace($chr,$enco,$str);
        }
        return $str;
    }

    private function fixLoader(){
        /*Remove autoloader from Mite.php*/
        $functions = spl_autoload_functions();
        foreach($functions as $function) {
            spl_autoload_unregister($function);
        }

        require_once APP_ROOT.'/libs/activeRecord/ActiveRecord.php';

        $connections = array(
            'development' => 'mysql://root@127.0.0.1/addl',
            'production' => 'mysql://root@127.0.0.1/addl'
        );

        // initialize ActiveRecord
        ActiveRecord\Config::initialize(function($cfg) use ($connections)
        {
            $cfg->set_model_directory(APP_ROOT.'/models');
            $cfg->set_connections($connections);
        });
    }
}