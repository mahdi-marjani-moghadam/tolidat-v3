<?php
class Uploader
{
    public function uploadImage($property)
    {
        $cropUpload = new CropUploader();
        $cropUpload->uploadImage($property);
    }


}

class CropUploader
{

    private function getFileType($file)
    {
        $data = explode(',', $file);
        $start = strpos($data[0], ':') + 1;
        $end = strpos($data[0], ';');
        $length = $end - $start;
        return substr($data[0], $start, $length);
    }

    public function checkImage($image)
    {
        $fileType = $this->getFileType($image);

        $data = explode('/', $fileType);
        $result['result'] = -1;

        if ($data[0] != 'image') {
            $result['msg'] = 'لوگو باید از نوع عکس باشد';
            return $result;
        }

        if ($data[1] != 'jpg' &  $data[1] != 'png' & $data[1] != 'jpeg') {
            $result['msg'] = 'لوگو باید از نوع png یا jpg یا jpeg باشد';
            return $result;
        }

        $result['result'] = 1;
        return $result;
    }

    public function uploadImage($property)
    {
        $result = $this->checkImage($property['image']);

        if ($result['result'] == -1) {
            return $result;
        }

        $path = $this->getPath($property);

        $i = rand(0, 999999999);
        $image = $i . '_tmp.png';
        $data = explode(',', $property['image']);
        $ifp = fopen($path . $image, "wb");
        $data[1] = str_replace(' ', '+', $data[1]);
        $data[1] = base64_decode($data[1]);
        fwrite($ifp, $data[1]);
        fclose($ifp);
        $result['image'] = $image;
        return $result;
    }

    private function getPath($property)
    {
        if (isset($property['company_id'])) {
            if (!is_dir(COMPANY_ADDRESS_ROOT . $property['company_id'])) {
                mkdir(COMPANY_ADDRESS_ROOT . $property['company_id'], 0777, true);
            }

            if (!is_dir(COMPANY_ADDRESS_ROOT . $property['company_id'] . "/" . $property['folder_name'])) {
                mkdir(COMPANY_ADDRESS_ROOT . $property['company_id'] . "/" . $property['folder_name'], 0777, true);
            }
            $path = COMPANY_ADDRESS_ROOT . $property['company_id'] . "/" . $property['folder_name'] . "/";
        } else {
            if (!is_dir(STATIC_ROOT_DIR . "/images/" . $property['folder_name'])) {
                mkdir(STATIC_ROOT_DIR . "/images/" . $property['folder_name'], 0777, true);
            }
            $path = STATIC_ROOT_DIR . "/images/" . $property['folder_name'] . "/";
        }


        return $path;
    }

}
