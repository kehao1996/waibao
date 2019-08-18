<?php




$update_z_file = 'update';
$update_zi_file = date('Y-m-d');

$type_ary = [
    'image/gif',
    'image/jpeg',
    'image/pjpeg'
];

$update = $_FILES['uploads'];
if(!empty($update)){
    $img_url = [];
    if(!empty($update['tmp_name'])){
        foreach($update['tmp_name'] as $k=>$v){
            if(!in_array($update['type'][$k],$type_ary)){
                exit(
                    json_encode([
                        'Status' => 201,
                        'Msg' => '图片类型不支持，上传失败'
                    ])
                );
            }


            $hz = ltrim($update['type'][$k],'image/');
            if(empty($hz)){
                $hz = 'png';
            }
            $file_name = md5(time().mt_rand(1,100)) . '.' . $hz;

            if(!file_exists($update_z_file)){
                @mkdir($update_z_file);
            }

            if(!file_exists($update_z_file . '/' . $update_zi_file)){
                @mkdir($update_z_file . '/' . $update_zi_file);
            }

            $mb_file = $update_z_file . '/' . $update_zi_file . '/' . $file_name;

            $status = move_uploaded_file($v,$mb_file);
            $img_url[] = $mb_file;
        }
    }
    $udate_file = '';
    if(!empty($img_url)){
        $udate_file = implode(';',$img_url);
    }
    exit(json_encode([
        'Status' => 200,
        'update' => $udate_file
    ]));

}
exit(json_encode([
    'Status' => 200,
    'update' => ''
]));
p($update);
/*
 *print_r 数据数组
*/


function p($data)
{
    echo "<pre style='padding: 15px;background: #ccc;border-radius: 6px'>";
    if (is_null($data)) {
        var_dump($data);
    } elseif (is_bool($data)) {
        var_dump($data);
    } else {
        print_r($data);
    }
    echo '</pre>';
}