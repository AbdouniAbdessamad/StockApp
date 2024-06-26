<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('filter-button').addEventListener('click', function() {
        var filterValue = document.getElementById('supplier-filter').value.trim().toLowerCase();
        var rows = document.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            var name = row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
            if (name.includes(filterValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.getElementById('reset-button').addEventListener('click', function() {
        var rows = document.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            row.style.display = '';
        });
        document.getElementById('supplier-filter').value = '';
    });
});
</script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Stock') }}
            </h2>
            <a href="{{ route('articles.create') }}"
                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Ajouter
                un article</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-4">
                        <input type="text" id="supplier-filter" class="form-input w-full rounded-md shadow-sm"
                            placeholder="Entrer Nom Article">
                        <button id="filter-button"
                            class="ml-2 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Filtrer</button>
                        <button id="reset-button"
                            class="ml-2 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Réinitialiser</button>
                    </div>

                    <div class="border flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Date</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Bon Commande/Bon Sortie</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Fournisseur/Bénéficiaire</th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Reference</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Quantité</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Catégorie</th>
                                                    <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Status</th>
                                                    <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Emplacement</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Dernier Editeur</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Editer</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($articles as $article)
                                            @if($article->status == 'sortie')
                                            <tr class="bg-red-100">
                                                @elseif($article->status == 'entrée')
                                            <tr class="bg-green-100">
                                                @endif
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{ $article->date }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->bon_commande }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->supplier_id }}</td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-lg font-medium text-gray-900 sm:pl-6">
                                                    {{ $article->name }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-lg  text-gray-900 sm:pl-6">
                                                    {{ $article->ref }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->quantity }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->category_id }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->status }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->emplacement }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900 sm:pl-6">
                                                    {{ $article->last_editor_id }}</td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                    
<!-- 
                                                            <a href="{{ route('articles.edit', ['article' => $article->id]) }}"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                        <x-primary-button>
                                                            Editer
                                                        </x-primary-button>
                                                    </a> 

-->                                                    
                                                </td>




                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>