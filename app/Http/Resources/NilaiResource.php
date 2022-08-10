<?php

namespace App\Http\Resources;

use App\Helpers\AlzaHelpers;
use Illuminate\Http\Resources\Json\JsonResource;

class NilaiResource extends JsonResource
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
            'id' => $this->id,
            'groupsoalid' => $this->groupsoal_id,
            'kelas' => $this->groupsoal->entitas->kelas->nama_kelas,
            'pengajar' => $this->groupsoal->pengajar->nama_pengajar,
            'mapelname' => $this->groupsoal->mapel->nama_mapel,
            'siswa_id' => $this->siswa_id,
            'nilai' => $this->nilai,
            'tglujian' => AlzaHelpers::tanggal_indonesia($this->groupsoal->start_date),
        ];
    }
}
