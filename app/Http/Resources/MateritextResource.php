<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\AlzaHelpers;
class MateritextResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'mapelid'=>$this->mapel->id,
            'mapelname'=>$this->mapel->nama_mapel,
            'nourut'=>$this->no_urut,
            'judul'=>$this->nama_materitext,
            'isi'=>$this->text,
            'dibuat'=>$this->created_at,
            'diubah'=>$this->updated_at,
            'materi'=>"text",
            'kelas'=>$request->kelas_id,
        ];
    }
}
