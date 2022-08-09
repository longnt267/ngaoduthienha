<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'content'
    ];

    public function getByType($type)
    {
        return $this->where('type', $type)->first()->content ?? '';
    }

    public function saveData($request)
    {
        $this->updateOrCreate([
            'type' => 'about us'
        ], [
            'content' => $request->about_us
        ]);

        $this->updateOrCreate([
            'type' => 'term'
        ], [
            'content' => $request->term
        ]);

        $this->updateOrCreate([
            'type' => 'privacy policy'
        ], [
            'content' => $request->privacy_policy
        ]);

        $this->updateOrCreate([
            'type' => 'guest policy'
        ], [
            'content' => $request->guest_policy
        ]);
    }
}
