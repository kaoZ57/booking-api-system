<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('AdminDashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <br>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                    <thead class="text-xs text-gray-700  text-gray-900 dark:border-gray-700" style="font-size: 18px">
                        <tr>
                            <th scope="col" class="py-3 px-6 ">
                                number
                            </th>
                            <th scope="col" class="py-3 px-6 ">
                                owner
                            </th>
                            {{-- <th scope="col" class="py-3 px-6 ">
                                api_key
                            </th> --}}
                            <th scope="col" class="py-3 px-6 ">
                                created_at
                            </th>
                            <th scope="col" class="py-3 px-6 ">
                                updated_at
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($central as $v)
                            <tr class="bg-white border-b ">
                                <td class="py-4 px-6 text-gray-700" style="width: 1%">
                                    <center> {{ $i++ }}
                                </td>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap text-gray-700"
                                    style="width: 1%">
                                    <center> {{ $v->name }}
                                </th>
                                {{-- <td class="py-4 px-6 text-gray-700">
                                        {{ $v->api_key }}
                                    </td> --}}
                                <td class="py-4 px-6 text-gray-700">
                                    <center> {{ $v->created_at }}
                                </td>
                                <td class="py-4 px-6 text-gray-700">
                                    <center> {{ $v->updated_at }}
                                </td>
                                <td class="py-4 px-6 text-gray-700">
                                    <center> {{ $v->size }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
