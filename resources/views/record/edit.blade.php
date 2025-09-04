<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">記録の更新</h2>
    </x-slot>

    <div class="h-4/6 w-fit m-auto">
        <div class="py-5 px-4 mr-1 rounded-xl bg-gray-200">
            <form action="{{ route('record.update', $record) }}" method="POST">
                @csrf
                @method('patch')
                <div class="mb-4">
                    <label for="date">日時</label>
                    <input type="date" name="registration_date"
                        value="{{ old('registration_date', $record->registration_date) }}"
                        class="border-gray-300 rounded-md" />
                    <x-input-error :messages="$errors->get('registration_date')" />
                </div>
                <div class="mb-4">
                    <label for="category">種類</label>
                    <select name="category" id="category" class="border-gray-300 rounded-md">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            {{-- categoriesテーブルとrecordsテーブルのidが同じ場合選択済みにする --}}
                            <option value="{{ $category->id }}" @if ($category->id === (int) old('category', $record->category_id)) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category')" />
                </div>
                <div class="mb-4">
                    <label for="price">金額</label>
                    <input type="text" name="price" value="{{ old('price', $record->price) }}"
                        class="border-gray-300 rounded-md">
                    <x-input-error :messages="$errors->get('price')" />
                </div>
                <div class="mb-4">
                    <label for="note">補足</label>
                    <input type="text" name="note" value="{{ old('note', $record->note) }}"
                        class="border-gray-300 rounded-md" placeholder="10字以内で記入">
                    <x-input-error :messages="$errors->get('note')" />
                </div>
                <x-create-button>
                    更新
                </x-create-button>
                <x-secondary-button onclick="history.back()" name="back" value="back">
                    戻る
                </x-secondary-button>
            </form>
        </div>
    </div>

</x-app-layout>
