<?php

namespace App\Classes;

use App\Models\Setting;
use App\Models\Hidden;

class Common 
{
	function checkAccess($form)
    {
        date_default_timezone_set("Asia/Colombo");
        $now = strtotime(date("Y/m/d H:i:s"));
        if(Setting::where('name', '=', $form)->first() !== null)
        {
            $record = Setting::where('name', '=', $form)->first();
            if((strtotime($record['open']) < $now) & (strtotime($record['close']) > $now))
                return true;
        }
        $result = Hidden::where('name', '=', 'overrideApplication')->first();
        return $result['value'];
    }

    function getName($link)
    {
        switch ($link)
        {
            case 'nursery': return 'Nursery';
            case 'kindergarten': return 'Kindergarten (Grade 1)';
            case 'other': return 'Other Grades';
            case 'grade6' : return 'Grade 6';
            case 'branch': return 'Branch Schools';
            case 'alevels': return 'ALevels';
            case 'london': return 'International ALevels';
        }
    }

    function getLink($name)
    {
        switch ($name)
        {
            case 'Nursery': return 'nursery';
            case 'Kindergarten (Grade 1)': return 'kindergarten';
            case 'Other Grades': return 'other';
            case 'Grade 6': return 'grade6';
            case 'Branch Schools': return 'branch';
            case 'ALevels': return 'alevels';
            case 'International ALevels': return 'london';
        }
    }

    function getYear($section)
    {
        return Setting::where('link', '=', $section)->first()['year'];
    }

    function getDates($section, $grade_sought)
    {
        $year = $this->getYear($this->getlink($section));
        switch ($grade_sought)
        {
            case "Nursery 2+":
                return [($year - 3) . "/02/01", ($year - 2) . "/01/31"];    //2021/02/01 - 2022/01/31
            case "Nursery 3+":
                return [($year - 4) . "/02/01", ($year - 3) . "/01/31"];    //2020/02/01 - 2021/01/31
            case "Nursery 4+":
                return [($year - 5) . "/02/01", ($year - 4) . "/01/31"];    //2019/02/01 - 2020/01/31
            case "Kindergarten (Grade 1)":
                return [($year - 6) . "/02/01", ($year - 5) . "/01/31"];    //2018/02/01 - 2019/01/31
            case "Form 1 (Grade 2)":
                return [($year - 7) . "/02/01", ($year - 6) . "/01/31"];    //2017/02/01 - 2018/01/31
            case "Form 2 (Grade 3)":
                return [($year - 8) . "/02/01", ($year - 7) . "/01/31"];    //2016/02/01 - 2017/01/31
            case "Lower 3 (Grade 4)":
                return [($year - 9) . "/02/01", ($year - 8) . "/01/31"];    //2015/02/01 - 2016/01/31
            case "Upper 3 (Grade 5)":
                return [($year - 10) . "/02/01", ($year - 9) . "/01/31"];   //2014/02/01 - 2015/01/31
            case "Lower 4 (Grade 6)":
                return [($year -11) . "/02/01", ($year - 10) . "/01/31"];   //2013/02/01 - 2014/01/31
            case "Upper 4 (Grade 7)":
                return [($year - 12) . "/02/01", ($year - 11) . "/01/31"];  //2012/02/01 - 2013/01/31
            case "Form 5 (Grade 8)":
                return [($year - 13) . "/02/01", ($year - 12) . "/01/31"];  //2011/02/01 - 2012/01/31
            case "Lower 6 (Grade 9)":
                return [($year - 14) . "/02/01", ($year - 13) . "/01/31"];  //2010/02/01 - 2011/01/31
            case "Middle 6 (Grade 10)":
                return [($year - 15) . "/02/01", ($year - 14) . "/01/31"];  //2009/02/01 - 2010/01/31
            case "A/Levels (Science Stream)":
            case "A/Levels (Commerce and Arts Stream)":
            case "International A/Level":
                return [($year - 17) . "/02/01", ($year - 14) . "/01/31"];
        }
    }
}
