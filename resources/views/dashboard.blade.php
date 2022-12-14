<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                @if (Auth::user()->id == 11)
                @else
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <br>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">ระบบบริการ API</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0 ">
                            <form action="{{ Route('sign.in') }}" method="POST">
                                @csrf
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    @if ($response)
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 ">
                                            <dt class="text-sm font-medium text-gray-500">กรุณาเก็บรหัสไว้ให้ดี รหัส
                                                owner
                                                แรกของระบบคุณจะใช้ email และ password ที่ล็อกอินในเว็บนี้</dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                API KEY = {{ $response }}
                                            </dd>
                                            <br>
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
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @isset($lava1)
                <br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="flex-md-grow-1 items-stretch ">

                            <div id="pop_div"></div>
                            <?= $lava1->render('AreaChart', 'Population', 'pop_div') ?>

                            <div id="temps_div"></div>
                            <?= $lava->render('LineChart', 'Temps', 'temps_div') ?>
                        </div>
                    </div>
                </div>
            @endisset
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @isset($lava1)
                <br>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="flex-md-grow-1 items-stretch ">
                            <div id="pop_div"></div>
                            <?= $lava1->render('AreaChart', 'Population', 'pop_div') ?>
                        </div>
                    </div>
                </div>
            @endisset
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @isset($lava)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                        <div class="flex-md-grow-1 items-stretch ">
                            <div id="temps_div"></div>
                            <?= $lava->render('LineChart', 'Temps', 'temps_div') ?>
                        </div>
                    </div>
                </div>
            @endisset
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @isset($log)
                @if ($log)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <br>
                                <h3 class="text-lg font-medium leading-6 text-gray-900" style="font-size: 20px">Log
                                    Count
                                    {{ $logCount }} </h3>
                                <br>
                            </div>
                            <div class="px-4 sm:px-0">
                                <br>
                                <h3 class="text-lg font-medium leading-6 text-gray-900" style="font-size: 20px">Last 100
                                    record
                                    usage data</h3>
                                <br>
                            </div>
                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                                    <thead class="text-xs text-gray-700  text-gray-900 dark:border-gray-700"
                                        style="font-size: 18px">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 ">
                                                event_time
                                            </th>
                                            <th scope="col" class="py-3 px-6 ">
                                                user
                                            </th>
                                            <th scope="col" class="py-3 px-6 ">
                                                method
                                            </th>
                                            <th scope="col" class="py-3 px-6 ">
                                                fullUrl
                                            </th>
                                            <th scope="col" class="py-3 px-6 ">
                                                ipAddress
                                            </th>
                                            {{-- <th scope="col" class="py-3 px-6 dark:text-white">
                                                request
                                            </th> --}}
                                            <th scope="col" class="py-3 px-6 ">
                                                message
                                            </th>
                                            <th scope="col" class="py-3 px-6 ">
                                                size(MB)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($log->take(100) as $v)
                                            <tr class="bg-white border-b ">
                                                <th scope="row"
                                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap text-gray-700">
                                                    {{ $v->event_time }}
                                                </th>
                                                <td class="py-4 px-6 text-gray-700">
                                                    {{ $v->name }}
                                                </td>

                                                @if ($v->method == 'GET')
                                                    <td class="py-4 px-6" style="color: green">
                                                    @elseif ($v->method == 'POST')
                                                    <td class="py-4 px-6" style="color: orange">
                                                    @elseif ($v->method == 'PATCH')
                                                    <td class="py-4 px-6" style="color: blueviolet">
                                                    @else
                                                    <td class="py-4 px-6 text-gray-700">
                                                @endif
                                                {{ $v->method }}
                                                </td>

                                                <td class="py-4 px-6 text-gray-700">
                                                    {{ Str::limit($v->fullUrl, 70) }}
                                                </td>
                                                <td class="py-4 px-6 text-gray-700">
                                                    {{ $v->ipAddress }}
                                                </td>
                                                {{-- <td class="py-4 px-6">
                                                    {{ $v->request }}
                                                </td> --}}
                                                <td class="py-4 px-6 text-gray-700">
                                                    {{ $v->message }}
                                                </td>
                                                <td class="py-4 px-6 text-gray-700">
                                                    {{ $v->size_MB }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white overflow-hidden dark:bg-gray-900 shadow-sm sm:rounded-lg"></div>
                @endif
            @endisset
        </div>
    </div>

</x-app-layout>
