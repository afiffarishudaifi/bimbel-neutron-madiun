<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\AlzaHelpers;
class RepliesResource extends JsonResource
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
            'userid' => $this->siswa_id != '0' ? $this->siswa_id : $this->pengajar_id,
            'username' => $this->siswa_id != '0' ? $this->siswa($this->siswa_id)[0]['nama'] : $this->pengajar($this->pengajar_id)[0]['nama_pengajar'],
            'userfoto' => $this->siswa_id != '0' ? url('storage/upload/'.$this->siswa($this->siswa_id)[0]['foto']) : url('storage/upload/'.$this->pengajar($this->pengajar_id)[0]['foto']),
            'postid' => $this->post_id,
            'postname' => isset($this->posting->title) ? $this->posting->title : '',
            'reply' => htmlspecialchars_decode(html_entity_decode(utf8_decode($this->reply))),
            'attachment' => isset($this->attachment) ? url('storage/upload/'.$this->attachment) : '',
            'created_at' => AlzaHelpers::cek_terakhir($this->created_at),
        ];
    }
}
