<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupsoalResource extends JsonResource
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
            'entitasid' => $this->entitas_id,
            'entitaskelasid' => $this->entitas->kelas->id,
            'entitaskelasname' => $this->entitas->kelas->nama_kelas,
            'entitasjenjangid' => $this->entitas->jenjang->id,
            'entitasjenjangname' => $this->entitas->jenjang->nama_jenjang,
            'mapelid' => $this->mapel_id,
            'mapelname' => $this->mapel->nama_mapel,
            'pengajarid' => $this->pengajar_id,
            'pengajarname' => $this->pengajar->nama_pengajar,
            'waktu' => $this->waktu,
            'startdate' => $this->start_date,
            'expireddate' => $this->expired_date,
            'aktif' => $this->aktif,
            'createdat' => $this->created_at,
            'updatedat' => $this->updated_at,
        ];
    }
}
