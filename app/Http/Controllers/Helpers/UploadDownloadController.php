<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\File;


class UploadDownloadController //extends Controller
{


  public function uploadCustomerProfilePhoto($file,$oldFilePath)
  {
    if($file == null)
    return null;
    $appoint_name = 'p-' . time() . '.' . $file->getClientOriginalExtension();
    $destinationPath = "uploads/cust/";
    $uploadPath =  $destinationPath . $appoint_name;

    $file->move($destinationPath, $appoint_name);
    if($oldFilePath != null && $oldFilePath != "" && File::exists($oldFilePath))
    {  unlink($oldFilePath);}

   return $uploadPath;

  }


    public function deleteItemReceivedPaper($oldFilePath)
    {
        if($oldFilePath != null && $oldFilePath != "" && File::exists($oldFilePath))
        {  unlink($oldFilePath);}
    }




}



