<?php
/**
 * Utility class file
 *
 * Contains many function that most used
 */

class Utility
{

    /*
    * Return setting template with typePage: public, admin_sweeto or back_office
    */
    public static function getCurrentTemplate($typePage)
    {
        $model = Templates::model()->find(array(
            'select' => 'template, layout',
            'condition' => 'group_page = :g AND default_theme = "1"',
            'params' => array(':g' => $typePage)
        ));
        if ($model != null) {
            return array('template' => $model->template, 'layout' => $model->layout);
        }
    }

    /*
    * Return template module
    */
    public static function getTemplateModule($moduleId, $publicControllerActions)
    {
        $currentControllerAction = str_replace("/{$moduleId}/", '', (str_replace(Yii::app()->baseUrl, '', $_SERVER["REQUEST_URI"])));
        $part = explode('/', $currentControllerAction);

        if (in_array($currentControllerAction, $publicControllerActions)) //public group
            $groupPage = 'public';
        else {
            if (!Yii::app()->user->isGuest)
                $groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';
        }

        return $arrThemes = Utility::getCurrentTemplate($groupPage);
    }

    /* Get current action
    @params statik = false, halaman statik tidak dideteksi
    */
    public static function getCurrentAction($statik = false)
    {
        // Get query string (ex: index.php?r=site/page)
        $queriString = Yii::app()->request->queryString;
        $arrParam = '';
        if (!empty($queriString)) {
            $arrParam = explode('&', $queriString);
        }

        $aksi = Yii::app()->controller->id;
        $idAksi = Yii::app()->controller->action->id;
        $currAction = '';
        if ($statik) {
            if ($aksi == 'site' && $idAksi == 'page') {
                $aksiStatik = @explode('=', $arrParam[1]);
                $currAction = $aksiStatik[1];
            }
        } else {
            $currAction = $aksi;
        }

        if (!empty($currAction))
            return $currAction;
        else
            return false;
    }

    // Include Status (Checked/No Checked)
	public static function getTimThumb($src, $width, $height, $zoom) {
		$image = Yii::app()->request->baseUrl.'/timthumb.php?src='.$src.'&h='.$height.'&w='.$width.'&zc='.$zoom;
        return $image;
    }

    /*
    Mengembalikan nama hari dalam bahasa indonesia.
    @params short=true, tampilkan dalam 3 huruf, JUM, SAB
    */
    public static function getLocalDayName($dayName, $short = true)
    {
        switch ($dayName) {
            case 0:
                return ($short ? 'MIN' : 'Minggu');
                break;

            case 1:
                return ($short ? 'SEN' : 'Senin');
                break;

            case 2:
                return ($short ? 'SEL' : 'Selasa');
                break;

            case 3:
                return ($short ? 'RAB' : 'Rabu');
                break;

            case 4:
                return ($short ? 'KAM' : 'Kamis');
                break;

            case 5:
                return ($short ? 'JUM' : 'Jumat');
                break;

            case 6:
                return ($short ? 'SAB' : 'Sabtu');
                break;
        }
    }

    /* Ubah bulan angka ke nama bulan */
    public static function monthInt2Name($month, $shortMonthName = false)
    {
        if (empty($month))
            return false;

        $bulan = array(
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
            'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'
        );

        $shortBulan = array(
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul',
            'Agu', 'Sep', 'Okt', 'Nop', 'Des'
        );

        if ($shortMonthName == true)
            return $shortBulan[$month - 1];
        else
            return $bulan[$month - 1];
    }


    /* Fungsi untuk mengubah angka tahun dan bulan ke nama
    @params $waktu = tahun dan bulan (2010-10)
    $shortMonth = true nama bulan di singkat, false nama bulan penuh.
    */
    public static function ubahKeBulanTahun($waktu, $shortMonth = false)
    {
        $waktu = explode('-', $waktu);
        return Utility::monthInt2Name($waktu[1], $shortMonth) . " " . $waktu[0];
    }


