<?php

namespace App\Http\Resources;

use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HostelsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::where('id', $this->user_id)->first();
        return [
            'id' => (string)$this->id,
            'hostel_name' => $this->name,
            'price' => $this->price,
            'location' => $this->location,
            'no_rooms' => $this->no_rooms,
            'user' => [
                'agent_id' => $this->user_id,
                'agent_name' => $user->name,
                'agent_business_name' => $user->business_name,
                'agent_type' => $user->type,
                'verified_status' => $user->verified
            ],
            'room_type' => $this->room_type,
            'hostel_features' => $this->hostel_features,
            'images' => [
                'one' => $this->img_one,
                'two' => $this->img_two,
                'three' => $this->img_three
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
