<?php
function cutOf($string, $len, $type = false) {
    if (strlen($string) > $len) {
        if ($type == false) {
            $t1 = substr($string, 0, $len);
            $t2 = substr($string, $len, strlen($string));
            $t2 = str_replace(strstr($t2, " "), "...", $t2);
            return $t1 . $t2;
        } else {
            $t1 = substr($string, 0, $len);
            return $t1 . "...";
        }
    }
    else
        return $string;
}
function showDate($time) {
    $day = '\\n\g\à\y';
    $string = date("D, $day d/m/Y", $time);
    $arr = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    $arr2 = array('Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật');
    $string = str_replace($arr, $arr2, $string);
    return $string;
}
function showTime($time) {
    if (time() - $time < 3)
        $string = 'vài giây trước';
    elseif (time() - $time < 60)
        $string = round(time() - $time).' giây trước';
    elseif (time() - $time < 3600)
        $string = round((time() - $time) / 60) . ' phút trước';
    elseif (time() - $time < 86400)
        $string = round((time() - $time) / 3600) . ' giờ trước';
    elseif (time() - $time < 172800)
        $string = date("H:i", $time) . ' hôm qua';
    else {
        $string = date("H:i d/m/Y", $time);
    }
    return $string;
}
function getURL($slug) {
    $url = URL . '/' . $slug . '/.html';
    return $url;
}
function showCategories($categories, $parent_id = 0, $char = '',$category_check = null)
{
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
    if ($cate_child)
    {
        if (isset($category_check) && count($category_check) > 0)
        {
            echo '<ul id="example">';
            foreach ($cate_child as $key => $item)
            {
                if (in_array($item['id'],$category_check))
                {
                    echo '<li><input type="checkbox" checked value="'.$item['id'].'" name="category[]" />'.$item['name'];
                }
                else
                {
                    echo '<li><input type="checkbox"  value="'.$item['id'].'" name="category[]" />'.$item['name'];
                }
                showCategories($categories, $item['id'], $char.'|---',$category_check);
                echo '</li>';
            }
            echo '</ul>';
        }
        else
        {
            echo '<ul id="example">';
            foreach ($cate_child as $key => $item)
            {
                echo '<li><input id="category" type="checkbox" value="'.$item['id'].'" name="category[]" />'.$item['name'];

                showCategories($categories, $item['id'], $char.'|---');
                echo '</li>';
            }
            echo '</ul>';
        }
    }


}
function showCategoriesType($categories, $parent_id = 0, $char = '',$category_check = null)
{
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item['parent_id'] == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
    if ($cate_child)
    {
        if (isset($category_check) && count($category_check) > 0)
        {
            echo '<ul>';
            foreach ($cate_child as $key => $item)
            {
                if (in_array($item['id'],$category_check))
                {
                    echo '<li><input type="checkbox" checked value="'.$item['id'].'" name="category[]" />'.$item['name'];
                }
                else
                {
                    echo '<li><input type="checkbox"  value="'.$item['id'].'" name="category[]" />'.$item['name'];
                }
                showCategoriesType($categories, $item['id'], $char.'|---',$category_check);
                echo '</li>';
            }
            echo '</ul>';
        }
        else
        {
            echo '<ul id="example">';
            foreach ($cate_child as $key => $item)
            {
                echo '<li><input id="category" type="checkbox" value="'.$item['id'].'" name="category[]" />'.$item['name'];

                showCategoriesType($categories, $item['id'], $char.'|---');
                echo '</li>';
            }
            echo '</ul>';
        }
    }


}
function getThumb($thumb, $width=null, $height=null) {
    if (isset($thumb))
    {
        return str_replace("s0","w".$width."-h".$height."-c",$thumb);
    }
}
function getImage($id)
{
    if (isset($id))
    {
        $url="https://drive.google.com/thumbnail?sz=s0&id=$id";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $a = curl_exec($ch);
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    }
    return $url;
}
