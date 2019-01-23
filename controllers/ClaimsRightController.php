<?php

namespace app\controllers;

use app\controllers\CheckController;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\ProjectInfo;
use app\models\Guarantee;
use app\models\Region;
use app\models\Industry;

class ClaimsRightController extends CheckController
{

    /**
     * 债权融资项目
     */
    public function actionList()
    {

        return $this->render('list');
    }

    /**
     * 添加债权融资项目
     */
    public function actionAdd()
    {
        $model = new ProjectInfo;
        if (Yii::$app->request->isPost)
        {
            $post = Yii::$app->request->post();
            if ($model->add($post))
            {
                return $this->redirect(['call/mess', 'mess' => '债权融资项目发布成功']);
            }
        }
        $choice = ['' => '请选择'];
        # 贷款用途
        $loans_usage = Yii::$app->params['loans_usage'];
        $loans_usage = ArrayHelper::map($loans_usage, 'id', 'name');
        $loans_usage = $choice + $loans_usage;
        # 担保方式
        // 1.0一级担保
        $guarantee_bid = Guarantee::getList(['top_id' => 0]);
        $guarantee_bid = ArrayHelper::map($guarantee_bid, 'id', 'name');
        $guarantee_bid = $choice + $guarantee_bid;
        // 2.0二级担保
        $guarantee_mid = $choice;
        // 3.0三级担保
        $guarantee_sid = $choice;
        # 地区
        // 1.0一级地区
        $region_bid = Region::getList(['type' => 1]);
        $region_bid = ArrayHelper::map($region_bid, 'id', 'name');
        $region_bid = $choice + $region_bid;
        // 2.0二级地区
        $region_mid = $choice;
        // 3.0三级地区
        $region_sid = $choice;
        # 所属行业
        $company_industry = Industry::getList(['level' => 1]);
        $company_industry = ArrayHelper::map($company_industry, 'id', 'name');
        $company_industry = $choice + $company_industry;
        return $this->render('add', [
                    'model' => $model, 'loans_usage' => $loans_usage,
                    'guarantee_bid' => $guarantee_bid, 'guarantee_mid' => $guarantee_mid, 'guarantee_sid' => $guarantee_sid,
                    'region_bid' => $region_bid, 'region_mid' => $region_mid, 'region_sid' => $region_sid,
                    'company_industry' => $company_industry
        ]);
    }

    /**
     * AJAX获取担保
     */
    public function actionAjaxGetGuarantee()
    {
        $level = Yii::$app->request->post('level');
        $top_id = Yii::$app->request->post('top_id');
        $list = Guarantee::getList(['top_id' => $top_id, 'level' => $level]);
        return json_encode($list);
    }

    /**
     * AJAX获取地区
     */
    public function actionAjaxGetRegion()
    {
        $type = Yii::$app->request->post('type');
        $parent_id = Yii::$app->request->post('parent_id');
        $list = Region::getList(['parent_id' => $parent_id, 'type' => $type]);
        return json_encode($list);
    }

    public function actionAjaxUploadFiles()
    {
        $system = Yii::$app->request->post('system');
        $type = Yii::$app->request->post('type');
        if ($type == 'license')
        {
            $allowed_types = ['jpg', 'jpeg', 'pdf', 'JPG', 'JPEG', 'PDF', 'PNG', 'png'];
            $max_size = 10240000; //10M
        }
        if ($type == 'project')
        {
            $allowed_types = ['jpg', 'jpeg', 'JPG', 'JPEG', 'PNG', 'png', 'gif', 'GIF'];
            $max_size = 10240000; //10M
        }
        if ($type == 'prospectus')
        {
            $allowed_types = ['pdf', 'ppt', 'pptx'];
            $max_size = 10240000; //10M
        }
        $uploan_url = 'upfile/wx/' . date('Ymd') . '/';
        $result = $this->ajax_upload_do($uploan_url, $type, $allowed_types, $max_size);
        return $result;
    }

    /**
     * ajax上传函数
     * @param string $folder 上传到文件夹下
     * @param int $pid 产品ID
     * @param array $allowed_types 允许的文件类型
     * @param int $max_size 允许上传文件的最大值，默认为1M（1024000bytes）
     * @return json数据
     */
    function ajax_upload_do($folder, $pid = 0, $allowed_types = ['gif', 'jpg', 'png'], $max_size = 2024000)
    {
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
        $arr = [
            'code' => '20000',
            'success' => [
                'name' => $files,
                'type' => $pid,
                'date' => $filedate,
                'size' => $size,
                'url' => $file_path
            ]
        ];
        return json_encode($arr);
    }

    /**
     * 获取文件扩展名
     * @param String $filename 要获取文件名的文件
     * @return string
     */
    function getFileExt($filename)
    {
        $info = pathinfo($filename);
        return $info["extension"];
    }

}
