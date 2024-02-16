<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fournisseurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Modifier un Fournisseur') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Modifier les informations d'un Fournisseur") }}
                            </p>
                        </header>

                        <form method="POST" action="{{ route('supplier.update',['supplier'=>$supplier->id]) }}"
                            class="mt-6 space-y-6">
                            @csrf
                            @method("patch")
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $supplier->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"
                                    :value="old('city', $supplier->city)" required autofocus autocomplete="city" />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full"
                                    :value="old('country', $supplier->country)" required autofocus
                                    autocomplete="country" />
                                <x-input-error class="mt-2" :messages="$errors->get('country')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="number" class="mt-1 block w-full"
                                    :value="old('phone', $supplier->phone)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>
                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <x-text-input id="type" name="type" type="text" class="mt-1 block w-full"
                                    :value="old('type', $supplier->type)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <!-- Other form fields -->

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'supplier-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>