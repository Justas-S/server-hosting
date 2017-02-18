<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\ServerPackage;

class GameServerVersionStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $package = ServerPackage::find($this->get('server_package_id'));
        if ($package->game->id == $this->gameserver->game->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'server_package_id'   => "required|exists:server_packages,id"
        ];
    }
}
