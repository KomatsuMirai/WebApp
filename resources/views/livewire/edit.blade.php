<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">記録の更新</h2>
    </x-slot>

    <form wire:submit.prevent="updateRecord" class="w-fit m-auto">
        @csrf
        @method('patch')
        <div>
            <label for="date">日付</label>
            <x-input-error :messages="$errors->get('registration_date')" />
            <input type="date" name="registration_date" value="{{ $record->registration_date }}">
        </div>
        <div>
            <label for="category">種類</label>
            <x-input-error :messages="$errors->get('category')" />
            <select name="category" id="category">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    {{-- categoriesテーブルとrecordsテーブルのidが同じ場合選択済みにする --}}
                    <option value="{{ $category->id }}" {{ $category->id == $record->category_id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price">金額</label>
            <x-input-error :messages="$errors->get('price')" />
            <input type="text" name="price" value="{{ $record->price }}">
        </div>
        <div>
            <label for="note">補足</label>
            <x-input-error :messages="$errors->get('note')" />
            <input type="text" name="note" value="{{ $record->note }}">
        </div>
        <x-create-button>
            <input type="submit" value="更新">
        </x-create-button>
        <x-secondary-button onclick="history.back()">
            戻る
        </x-secondary-button>
    </form>
</x-app-layout>
