<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

class Progresse extends Model
{

 use HasFactory;

 protected $fillable = [
 'user_id',
 'title',
 'weight',
 'measurements',
 'performance',
 'status',
 ];
 public function sluggable(): array
 {
 return [
 'slug' => [
 'source' => 'title'
 ]
 ];
 }

 public function user(){
    return $this->belongsTo(User::class);
 }
}