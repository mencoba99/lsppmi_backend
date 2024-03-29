<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;
use Venturecraft\Revisionable\Revisionable;

class Program extends Revisionable
{

    /** Untuk config Revision Log */
    protected $revisionCleanup          = true;
    protected $revisionCreationsEnabled = true;
    protected $historyLimit             = 10000;
    /** End */

    protected $table = 'programs';

    protected $fillable
        = [

            'code',
            'name',
            'description',
            'type',
            'status',
            'program_type_id',
            'sing_ind',
            'sing_int',
            'harga',
            'level',
            'min_competence',
            'opt_competence',
            'abbreviation_id',
            'abbreviation_en'

        ];

    protected $casts = [
        'type' => 'json'
    ];

    public function kategori()
    {
        return $this->belongsTo('\App\Models\Kategori', 'program_type_id', 'id');
    }

    public function mgt_program()
    {
        return $this->belongsTo('\App\Models\MgtProgram', 'id', 'program_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function unit_kompetensi()
    {
        return $this->belongsToMany('App\Models\CompetenceUnit', 'program_competence_unit', 'program_id', 'competence_unit_id')
                    ->using('App\Models\ProgramCompetenceUnit')->withPivot('is_required','id');
    }
}
