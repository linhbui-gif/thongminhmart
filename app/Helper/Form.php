<?php

namespace App\Helper;
class Form {

    public static function show($arr, $item_model){
        $html = '';
        foreach($arr as $k => $item){
            $data['item'] = $item;
            $data['item_model'] = $item_model;
            switch ($item['type']){
                case "select_recusive";
                    $html .= view("admin.template.form.select_recusive")->with($data)->render();
                    break;
                case "text";
                    $html .= view("admin.template.form.input_text")->with($data)->render();
                    break;
                case "float";
                    $html .= view("admin.template.form.input_float")->with($data)->render();
                    break;
                case "number";
                    $html .= view("admin.template.form.input_number")->with($data)->render();
                    break;
                case "email";
                    $html .= view("admin.template.form.input_email")->with($data)->render();
                    break;
                case "status";
                    $html .= view("admin.template.form.status")->with($data)->render();
                    break;
                case "password";
                    $html .= view("admin.template.form.password")->with($data)->render();
                    break;
                case "checkbox";
                    $html .= view("admin.template.form.checkbox")->with($data)->render();
                    break;
                case "file";
                    $html .= view("admin.template.form.file")->with($data)->render();
                    break;
                case "file_from_url";
                    $html .= view("admin.template.form.file_from_url")->with($data)->render();
                    break;
                case "file_multi";
                    $html .= view("admin.template.form.file_multi")->with($data)->render();
                    break;
                case "ckeditor";
                    $html .= view("admin.template.form.ckeditor")->with($data)->render();
                    break;
                case "select2";
                    $html .= view("admin.template.form.select2")->with($data)->render();
                    break;
                case "select";
                    $html .= view("admin.template.form.select")->with($data)->render();
                    break;
                case "select_multi";
                    $html .= view("admin.template.form.select_multi")->with($data)->render();
                    break;
                case "slug";
                    $html .= view("admin.template.form.slug")->with($data)->render();
                    break;
                case "tag";
                    $html .= view("admin.template.form.tag")->with($data)->render();
                    break;
                case "textarea";
                    $html .= view("admin.template.form.textarea")->with($data)->render();
                    break;
                case "datepicker";
                    $html .= view("admin.template.form.datepicker")->with($data)->render();
                    break;
                case "gallery";
                    $html .= view("admin.template.form.gallery")->with($data)->render();
                    break;
                case "custom_coupon_course";
                    $html .= view("admin.template.form.custom_coupon_course")->with($data)->render();
                    break;

            }
        }
        return $html;
    }


}



?>
