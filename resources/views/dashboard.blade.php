<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">ระบบบริการ API</h3>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0 ">
                        <form action="{{ Route('sign.in') }}" method="POST">
                            @csrf
                            <div class="overflow-hidden shadow sm:rounded-md">
                                @if ($response)
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 ">
                                        <dt class="text-sm font-medium text-gray-500">กรุณาเก็บรหัสไว้ให้ดี</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            API KEY = {{ $response }}
                                        </dd>
                                    </div>
                                @else
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">กรุณาใส่ชื่อร้านเพื่อรับรหัส
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            <br />
                                        </dd>
                                    </div>

                                    <div class="bg-white px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="name"
                                                    class="block text-sm font-medium text-gray-700">Store
                                                    name</label>
                                                <input type="text" name="name" id="name"
                                                    autocomplete="given-name"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- @if ($log) --}}
            {{-- <br>
                <div class="bg-white overflow-hidden dark:bg-gray-900 shadow-sm sm:rounded-lg">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <br>
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Log Count
                                {{ Count($log) }} </h3>
                            <br>
                        </div>
                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left dark:bg-gray-900 text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 dark:text-white">
                                            event_time
                                        </th>
                                        <th scope="col" class="py-3 px-6 dark:text-white">
                                            user_host
                                        </th>
                                        <th scope="col" class="py-3 px-6 dark:text-white">
                                            server_id
                                        </th>
                                        <th scope="col" class="py-3 px-6 dark:text-white">
                                            command_type
                                        </th>
                                        <th scope="col" class="py-3 px-6 dark:text-white">
                                            argument
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ $log }} --}}
            {{-- @foreach ($log as $v)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $v->event_time }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $v->user_host }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $v->server_id }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $v->command_type }}

                    </td>
                    <td class="py-4 px-6">
                        {{ $v->argument }}
                    </td>
                </tr>
            @endforeach --}}
            {{-- </tbody>
            </table>
        </div>
    </div>
    </div> --}}
            {{-- @else --}}
            {{-- <div class="bg-white overflow-hidden dark:bg-gray-900 shadow-sm sm:rounded-lg"></div> --}}
            {{-- @endif --}}
        </div>
    </div>

</x-app-layout>
