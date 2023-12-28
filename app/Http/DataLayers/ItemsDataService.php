<?php

namespace App\Http\DataLayers;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Thickness;

class ItemsDataService {

    // Category Data Service Start
        public function GetAllCategoryRecordsForDropdownlist(){

            return Category::get();
        }
        
        public function GetAllActiveCategoryRecords(){

        return Category::where('CateStatus',true)->orderBy('CateId','DESC')->get();
    
        }

        public function storeCategory($data)
        {
            return Category::insertGetId($data);
        }

        public function getTargetCategoryToEdit($id){
            
            return Category::where('CateStatus',true)->where('CateId',$id)->firstOrFail();
        }

        public function updateCategory($id, $data)
        {
            return Category::where('CateStatus',true)->where('CateId',$id)->update($data);
        }

        public function deleteCategory($id){
            
            return Category::where('CateStatus',true)->where('CateId',$id)->delete();
        }

    // Category Data Service End

    // Brand Data service Start
        public function GetAllBrandForDropdownlist($id, $allBrand){

            return $allBrand->where('BranId', $id)->firstOrFail();
        }

        public function getAllActiveBrandRecords(){

            return Brand::with('cateInfo')->where('BranStatus', true)->orderBy('BranId', 'DESC')->get();
    
        }

        public function checkExistBrand($CateId, $BranName)
        {
            return Brand::where('CateId', $CateId)->where('BranName', $BranName)->count();
        }

        public function storeBrand($data)
        {
            return Brand::insertGetId($data);
        }

        public function getTargetBrandToEdit($id){
            
            return Brand::where('BranStatus',true)->where('BranId',$id)->firstOrFail();
        }

        public function updateBrand($id, $data)
        {
            return Brand::where('BranStatus',true)->where('BranId',$id)->update($data);
        }

        public function deleteBrand($id){
            
            return Brand::where('BranStatus',true)->where('BranId',$id)->delete();
        }
    // Brand Data service End
    
    // Size Data Service Start

        public function getAllActiveSizeRecords(){

            return Size::with('cateInfo', 'brandInfo')->where('SizeStatus', true)->orderBy('SizeId', 'DESC')->get();
    
        }

        public function checkExistSize($CateId, $BranId, $SizeName)
        {
            return Size::where('CateId', $CateId)->where('BranId', $BranId)->where('SizeName', $SizeName)->count();
        }

        public function storeSize($data)
        {
            return Size::insertGetId($data);
        }

        public function getSizeDataEdit($id, $allSize){

            return $allSize->where('SizeId', $id)->firstOrFail();
        }

        public function getTargetSizeToEdit($id){
            
            return Size::where('SizeStatus',true)->where('SizeId',$id)->firstOrFail();
        }

        public function updateSize($id, $data)
        {
            return Size::where('SizeStatus',true)->where('SizeId',$id)->update($data);
        }

        public function deleteSize($id){
            
            return Size::where('SizeStatus',true)->where('SizeId',$id)->delete();
        }
    // Size Data Service End

    // Thikness Data Service Start

        public function GetAllThiknessForDropdownlist($id, $allThickness){

            return $allThickness->where('ThicId', $id)->firstOrFail();
        }

        public function getAllActiveThicknessRecords(){

            return Thickness::with('cateInfo', 'brandInfo', 'sizeInfo')->where('ThicStatus', true)->orderBy('ThicId', 'DESC')->get();
        }

        public function checkExistThickness($CateId, $BranId, $SizeId, $ThicName)
        {
            return Thickness::where('CateId', $CateId)->where('BranId', $BranId)->where('SizeId', $SizeId)->where('ThicName', $ThicName)->count();
        }

        public function storeThickness($data)
        {
            return Thickness::insertGetId($data);
        }

        public function getTargetThicknessToEdit($id){
            
            return Thickness::where('ThicStatus',true)->where('ThicId',$id)->firstOrFail();
        }

        public function updateThickness($id, $data)
        {
            return Thickness::where('ThicStatus',true)->where('ThicId',$id)->update($data);
        }

        public function deleteThickness($id){
            
            return Thickness::where('ThicStatus',true)->where('ThicId',$id)->delete();
        }
    // Thikness Data Service End

}