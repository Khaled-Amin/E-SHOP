<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'sittings';
    protected $fillable =
    [
        'nameWebsite',
        'linkWebsite',
        'Description',
        'count_University',
        'socialMidiaFacebook',
        'socialMidiaTelegram',
        'socialMidiaInstagram',
        'socialMidiaYoutube',
        'Keywords',
        'favicon',
        'meta_image'

    ];
}
