<?php

namespace App\Livewire;

use Livewire\Component;

class Edit extends Component
{
    
    public $showModal = false;

    //編集モーダルウィンドウの表示メソッド
    public function render()
    {
        return view('livewire.edit');
    }

    //モーダルウィンドウの表示の可不可
    public function openModal(){
        $this->showModal = true;
    }
    public function closeModal(){
        $this->showModal = false;
    }
}
