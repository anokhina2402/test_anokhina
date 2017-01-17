<?php

/** class of add comment controller **/
class Controller_Add extends Controller
{

    function __construct()
    {
        $this->model = new Model_comment();
        $this->view = new View();
    }

    /**
     * method for check admin
     */

    function action_index()
    {

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comment'])) {
            $file_name = '';
            if (isset($_FILES['file']) && $_FILES['file']['name']) {
                $file_name = $this->genFileName();
            }
            $id = $this->model->insertComment(array(
                    Model_comment::COMMENTS_COLUMN_NAME => $_POST['name'],
                    Model_comment::COMMENTS_COLUMN_EMAIL => $_POST['email'],
                    Model_comment::COMMENTS_COLUMN_COMMENT => $_POST['comment'],
                    Model_comment::COMMENTS_COLUMN_DATE_ADD => date('Y-m-d H:i:s'),
                    Model_comment::COMMENTS_COLUMN_FLAG => 0,
                    Model_comment::COMMENTS_COLUMN_MODIFIED => 0,
                    Model_comment::COMMENTS_COLUMN_PHOTO => $file_name)

            );

            /** upload photo **/

            if (isset($_FILES['file']) && $_FILES['file']['name']) {
                if (!is_dir(PREFIX_UPLOADDIR)) {
                    mkdir(PREFIX_UPLOADDIR, 0777, true);
                }

                $uploadfile = PREFIX_UPLOADDIR . '/' . $file_name;
                move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
                $img_hw = getimagesize($uploadfile);

                /** resize photo **/

                if ($img_hw[0] > $img_hw[1]) {
                    $this->imageresize($uploadfile, $uploadfile, 320, 240, 75);
                } else {
                    $this->imageresize($uploadfile, $uploadfile, 240, 230, 75);
                }

            }
            $data["add_status"] = 'success_add';
        } else {
            $data["add_status"] = 'error_add';
        }

        $data['data'] = $this->model->getDataGuest(0);
        $this->view->generate('main_view.php', 'template_view.php', $data);


    }

    /**
     * method for resize image
     * @param $outfile - output file
     * @param $infile - input file
     * @param $neww - new width
     * @param $newh - new height
     * @param $quality - photo quality
     */

    function imageresize($outfile, $infile, $neww, $newh, $quality)
    {
        $im = imagecreatefromjpeg($infile);
        $k1 = $neww / imagesx($im);
        $k2 = $newh / imagesy($im);
        $k = $k1 > $k2 ? $k2 : $k1;

        $w = intval(imagesx($im) * $k);
        $h = intval(imagesy($im) * $k);

        $im1 = imagecreatetruecolor($w, $h);
        imagecopyresampled($im1, $im, 0, 0, 0, 0, $w, $h, imagesx($im), imagesy($im));

        imagejpeg($im1, $outfile, $quality);
        imagedestroy($im);
        imagedestroy($im1);
    }

    /**
     * method for generate random file name
     * @param $length - count of letter
     * @return string - new file name
     */
    function genFileName($length = 8)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }


}
