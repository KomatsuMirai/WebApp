<?php

namespace App\Livewire;

use App\Models\Record;
use App\Models\User;
use App\Models\Category;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class RecordIndex extends Component
{
    //モーダルウィンドウ表示の可否
    public $showModal = false;

    // データベースのやり取りで使うフィールド
    #[Validate]
    public $registration_date;

    #[Validate]
    public $price;
    
    #[Validate]
    public $note;
    
    public $record;

    protected $rules = [
        'registration_date' => 'required',
            'category'=>'required',
            'price' => 'required|integer',
            'note' => 'max:2',
    ];

    protected $messages = [
        'registration_date.required' =>'日時を指定してください', 
        'category.required' => '種類を指定してください',
        'price.required' => '金額を入力してください',
        'price.integer' => '数値で入力してください',
        'note.max' =>'指定の文字数を超えています',
    ];

    public function updated($registration_date,$category,$price,$note){
        $this ->validatedOnly($registration_date);
        $this ->validatedOnly($category);
        $this ->validatedOnly($price);
        $this ->validatedOnly($note);
    }

    public function openModal(){
        $this->showModal = true;
    }

    public function closeModal(){                                                       
        $this -> showModal = false;
    }

    public function store(Request $request, Record $record)
    {
        $validated = $request->validate([
            'registration_date' => 'required',
            'category'=>'required',
            'price' => 'required|integer',
            'note' => 'max:50',
        ]);

        $record = new Record;
        $record ->user_id = auth()->user()->id;
        //name属性categoryの値を登録
        $record ->category_id = $request->category;
        $record ->price = $validated['price'];
        $record ->note = $validated['note'];
        $record ->registration_date = $validated['registration_date'];

        $record -> save();

        return back()->with('message','作成しました');

    }

    public function editRecord(){

        return $this->openModal();

    }

    // public function deleteRecord(Record $record){
    //     $record->delete();

    //     return redirect()->route('record.index')->with('message', '削除しました');
    // }

    public function render(){
        // $user = auth()->user();

        // if($this->search !=''){
        // //検索した文字列の入ったレコードを抽出
        // $records = Record::where('user_id', auth()->id(),'%'.$this->search.'%')->with('category')->orderBy('registration_date', 'asc')->paginate(3);
        //     return view('livewire.record-index', compact('records'));
        // }
        // else{
        // //Recordクラスのcategoryメソッドを使用
        // $records = Record::where('user_id', auth()->id())->with('category')->orderBy('registration_date', 'asc')->paginate(3);
        // }
        // return view('livewire.record-index',['records'=>$records]);
        return view('livewire.record-index');
    }

}
