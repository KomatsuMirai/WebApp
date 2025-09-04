<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Record;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Case_;

class RecordController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $user = auth()->user();
        $user_id = auth()->id();
        $from = $request->from;
        $until = $request->until;
        $reset = $request->reset;
        $category_search = $request->category_search;
        // $menu_search = $request->input('menu_search');
        $record = new Record();
        $q = Record::query();

        // Recordクラスのcategoryメソッドを使用
        // $records = Record::where('user_id', $user_id)->with('category')->orderBy('registration_date', 'asc')->paginate(10);
        $query = $q->where('user_id', $user_id)->with('category')->orderBy('registration_date', 'desc');
        
        // リセットボタンの処理
        if($reset == 1){
            $from = '';
            $until = '';
            $category_search ='';
            session()->forget('from');
            session()->forget('until');
            session()->forget('category_search');
            $reset = '';
            $total = $query->sum('price');
            $records = $query->paginate(10)->withQueryString();
            return view('record.index', compact('records', 'total', 'from', 'until', 'category_search'));
        }

        // 日付(カテゴリ)検索
        if(isset($from) || isset($until) || isset($category_search) && $reset != 1){
            //fromからuntilまでの日付検索
            if(isset($from) && isset($until)){
                $query = $query->whereBetween('registration_date', [$from, $until]);
                session()->put('from', $from);
                session()->put('until', $until);
            //fromからのデータを全て検索
            }elseif(isset($from) && !isset($until)){
                $query = $query->where('registration_date', '>=' ,$from);
                session()->put('from', $from);
                session()->forget('until');
            //untilまでのデータを全て検索
            }elseif(!isset($from) && isset($until)){
                $query = $query->where('registration_date', '<=' ,$until);
                session()->put('until', $until);
                session()->forget('from');
            }

            // カテゴリ検索
            if(isset($category_search)){
                $query = $query->where('category_id', $category_search);
                session()->put('category_search', $category_search);
            }
            // $records = Record::whereBetween('registration_date', [$from, $until])->orderby('registration_date', 'asc')-> paginate(8);
            // session()->put('from', $from);
            // session()->put('until', $until);
            $total = $query->sum('price');
        }
        else{
            $total = $query->sum('price');
        }

        //ページネーションや登録時に検索結果を保持
        $records = $query->paginate(10)->withQueryString();

        return view('record.index', compact('records', 'from', 'until', 'total', 'category_search'));
    }

    public function create()
    {
        // return view('record.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Record $record)
    {
        $validated = $request->validate([
            'registration_date' => 'required',
            'category'=>'required',
            'price' => 'required|integer',
            'note' => 'nullable|max:10',
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

//     /**
//      * Display the specified resource.
//      */
    public function show(string $id)
    {
        //
    }

//     /**
//      * Show the form for editing the specified resource.
//      */
    public function edit(Record $record)
    {
        $this->checkUserId($record);
        // $record = Record::find($record->id); 
        return view('record.edit', compact('record'));
    }

//     /**
//      * Update the specified resource in storage.
//      */
    public function update(Request $request, Record $record)
    {

        $validated = $request->validate([
            'registration_date' => 'required|date|before_or_equal:today',
            'category'=>'required',
            'price' => 'required|integer',
            'note' => 'nullable|max:10',
        ]);

        $record ->registration_date = $validated['registration_date'];
        $record ->price = $validated['price'];
        $record->category_id = $request->category;
        $record ->note = $validated['note'];

        $record -> save();

        $from = session()->get('from');
        $until = session()->get('until');
        $category_search = session()->get('category_search');

        return redirect()->route('record.index',compact('record', 'from', 'until', 'category_search'))->with('message', '更新しました');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        $record->delete();

        $from = session()->get('from');
        $until = session()->get('until');
        $category_search = session()->get('category_search');

        return redirect()->route('record.index', compact('from', 'until', 'category_search'))->with('message', '削除しました');
    }

    //ログインしているユーザーidが作成者のidと同じでない場合403エラー
    private function checkUserId(Record $record, int $status = 403){
        if(Auth::user()->id != $record->user_id){
            abort($status);
        }
    }


}
