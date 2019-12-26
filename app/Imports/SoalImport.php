<?php

namespace App\Imports;

use App\Models\Soal;
use App\Models\SoalJenis;
use App\Models\CompetenceKUK;
use App\Models\CompetenceElement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel,WithHeadingRow
{
   
    public function model(array $row)
    {
       
        // $modul = CompetenceUnit::where('id',$row[2])->value('id');
        // $submodul = CompetenceKUK::where('code',$row[1])->value('id');
        // $jenis = SoalJenis::where('name',$row[2])->value('id');
        // $element = CompetenceKUK::where('id',$submodul)->value('competence_element_id');
        // $modul = CompetenceElement::where('id',$element)->value('competence_unit_id');
        $array = [
            // 'modul_id' => $modul,
            'code_kuk' => $row['code kuk'],
            'jenis_soal_id' => $row['jenis soal'], 
            'nick' => $row['Nama Soal'], 
            'soal' => $row['soal'], 
            'a' => $row['pilihan a'], 
            'b' => $row['pilihan b'], 
            'c' => $row['pilihan c'], 
            'd' => $row['pilihan d'], 
            'e' => $row['pilihan e'], 
            'tag' => $row['tag'], 
            'penjelasan' => $row['penjelasan'], 
            'kunci_id' => $row['jawaban'], 
            'parent' => 0, 
            'status' => 1, 
            'hit' => 0, 
        ];
        
        $soal = new Soal($array);
        // dd($soal);
        return $soal;

        // return $row;
    }

    public function rules(): array
    {
        return [
            // '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required|string',
            '3' => 'required|string',
            '4' => 'required|string',
            '5' => 'required|string',
            // so on
        ];
    }
}
