<x-app-layout>
    <div class="sm:max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form action="{{ route('comments.update', $comment) }}" method="POST">
            @csrf
            @method('patch')

            <textarea
                name="message"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message', $comment->message) }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2"></x-input-error>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Alterar') }}</x-primary-button>
                <a href="{{ route('comments.index') }}">{{ __('Cancelar') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
