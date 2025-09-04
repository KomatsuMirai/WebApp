<x-app-layout>
    <h2 class="font-bold text-2xl px-5">記録一覧</h2>

    {{-- pcタブレット時のレイアウト（md(760px)~） --}}
    <div class="md:flex hidden">
        <div class="px-5 py-3 m-auto border border-gray-300 bg-gray-50">
            <p class="font-semibold">記録をつける</p>
            <form action="{{ route('record.store') }}" method="POST">
                @csrf
                <div class="lg:flex md:max-lg:grid grid-cols-2 auto-rows-auto gap-2">

                    <div class="col-span-1">
                        <label for="registration_date">日時</label>
                        <input type="date" name="registration_date" class="rounded-md border-gray-300"
                            value="{{ old('registration_date', date('Y-m-d')) }}">
                        <x-input-error :messages="$errors->get('registration_date')" />
                    </div>

                    <div class="col-span-1">
                        <label for="category">種類</label>
                        <select name="category" id="category" class="rounded-md border-gray-300">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == old('category')) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" />
                    </div>

                    <div class="col-span-1">
                        <label for="price">金額</label>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="w-40 rounded-md border-gray-300">
                        <x-input-error :messages="$errors->get('price')" />
                    </div>

                    <div class="col-span-1">
                        <label for="note">補足</label>
                        <input type="text" name="note" value="{{ old('note') }}"
                            class="w-40 rounded-md border-gray-300 " placeholder="10字以内で記入">
                        <x-create-button>
                            登録
                        </x-create-button>
                        <x-input-error :messages="$errors->get('note')" />
                    </div>
                </div>
            </form>
            <p class="font-semibold">記録の検索</p>
            <form>
                @csrf
                {{-- 日付検索 --}}
                <input type="date" id="from" name="from" class="border-gray-300 rounded-md"
                    value="{{ $from }}">
                <span>から</span>
                <input type="date" id="until" name="until" class="border-gray-300 rounded-md"
                    value="{{ $until }}">
                <span>まで</span>
                {{-- カテゴリ検索 --}}
                <select name="category_search" id="category_search" class="rounded-md border-gray-300 ">
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (session('category_search') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <x-reset-button>
                    リセット
                </x-reset-button>
                <x-search-button>
                    検索
                </x-search-button>
            </form>
        </div>
    </div>

    {{-- 小さい画面の時(スマホ想定)のレイアウト --}}
    <div class="md:hidden">
        <div id="accordion-color" data-accordion="collapse">
            <h2 id="accordion-color-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200  hover:bg-blue-100  gap-3"
                    data-accordion-target="#accordion-color-body-1" aria-expanded="false"
                    aria-controls="accordion-color-body-1">
                    <span>記録をつける</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                <div class="p-5 border border-b-0 border-gray-200 bg-gray-50">
                    <form action="{{ route('record.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-2 auto-rows-auto gap-1">
                            <div class="col-span-1">
                                <label for="registration_date">日時</label>
                                <input type="date" name="registration_date" id="registration_date"
                                    class="rounded-md border-gray-300"
                                    value="{{ old('registration_date', date('Y-m-d')) }}">
                                <x-input-error :messages="$errors->get('registration_date')" />
                            </div>

                            <div class="sm:col-span-1">
                                <label for="category">種類</label>
                                <select name="category" id="category" class="rounded-md border-gray-300">
                                    <option value="">選択してください</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (old('category') == $category->id) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category')" />
                            </div>

                            <div class="sm:col-span-1">
                                <label for="price">金額</label>
                                <input type="number" name="price" value="{{ old('price') }}"
                                    class="w-40 rounded-md border-gray-300">
                                <x-input-error :messages="$errors->get('price')" />
                            </div>

                            <div class="sm:col-span-1">
                                <label for="note">補足</label>
                                <input type="text" name="note" value="{{ old('note') }}"
                                    class="rounded-md border-gray-300 w-40" placeholder="10字以内で記入">

                                <x-input-error :messages="$errors->get('note')" />
                            </div>
                            <div class="col-start-2 justify-self-end">
                                <x-create-button>
                                    登録
                                </x-create-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h2 id="accordion-color-heading-2">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 hover:bg-blue-100 gap-3"
                    data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                    aria-controls="accordion-color-body-2">
                    <span>記録の検索</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
                <div class="p-5 border border-b-0 border-gray-200 bg-gray-50 ">
                    <form>
                        @csrf
                        {{-- 日付検索 --}}
                        <input type="date" name="from" class="border-gray-300 rounded-md"
                            placeholder="from_date" value="{{ $from }}">
                        <span>から</span>
                        <input type="date" name="until" class="border-gray-300 rounded-md"
                            placeholder="until_date"value="{{ $until }}">
                        <span>まで</span>
                        {{-- カテゴリ検索 --}}
                        <select name="category_search" id="category_search" class="rounded-md border-gray-300 ">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"@if (session('category_search') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <x-reset-button>
                            リセット
                        </x-reset-button>
                        <x-search-button>
                            検索
                        </x-search-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-7 lg:w-3/5 w-11/12 m-auto">
        <table class="table-auto w-full mx-auto">
            <thead>
                <tr class="bg-gray-400">
                    <th>日付</th>
                    <th>金額</th>
                    <th>種類</th>
                    <th>補足</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr class="odd:bg-white even:bg-gray-200 hover:bg-gray-300 text-center">
                        <td>{{ $record->registration_date }}</td>
                        <td>{{ $record->price }}</td>
                        <td>{{ $record->category->name }}</td>
                        <td>{{ $record->note }}</td>
                        <td>
                            <form action="{{ route('record.destroy', $record) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('record.edit', $record) }}">
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
        <div class="flex justify-content-between mt-3">
            <div class="flex-1 font-bold">
                合計支出: {{ $total . '円' }}
            </div>
            <div>
                {{ $records->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
