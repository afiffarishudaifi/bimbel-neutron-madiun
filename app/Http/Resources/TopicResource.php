<?php

namespace App\Http\Resources;

use App\Helpers\AlzaHelpers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TopicResource extends JsonResource
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
            'id' =>$this->id,
            'kelas_id' =>$this->kelas_id,
            'kelasname' =>$this->kelas->nama_kelas,
            'mapel_id' =>$this->mapel_id,
            'mapelname' =>$this->mapel->nama_mapel,
            'respon' =>count($this->post).'x direspon',
            'title' =>$this->title,
            'desc' =>htmlspecialchars_decode(html_entity_decode(utf8_decode($this->desc))),
            'pengajar_id' =>$this->pengajar_id,
            'pengajarname' =>$this->pengajar->nama_pengajar,
            'pengajarfoto' =>Storage::disk('public')->exists('/upload/'.$this->pengajar->foto) ? url('/storage/upload/'.$this->pengajar->foto) : '',
            'active' => $this->active == 1 ? 'Aktif' : 'Tutup',
            'created_at' => AlzaHelpers::cek_terakhir($this->created_at),
            'updated_at' =>$this->updated_at,
        ];
    }
}