    public static function getYmStatus($yahooid, $altOn, $altOff)
    {
        $buka = fopen('http://opi.yahoo.com/online?u=' . $yahooid . '&m=t', 'r')
            or die
        ('<img src="http://opi.yahoo.com/online?u=' . $yahooid . '&m=g&t=2"/>');
        while ($baca = fread($buka, 2048)) {
            $status = $baca;
        }
        fclose($buka);

        if ($status == $yahooid . ' is ONLINE') {
            //$data ='<a href="ymsgr:sendim?'.$yahooid.'" title="'.$altOn.'" > <img src="'.Yii::app()->request->baseUrl.'/images/resource/ym_online.png"  alt="'.$altOn.'"/></a>';
            $data = '<span><a href="ymsgr:sendim?' . $yahooid . '" title="' . $altOn . '">SUPPORT1</a></span>';
        } else {
            //$data =' <a href="ymsgr:sendim?'.$yahooid.'" title="'.$altOff.'"> <img src="'.Yii::app()->request->baseUrl.'/images/resource/ym_sleep.png"  alt="'.$altOff.'"/></a>';
            $data = '<span class="chat-off"><a href="ymsgr:sendim?' . $yahooid . '" title="' . $altOff . '">SUPPORT2</a></span>';
        }

        return $data;
    }


    /*fungsi untuk memotong text yg panjang*/
    public static function shortText($var, $len = 60, $txt_titik = "...")
    {
        if (strlen($var) < $len) {
            return $var;
        }
        if (preg_match("/(.{1,$len})\s/", $var, $match)) {
            return $match [1] . $txt_titik;
        } else {
            return substr($var, 0, $len) . $txt_titik;
        }
    }


    // Get kata berdasarkan jumlah kata sejumlah $number.
    public static function getContentByWord($string, $number = 2)
    {
        if (strlen($isi) < $max) {
            return $isi;
        } else {
            $kata = trim($string);
            $kata = explode(' ', $kata);
            $result = '';
            for ($i = 0; $i < 2; $i++) {
                $result .= $kata[$i];
            }
            return trim($result);
        }
    }

    public static function registerJsFile($jsFile, $posisi)
    {
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($jsFile, $posisi);
    }

