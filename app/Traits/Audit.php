<?php 
namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
trait Audit {
	protected static function bootAudit() {
            static::creating(function ($model) {
                $model->created_user_id = Auth::check() ? auth()->user()->id :0;
            });

            static::updating(function ($model) {
                $model->updated_user_id = Auth::check() ?  auth()->user()->id : 0;
            });
            
            static::deleting(function ($model) {
                if(Schema::hasColumn($model->getTable(),'deleted_user_id')){
                    $model->deleted_user_id = Auth::check() ? auth()->user()->id : 0;
                    $model->save();
                }
            });
	}
}