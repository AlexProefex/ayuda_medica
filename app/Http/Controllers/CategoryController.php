<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Category\CategoryObject;
use App\Http\Resources\Category\CategoryResource;
use App\Rules\CategoryValidation;
//use App\Traits\ConsultoryPricesTrait;

class CategoryController extends BaseController
{

    public function index()
    {
      $category = Category::select(
        'idCategory',
        'name')
      ->get();
      if(is_null($category))
        return $this->responseMessage('not_found','List de Category!',[]);
      return $this->responseMessage('success','List de Category!',CategoryResource::collection($category));
    }


    public function store(Request $request)
    {
        try {
          
            $input = $request->all(); 
    
            $validador = CategoryValidation::validateAttributes($input);
    
            if($validador->valid){
              
              $category = new Category;
              $category->name = $input['name'];
              $category->save();
        
              return $this->responseMessage('success','Category created!', new CategoryObject($category));
            }
            return $this->responseMessage('rules','Campos requeridos',$validador->data);
    
          } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
          } catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Upss ha ocurrido un error inesperado');
          }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::find($id);
      if (is_null($category)) {
        return $this->responseMessage('not_found','Category not found','');
      }
      return $this->responseMessage('success','Category data!',new CategoryObject($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $input = $request->all();  
            $validador = CategoryValidation::validateAttributes($input);
            if($validador->valid){
              $category = Category::find($id);
              $category->name = $input['name'];
              $category->save();
              return $this->responseMessage('success','category actualizada!',new CategoryObject($category));
            }
            return $this->responseMessage('rules','Campos requeridos',$validador->data);
    
          } catch (\Exception $e) {
            return $this->responseMessage('errorTransaction', 'Ha ocurrido un error');
          } catch(\Illuminate\Database\QueryException $e){
            return $this->responseMessage('error', 'Ups ha ocurrido un error inesperado');
          }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