    public static function clickable_link($text = '')
    {
        $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $text);
        $ret = ' ' . $text;
        $ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
        $ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
        $ret = substr($ret, 1);
        return $ret;
    }

    /* Mendapatkan max id dari suatu tabel.
       @params string $namaTabel
       @params string $namaId
       @return integer max id. false jika data tidak ditemukan.
       Example: Utility::getMaxId('user', 'id_user');
    */
    public static function getMaxId($namaTabel, $namaId)
    {
        $conn = Yii::app()->db;
        $sql = "SELECT IFNULL(MAX($namaId)+1, 1) AS id FROM $namaTabel";
        $command = $conn->createCommand($sql);
        $result = $command->queryColumn();

        if (count($result) > 0)
            return $result[0];
        else
            return false;
    }


    //change time(H:i:s) to second
    public static function time_to_sec($time)
    {
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    /**
     * Provide style for success message
     *
     * @param mixed $msg
     */
    public static function flashSuccess($msg)
    {
        $result = '<div class="errorSummary success"><p>';
        $result .= $msg . '</p></div>';
        return $result;
    }

    /**
     * Provide style for error message
     *
     * @param mixed $msg
     */
    public static function flashError($msg)
    {
        if ($msg != '') {
            $result = '<div class="errorSummary"><p>';
            $result .= $msg . '</p></div>';
        }
        return $result;
    }


    // Delete folder beserta seluruh isinya.

    public static function deleteFolder($path)
    {
        if (file_exists($path)) {
            $fh = dir($path);
            while (false !== ($files = $fh->read())) {
                @unlink($fh->path . '/' . $files);
            }
            $fh->close();
            @rmdir($path);
            return true;

        } else
            return false;
    }

    public static function removeNewLine($str)
    {
        $pattern = '/\n|\r|\n\r/i';
        $replace = ' ';
        return preg_replace($pattern, $replace, trim($str));
    }

    //cek ukuran file dalam kb
    public static function getSizeFile($ukuranFile)
    {
        if ($ukuranFile > 1024)
            return round($ukuranFile / 1024, 2);
        else
            $ukuranFile;

    }

    //sent email function
    public static function sentEmail($setFromEmail, $setFromName, $emailDestination, $nameDestination, $subject, $msg,
                                     $cc = null)
    {
        Yii::import('ext.jphpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        if($_SERVER["HTTP_HOST"] == 'localhost' || $_SERVER['SERVER_ADDR'] == '192.168.1.250') { //in localhost or testing condition
            //smtp google
            $mail->IsSMTP();
            $mail->SMTPSecure = "ssl";
            $mail->SMTPAuth = true; // enable SMTP authentication
            $mail->Host = "smtp.gmail.com"; // sets the SMTP server
            $mail->Port = 465; // set the SMTP port for the GMAIL server
            $mail->Username = "swevelmail"; // SMTP account username
            $mail->Password = "0o9i8u7y6t";
            $mail->SetFrom($setFromEmail, $setFromName);
            $mail->Subject = $subject;
            $mail->MsgHTML($msg);
            //$options  = WebOption::model()->findByPk(1);
            //$emailDestination = $options->email_testing;
            $mail->AddAddress($emailDestination, $nameDestination);
            if ($cc != null && count($cc) > 0) {
                foreach ($cc as $to => $name) {
                    $mail->AddAddress($to, $name);
                }
            }

        } else {
            //live server
            $mail->IsMail();
            $mail->SetFrom($setFromEmail, $setFromName);
            $mail->Subject = $subject;
            $mail->MsgHTML($msg);
            $mail->AddAddress($emailDestination, $nameDestination);
            if ($cc != null && count($cc) > 0) {
                foreach ($cc as $to => $name) {
                    $mail->AddAddress($to, $name);
                }
            }
        }

        //	file_put_contents('assets/cek_email.html', $msg);

        if ($_SERVER["HTTP_HOST"] == 'localhost') {
            $file = fopen('assets/localhost_email_' . $emailDestination . '.html', 'w+');
            fwrite($file, $msg);
            fclose($file);
            return true;
        } else {
            if ($mail->Send())
                return true;
            else
                return false;
        }
    }


    /**
     * Convert nominal to rupiah currency
     *
     * @input int nominal
     * @access public
     * @return sting
     */
    public static function rupiah($nominal)
    {
        $rupiah = number_format($nominal, 0, ",", ".");
        $rupiah = "Rp " . $rupiah . ",00";
        return $rupiah;
    }

    /**
     * Convert nominal to eye catching format
     */
    function numberFormat($nominal)
    {
        return number_format($nominal, 0, ",", ".");
    }

    /**
     * Get page range from pages object
     *
     * @param integer $maxButtonCount number of button per page
     * @param pagination object $pages
     * @return array page range
     */
    public static function getPageRange($maxButtonCount, &$pages)
    {
        $currentPage = $pages->currentPage;
        $pageCount = $pages->pageCount;

        $beginPage = max(0, $currentPage - (int)($maxButtonCount / 2));
        if (($endPage = $beginPage + $maxButtonCount - 1) >= $pageCount) {
            $endPage = $pageCount - 1;
            $beginPage = max(0, $endPage - $maxButtonCount + 1);
        }
        return array($beginPage, $endPage);
    }

    /**
     * Register script file with duplicate check.
     *
     * @param string $url url script
     * @param integer position of script.
     */
    public static function safeRegisterScriptFile($url, $position = 0)
    {
        $cs = Yii::app()->getClientScript();
        if (!$cs->isScriptFileRegistered($url, $position)) {
            $cs->registerScriptFile($url, $position);
        }
    }

    /**
     * Refer layout path to current applied theme.
     *
     * @param object $module that currently active [optional]
     * @return void
     */
    public static function applyCurrentTheme($module = null)
    {
        $theme = Yii::app()->theme->name;
        Yii::app()->theme = $theme;

        if ($module !== null) {
            $themePath = Yii::getPathOfAlias('webroot.themes.' . $theme . '.views.layouts');
            $module->setLayoutPath($themePath);
        }
    }

    /**
     * Return better uniq id
     */
    public static function getUniqId()
    {
        return md5(uniqid(mt_rand(), true));
    }

    /**
     * Recursively chmod file/folder
     *
     * @param string $path
     * @param octal $fileMode
     */
    public static function chmodr($path, $fileMode)
    {
        if (!is_dir($path))
            return chmod($path, $fileMode);

        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
                $fullpath = $path . '/' . $file;
                if (is_link($fullpath))
                    return false;
                elseif (!is_dir($fullpath) && !@chmod($fullpath, $fileMode))
                    return false; elseif (!self::chmodr($fullpath, $fileMode))
                    return false;
            }
        }
        closedir($dh);

        if (@chmod($path, $fileMode))
            return true;
        else
            return false;
    }

    public static function getEnableList()
    {
        return array(
            1 => 'Ya',
            0 => 'Tidak',
        );
    }

    /**
     * Copy folder include all files
     *
     * @param string $src
     * @param string $dst
     * @return void
     */
    public static function recursiveCopy($src, $dst)
    {
        $dir = opendir($src);
        $pathInfo = pathinfo($dst);
        @chmod($pathInfo['dirname'], 0777);
        @mkdir($dst);
        @chmod($dst, 0777);

        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    Utility::recursiveCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                    @chmod($dst . '/' . $file, 0777);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Delete files and folder recursively
     *
     * @param string $path path of file/folder
     */
    public static function recursiveDelete($path)
    {
        if (is_file($path)) {
            @unlink($path);
        } else {
            $it = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path),
                RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($it as $file) {
                if (in_array($file->getBasename(), array('.', '..'))) {
                    continue;
                } elseif ($file->isDir()) {
                    rmdir($file->getPathname());
                } elseif ($file->isFile() || $file->isLink()) {
                    unlink($file->getPathname());
                }
            }
            rmdir($path);
        }
    }

    /**
     * get image publish/unpublish in gridview admin manage
     * @param int 0/1
     * @return string
     */
    public static function getPublishedToImg($pub)
    {
        if ($pub == 1)
            return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/publish.png', 'published', array('title' => Yii::t('site', 'published')));
        else
            return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/unpublish.png', 'un-published', array('title' => Yii::t('site', 'unpublished')));
    }

    /**
     *    get image publish/unpublish in gridview admin manage
     * @param int 0/1
     * @param string $yes for image title and alt when condition is Published/Tampil/Aktif, dll
     * @param string $No for image title and alt when condition is Unpublished/Tidak Tampil/Tidak Aktif, dll
     * @return string
     */
    public static function getPublishedToImg2($pub, $yes = 'Tampil', $no = 'Tidak Tampil')
    {
        if ($pub == 1)
            return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/publish.png', $yes, array('title' => Yii::t('site', $yes)));
        else
            return CHtml::image(Yii::app()->theme->baseUrl . '/images/icons/unpublish.png', $no, array('title' => Yii::t('site', $no)));
    }

    /**
     * count date diff between two datetimes
     * @param datetime date1
     * @param datetime date2
     * @return int
     */
    public static function dateInterval($date1, $date2)
    {
        $date1 = date('Y-m-d', strtotime($date1));
        $date2 = date('Y-m-d', strtotime($date2));

        $explodeDate1 = explode("-", $date1);
        $date1 = $explodeDate1[2];
        $month1 = $explodeDate1[1];
        $year1 = $explodeDate1[0];

        $explodeDate2 = explode("-", $date2);
        $date2 = $explodeDate2[2];
        $month2 = $explodeDate2[1];
        $year2 = $explodeDate2[0];

        $jd1 = GregorianToJD($month1, $date1, $year1);
        $jd2 = GregorianToJD($month2, $date2, $year2);


        $interval = $jd2 - $jd1;

        return $interval;

    }

    /**
     * count date diff between two datetimes
     * @param datetime date1
     * @param datetime date2
     * @return int
     */
    public static function clearUrl($url)
    {
        $url = trim(strtolower($url));
        $search = array('–', ' ', '.', ':', '(', ')', '&', ',', '/');
        $replace = array('%E2%80%93', '-', '-', '-', '-', '-', '-', '-', '-');
        $cleanUrl = str_replace($search, $replace, $url);
        $cleanUrl = str_replace('--', '-', $cleanUrl);
        if (substr($cleanUrl, -1) == '-')
            $cleanUrl = substr($cleanUrl, 0, -1);

        return $cleanUrl;
    }

    /**
     * count date diff between two datetimes
     * @param datetime date1
     * @param datetime date2
     * @return int
     */
    public static function dateInterval2($date1, $date2)
    {
        $date1 = date('Y-m-d', strtotime($date1));
        $date2 = date('Y-m-d', strtotime($date2));

        $explodeDate1 = explode("-", $date1);
        $date1 = $explodeDate1[2];
        $month1 = $explodeDate1[1];
        $year1 = $explodeDate1[0];

        $explodeDate2 = explode("-", $date2);
        $date2 = $explodeDate2[2];
        $month2 = $explodeDate2[1];
        $year2 = $explodeDate2[0];

        $jd1 = GregorianToJD($month1, $date1, $year1);
        $jd2 = GregorianToJD($month2, $date2, $year2);


        $interval = $jd2 - $jd1;
        if ($interval > 6) {
            $result = $interval % 7;
            if ($result == 0) {
                $result = $interval / 7;
            }
            $value = $result . ' Minggu';
        } else {
            $value = $interval . ' Hari';
        }

        return $value;

    }

    /**
     * @return array of excel column char
     */
    public static function getExcelColumn()
    {
        $excelColumn = array();
        for ($i = 65; $i <= 90; $i++) {
            $excelColumn[] = chr($i);
        }

        for ($i = 0; $i <= 25; $i++) {
            for ($j = 0; $j <= 25; $j++) {
                $excelColumn[] = $excelColumn[$i] . $excelColumn[$j];
            }
        }
        return $excelColumn;
    }


    // IdeaConnect
    public static function loadVideo($videoId)
    {
        $constructString = CHtml::openTag("object", array('type'=>'application/x-shockwave-flash', 'data'=>'http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf', 'width'=>'280', 'height'=>'160'));
        $constructString.= CHtml::tag("param", array('name'=>'movie', 'value'=>'http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf'));
        $constructString.= CHtml::tag("param", array('name'=>'allowFullScreen', 'value'=>'true'));
        $constructString.= CHtml::tag("param", array('name'=>'wmode', 'value'=>'transparent'));
        $constructString.= CHtml::closeTag("object");
        return $constructString;
    }

    public static function wrapWithTextArea($attr)
    {
        $consString = CHtml::openTag("textarea", array('readonly'=>'readonly','rows'=>$attr['rows'], 'cols'=> $attr['cols']));
        $consString.= $attr['value'];
        $consString.= CHtml::closeTag("textarea");
        return $consString;
    }


    public static function getNameParentCategory($id){
        $model=ProjectCategory::model()->findByPk($id);
        return $model->category_name;
    }

    /**
     * Log message to file
     */
    public static function writeLog($msg, $fileName=null) {
        $fname = Yii::app()->runtimePath.($fileName!==null? '/'.$fileName: '/log.txt');
        if(file_exists($fname) === false)
            $fp = file_put_contents($fname, '-');
        else
            $fp = fopen($fname, 'a+');
        @chmod($fname, 0777);
        fwrite($fp, "-------------------------------------------\n", 1024);
        fwrite($fp, "Date: ".date('Y-m-d H:i:s')."\n", 1024);
        fwrite($fp, "{$msg}\n", 1024);
        fclose($fp);
    }    

    /**
     * print_r with pre style
     * 
     * @param mixed $obj
     * @return void
     */
    public static function pr($obj) {
        echo '<pre>';
        print_r($obj);
        echo '</pre>';
    }
}
