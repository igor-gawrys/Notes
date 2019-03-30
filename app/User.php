<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User.
 *
 * @package namespace Test\Entities;
 */
class User extends  Authenticatable 
{
    use Notifiable;

    protected $connection = 'mysql';

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
         "social_user_id"
      ];

      /**
       * The attributes that should be hidden for arrays.
       *
       * @var array
       */
      protected $hidden = [
          // Custom hidden property
      ];

   /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
   public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   /**
    * Return a key value array, containing any custom claims to be added to the JWT.
    *
    * @return array
    */
   public function getJWTCustomClaims()
   {
       return [];
   }
   

   // Your relationships

   public function notes(){
       return $this->hasMany('App\Note','user_id','id');
   }

}
