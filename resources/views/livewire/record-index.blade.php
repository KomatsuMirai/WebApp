<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl">記録一覧</h2>
    </x-slot>
    {{-- @if (session('message'))
        <div class="text text-green-500 bg-green-200">
            {{ session('message') }}
        </div>
    @endif --}}
    <x-message :message="session('message')" />

    <div class="flex justify-center items-center gap-10 ">
        <table class="flex-1">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>金額</th>
                    <th>種類</th>
                    <th>補足</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr class="odd:bg-white even:bg-gray-100 text-center">
                        <td>{{ $record->registration_date }}</td>
                        <td>{{ $record->price }}</td>
                        <td>{{ $record->category->name }}</td>
                        <td>{{ $record->note }}</td>
                        <td>
                            <form wire:submit.prevent="storeRecord">
                                @csrf
                                @method('DELETE')
                                <a wire:click="editRecord({{ $record }})">
                                    <x-secondary-button>
                                        更新
                                    </x-secondary-button>
                                </a>
                                <x-primary-button onclick="return confirm('削除しますか')">
                                    削除
                                </x-primary-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="inline-block py-5 px-4 align-top bg-orange-500 rounded-xl flex-2 mr-1">
            <form wire:submit.prevent="store" method="POST">
                @csrf
                <div class="text-center mb-2">
                    <p class="font-bold text-white">記録を付ける</p>
                </div>
                <div class="mb-4">
                    @error('date')
                        <span class="font-bold text-red-600">{{ $message }}</span>
                    @enderror
                    <label for="registration_date">日時</label>
                    <input type="date" wire:model.live="registration_date">
                </div>
                <div class="mb-4">
                    @error('category')
                        <span class="font-bold text-red-600">{{ $message }}</span>
                    @enderror
                    <label for="category">種類</label>
                    <select wire:model.live="category" id="category">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    @error('price')
                        <span class="font-bold text-red-600">{{ $message }}</span>
                    @enderror
                    <label for="price">金額</label>
                    <input type="text" wire:model.live="price" value="{{ old('price') }}" class="rounded">
                </div>
                <div class="mb-4">
                    @error('note')
                        <span class="font-bold text-red-600">{{ $message }}</span>
                    @enderror
                    <label for="note">補足</label>
                    <input type="text" wire:model.live="note" value="{{ old('note') }}">
                </div>
                <x-create-button>
                    <input type="submit" value="登録">
                </x-create-button>
            </form>
        </div>
    </div>


    <div class="{{ count($records) < 10 ? 'mt-2' : '' }}">
        {{ $records->links() }}
    </div>
</x-app-layout>
