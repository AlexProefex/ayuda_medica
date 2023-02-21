<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait HasFileImage {
	
	//Redonder los numeros a dos decimales 
	public function hasFileImage($request,$model,$type=""){
		if($type!==""){
			//return $this->hasFileImagePut($request,$model);
			return $this->hasFileImagePut($request,$model);
		}
		//return $this->hasFileImageLocalePost($request,$model);
		return $this->hasFileImagePost($request,$model);
	}
	//Crear imagen de un paciente o usuario
	private function hasFileImagePost($request){
		$input = $request->all();
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));  

		if($request->hasFile('avatar')){
			$extension = $request->file('avatar')->guessExtension();
			$nameImage = $input['document_number'].'_'.$lastName.'.'.$extension; 
			$request->file('avatar')->storeAs('',$nameImage ,'google'); 
			$avatar = $nameImage;
		}else{
			$avatar ='default-thumbnail.jpg';
		}
		return $avatar;
	}

	//Remplzar una imagen de un usuario o paciente
	private function hasFileImagePut($request,$model){
		$input = $request->all();
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));  

		if($request->hasFile('avatar')){
			if($model->avatar !== "default-thumbnail.jpg"){
				 Storage::disk('google')->delete($model->avatar); 
			}
			$extension = $request->file('avatar')->guessExtension();
			$nameImage = $input['document_number'].'_'.$lastName.'.'.$extension;
			$request->file('avatar')->storeAs('', $nameImage ,'google'); 
			$model->avatar = $nameImage;
		}
		return $model->avatar;
	}


	private function hasFileImageLocalePost($request,$model){

		$input = $request->all();  
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));  
		//$host = $request->header()['domain'][0];
		//$host = $input['domain'];
		$host = $request->header()['domain'][0];
		//dd(class_basename($model));
		$old = "";
		//return Storage::disk('avatar')->url($host.'/'.Str::lower(class_basename($useradmin)).'/'.$number.'.'.$extension);
		if($request->hasFile('avatar')){
			$extension = $request->file('avatar')->guessExtension();
			$nameImage = $input['document_number'].'_'.$lastName.'.'.$extension; 
			$request->file('avatar')->storeAs($host.'/'.Str::lower(class_basename($model)), $nameImage,'avatar'); 
			$avatar = $nameImage;

		}else{
			$avatar ='default-thumbnail.jpg';
		}
		return ['avatar_new' => $avatar,'avatar_old' => $avatar];
		//return $avatar;
	}


	private function hasFileImageLocalePut($request,$model){

		$input = $request->all();  
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));  
		//$host = $request->header()['domain'][0];
		//$host = $input['domain'];
		$host = $request->header()['domain'][0];
		$old = $model->avatar;
		//return Storage::disk('avatar')->url($host.'/'.Str::lower(class_basename($useradmin)).'/'.$number.'.'.$extension);
		if($request->hasFile('avatar')){

			if($model->avatar !== "default-thumbnail.jpg"){
				Storage::disk('avatar')->move($host.'/'.Str::lower(class_basename($model)).'/'.$model->avatar, $host.'/'.Str::lower(class_basename($model)).'/old/'.$model->avatar);
			}
			//Storage::disk('avatar')->delete($host.'/'.Str::lower(class_basename($model)).'/'.$model->avatar); 
			$extension = $request->file('avatar')->guessExtension();
			$nameImage = $input['document_number'].'_'.$lastName.'.'.$extension; 
			$request->file('avatar')->storeAs($host.'/'.Str::lower(class_basename($model)), $nameImage,'avatar'); 
			$model->avatar = $nameImage;
		}
		return ['avatar_new' => $model->avatar,'avatar_old' => $old];
	}

	public function removeImagePost($request,$model,$avatar){
		$input = $request->all(); 
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));   
		//$host = $input['domain'];
		$host = $request->header()['domain'][0];
		if($avatar['avatar_old'] !== "default-thumbnail.jpg"){
			Storage::disk('avatar')->delete($host.'/'.Str::lower(class_basename($model)).'/'.$avatar['avatar_old']); 
	 	}
	}

	public function removeImage($request,$model,$avatar){
		$input = $request->all();  
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));  
		//$host = $input['domain'];
		$host = $request->header()['domain'][0];
		if($avatar['avatar_old'] !== "default-thumbnail.jpg"){
			Storage::disk('avatar')->delete($host.'/'.Str::lower(class_basename($model)).'/old/'.$avatar['avatar_old']); 
	 	}
	}

	public function restoreImage($request,$avatar,$model){
		$input = $request->all();  
		$lastName = strtolower(preg_replace('/\s+/', '_', trim($input['last_name'])));  
		//$host = $input['domain'];
		$host = $request->header()['domain'][0];
		if(Storage::disk('avatar')->exists($host.'/'.Str::lower(class_basename($model)).'/'.$avatar['avatar_new'])){
			Storage::disk('avatar')->delete($host.'/'.Str::lower(class_basename($model)).'/'.$avatar['avatar_new']); 
		}
		if($avatar['avatar_old']!== "default-thumbnail.jpg"){
			Storage::disk('avatar')->move($host.'/'.Str::lower(class_basename($model)).'/old/'.$avatar['avatar_old'], $host.'/'.Str::lower(class_basename($model)).'/'.$avatar['avatar_old']);
		}
	}
	



}