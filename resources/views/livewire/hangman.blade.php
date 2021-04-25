<div>
    <div class="grid grid-cols-1 md:grid-cols-2 items-center pt-3 pb-4">

        <div class="md:order-2 border rounded shadow-sm p-4 text-center flex">
            <canvas id="hangman" class="m-auto" width="180" height="250"></canvas>
        </div>
        <div class="flex flex-wrap content-between mb-4 md:order-1 h-full">
            <div class="w-full">
                <label for="category_id" class="block font-medium text-sm text-gray-700">categoría</label>
                <select wire:model="category_id" id="category_id"
                    class="focus:border-blue-300 focus:outline-none focus:ring-blue-200 border-gray-300 focus:ring focus:ring-opacity-50 rounded-md p-2 text-sm shadow-sm border">
                    @if (!$categories->isEmpty())
                    <option value="" selected>Seleccione una categoría</option>
                    @endif
                    @forelse ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @empty
                    <option value="" disabled>No se encontraron categorias</option>
                    @endforelse
                </select>
                <div class="w-full flex flex-wrap pt-4">
                    @forelse ($spelledWord as $index => $letter)
                    <div class="w-8 h-8 border-b-2 border-gray-700 mx-2 flex">
                        @isset($foundLetters[$index])
                        <span
                            class="m-auto text-lg font-semibold">{{$foundLetters[$index]==$letter ? $letter : ''}}</span>
                        @endisset
                    </div>
                    @empty
                    <span class="text-sm">Seleccione una categoría o reinicie el juego.</span>
                    @endforelse
                </div>
            </div>
            @if ($spelledWord>0 && 8>$part && $spelledWord !== $foundLetters)
            <div class="w-full flex flex-wrap content-between pt-4">
                @foreach ($randomLetters as $letter)
                <button wire:click="selectLetter('{{$letter}}')" wire:loading.attr="disabled"
                    class="w-8 h-8 shadow-sm m-2 flex bg-blue-500 hover:bg-blue-600 cursor-pointer text-white font-semibold rounded disabled:opacity-50">
                    <span class="m-auto">{{$letter}}</span>
                </button>
                @endforeach
            </div>
            @endif
            @if ($part>7)
            <div class="w-full text-center pt-4">
                <span class="text-lg font-semibold">{{ $this->word }}</span>
            </div>
            <div class="w-full text-center pt-3">
                Has perdido, puedes intentarlo de nuevo.
            </div>
            @endif
            @if ($spelledWord === $foundLetters && count($spelledWord))
            <div class="w-full text-center pt-4">
                <span class="text-lg font-semibold">{{ $this->word }}</span>
            </div>
            <div class="w-full text-center pt-3">
                Has ganado, puedes intentarlo de nuevo.
            </div>
            @endif
        </div>
    </div>
    <div class="w-full flex py-3 border-t">
        <button wire:click="restart()" wire:loading.attr="disabled"
            class="py-2 px-3 shadow-sm m-auto bg-gray-500 hover:bg-gray-600 cursor-pointer text-white font-semibold rounded disabled:opacity-50 ">
            Reiniciar
        </button>
    </div>
</div>
