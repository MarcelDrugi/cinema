<?php

namespace App\Services;

use App\Models\Information;

final class InformationService
{
    private $content, $info;
    
    public function __construct($data)
    {
        $this->content = $data['content'];
        $this->info = json_decode($data['infoSelect'], true);
    }
    
    public function updateInfo()
    {
        if($info = Information::where('place', $this->info['place'])->first()) {
            $info->content = $this->content;
            $info->save();
            
            $request = request();
            $request->session()->flash('infoModified', $info['place']);
        }
        else
            abort(404, 'Location of info not found.');
    }
}
