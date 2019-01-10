<?php

namespace app\modules\approve\controllers;

use yii\web\Controller;
use Yii;
use app\models\Organization;
use Mypdf;

class CommonController extends Controller
{
    public $pdf_title;

    public function beforeAction($action)
    {
        //1.0 先验证是否已经登录
        if (Yii::$app->approvr_user->isGuest)
        {
            $this->redirect(['/approve/login/login']);
            Yii::$app->end();
        }
        else
        {
            $organizationName = Organization::find()->select('name')->where(['id' => Yii::$app->approvr_user->identity->belong])->scalar();
            $this->view->params['organizationName'] = $organizationName;
        }
        return true;
    }
    
    /**
     * [pdf pdf导出]
     * @param  string $html 样式内容
     * @return string
     */
    public function pdf($html=''){
        // create new PDF document
        $pdf = new mypdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('XLH');
        $pdf->SetTitle($this->pdf_title);
        $pdf->SetSubject('Tutorial');
        $pdf->SetKeywords('PDF');
        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        // remove default footer
        $pdf->setPrintFooter(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // ---------------------------------------------------------
        // set font
        $pdf->SetFont('stsongstdlight', '', 14, '', true);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output(date('YmdHis').rand(1111, 9999).'.pdf', 'I');
    }

    /**
     * ajax上传函数
     * @param string $folder 上传到文件夹下
     * @param int $pid 产品ID
     * @param array $allowed_types 允许的文件类型
     * @param int $max_size 允许上传文件的最大值，默认为1M（1024000bytes）
     * @return json数据
     */
    public function ajax_upload_do($folder, $pid = 0, $allowed_types = ['gif', 'jpg', 'png'], $max_size = 2024000){
        set_time_limit(0);
        file_exists($folder) OR mkdir($folder, 0755, TRUE);
        if (empty($_FILES['file']))
        {
            $arr = ['code' => '20001', 'error' => '文件加载异常,上传失败!'];
            return json_encode($arr);
        }
        $filename = $_FILES['file']['name']; //文件名
        $filesize = $_FILES['file']['size']; //文件大小
        $filedate = date('Y-m-d', time());
        if ($filename != "")
        {
            if ($filesize > $max_size)
            {
                $arr = ['code' => '20001', 'error' => '您上传的附件大小超出限制请重新上传!'];
                return json_encode($arr);
            }
            $upload_filetype = $this->getFileExt($filename); //获取文件类型名
            if (empty($upload_filetype) || !in_array($upload_filetype, $allowed_types))
            {
                $arr = ['code' => '20001', 'error' => '您上传的附件不符合格式请重新上传！'];
                return json_encode($arr);
            }
        }
        $files = $pid . '_' . time() . '.' . $upload_filetype;
        //上传路径
        $file_path = $folder . $files;
        move_uploaded_file($_FILES['file']['tmp_name'], iconv("UTF-8", "gb2312", $file_path));
        @chmod($file_path, 0777);
        $size = round($filesize / 1024, 2);
        $arr  = [
            'code' => '20000',
            'success' => [
                'name' => $files,
                'type' => $pid,
                'date' => $filedate,
                'size' => $size,
                'url'  => $file_path
            ]
        ];
        return json_encode($arr);
    }

    /**
     * 获取文件扩展名
     * @param String $filename 要获取文件名的文件
     * @return string
     */
    public function getFileExt($filename){
        $info = pathinfo($filename);
        return $info["extension"];
    }

    /**
     * [getModelError 获取自动验证错误信息]
     * @param  [resource] $model [模型资源]
     * @return [array]           [错误信息]
     */
    public function getModelError($model=null){
        $arr = [];
        if(!empty($model)){
            $errors = $model->firstErrors;
            if(!empty($errors)){
                $i  = 0;
                foreach($errors as $k => $v){
                    if($i == 0) {
                        $arr['key'] = $k;
                        $arr['val'] = $v;
                    }
                    $i++;
                }
            }
        }
        return $arr;
    }
}
