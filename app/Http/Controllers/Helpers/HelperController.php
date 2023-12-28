<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use DateTime;
use Carbon\Carbon;

class HelperController extends Controller
{
  public function getTodayDate(){
    return date("Y/m/d");
  }
  // get month name for integer value
  public function getMonthName($monthId)
  {
    $dateObj   = DateTime::createFromFormat('!m', $monthId);
    return $monthName = $dateObj->format('F');
  }

  public function getYear()
  {
    return date('Y');
  }

  public function getNextFirdayDate($day, $month, $year)
  {

    $date = $year . '-' . $month . '-' . $day;
    $date    =  new DateTime($date);
    $day = $date->format('l');  //pass
    return $day;
  }
  public function getNumberOfDaysInMonthAndYear($month, $year)
  {
    // dd($month,$year);
    $noOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    if ($noOfDaysInMonth == null) {
      return 0;
    } else {
      return $noOfDaysInMonth;
    }
  }

  public function countTotalHolidayInThisMonth($month,$year){

    $days = $this->getNumberOfDaysInMonthAndYear($month,$year);
    $holidayArray = array_fill(1, 31, 0);
    $totalHolidays = 0;
    for ($i = 1; $i <= $days; $i++) {
      $date = $year . '-' . $month . '-' . $i;
      $date    =  new DateTime($date);
      $day = $date->format('l');
      if ($day == "Friday") {
        $totalHolidays++;
        $holidayArray[$i] = 1;
      }
    }
    return [$totalHolidays,$holidayArray];

  }
  public function checkThisDayIsFriday($date){

      $date    =  new DateTime($date);
      $day = $date->format('l');
      if ($day == "Friday") {
          return true;
      }
      return  false;

  }



  public function getAllDaysNameInMonth($month,$year){

    $day_name_in_month = array();
    $total_day = $this->getNumberOfDaysInMonthAndYear($month,$year);
    for($c = 1; $c <= $total_day; $c ++){

      $date = $year."-".$month."-".$c;
      $day_name_in_month[$c] =  substr((new DateTime($date))->format('l'),0,2);
    }
    return $day_name_in_month;
  }

  public function getMonthFromDateValue($dateValue)
  {
    if ($dateValue == null) {
      return 0;
    }
    $time = strtotime($dateValue);
    return  $month = (int) date("m", $time);
  }
  public function getCurrentMonthIntValue()
  {

    $time = strtotime(date("Y/m/d"));
    return  $month = (int) date("m", $time);
  }

  public function getYearFromDateValue($dateValue)
  {
    if ($dateValue == null) {
      return 0;
    }
    $time = strtotime($dateValue);
    return $year = (int) date("Y", $time);
  }
  public function getDayFromDateValue($dateValue)
  {
    if ($dateValue == null) {
      return 0;
    }
    $time = strtotime($dateValue);
    return  (int) date("d", $time);
  }

  public function getDayMonthAndYearFromDateValue($dateValue)
  {
    if ($dateValue == null || $dateValue == "") {
      return [0,0,0];
    }
     $time = strtotime($dateValue);
     $day =  (int) date("d", $time);
     $month =  (int) date("m", $time);
     $year =  (int) date("Y", $time);
     return [$day,$month,$year];
  }

  function getLastDateFromDateValue($a_date){
       return date("Y-m-t", strtotime($a_date));
  }

  function getMonthsInRangeOfDate($startDate, $endDate)
  {
    $months = array();

    while (strtotime($startDate) <= strtotime($endDate)) {
      $months[] = array(
        'year' => (int) date('Y', strtotime($startDate)),
        'month' => (int) date('m', strtotime($startDate)),
      );

      // Set date to 1 so that new month is returned as the month changes.
      $startDate = date('01 M Y', strtotime($startDate . '+ 1 month'));
    }

    return $months;
  }


  function getListOfMonthInRangeOfTwoDate($startDate, $endDate)
  {
    $months = array();
    $counter =0;

    while (strtotime($startDate) <= strtotime($endDate)) {

        $months[$counter++] =  (int) date('m', strtotime($startDate));
      // Set date to 1 so that new month is returned as the month changes.
      $startDate = date('01 M Y', strtotime($startDate . '+ 1 month'));
    }

    return $months;
  }





  // File Extension Check
public function checkUploadedFileProperties($extension, $fileSize)
{
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 5242888; // Uploaded file size limit is 5mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
                return true;
            } else {
                 return false;
            }
        } else {
           return false;
        }
}





}
