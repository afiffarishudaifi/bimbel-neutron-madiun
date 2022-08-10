<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\AlzaHelpers;
use Illuminate\Support\Facades\Storage;
class TopicdetilResource extends JsonResource
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
            'username' => $this->siswa_id != '0' ? $this->siswa()[0]['nama'] : $this->pengajar()[0]['nama_pengajar'],
            'userfoto' => $this->siswa_id != '0' ? url('storage/upload/'.$this->siswa()[0]['foto']) : url('storage/upload/'.$this->pengajar()[0]['foto']),
            'post' => htmlspecialchars_decode(html_entity_decode(utf8_decode($this->post))),
            'replies' => RepliesResource::collection($this->reply),
            'topicid' => $this->topic_id,
            'topictitle' => $this->topic->title,
            'topicdesc' =>  htmlspecialchars_decode(html_entity_decode(utf8_decode($this->topic->desc))),
            'attachment' => isset($this->attachment) ? url('storage/upload/'.$this->attachment) : '',
            'created_at' => AlzaHelpers::cek_terakhir($this->created_at),
        ];
    }
}
