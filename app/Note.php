<?php

namespace App;

use App\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['text','noteable_id','noteable_type','user_id'];

    public function noteable () {
      return $this->morphTo();
    }

    static function getNotes ($model, $id){
      // get the row of model that matches id
      // also orders by most recently created_at
      $model = $model::find($id)->notes->sortByDesc('created_at')->values()->all();
      $modelNotes = array();
      
      // find all notes associated with the specified model 
      // if found push note to modelNotes array
      foreach ($model as $note) {
         
         if ($note){
            array_push($modelNotes, array(
               'text' => $note->text,
               'user_id' => $note->user_id,
               'last_updated' => $note->created_at->toDateTimeString(),
            ));
         }
         
      }

      // send array of notes for item
      return $modelNotes;
    }
}
