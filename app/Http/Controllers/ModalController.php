<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function edit()
    {
        return view('modal.edit');
    }
    public function update(Record $record){
        
    }
}