<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <title>Booking API</title>
</head>

<body class="bg-gray-50" style="margin-top: 18%;">

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-gray-50">
        <div class="mx-auto max-w-3xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Ready to API ?</span>
                <span class="block text-indigo-600">Start your Booking API today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="https://documenter.getpostman.com/view/18796122/VUqoSKKH" target="_blank"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">Get
                        started</a>
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-3xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-0 lg:px-8">
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-500 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">Login</a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50">
                        Register</a>
                </div>
            </div>
        </div>
    </div>


    {{-- <center>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="bg-gray-50">
            <div
                class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    <span class="block">Ready to API ?</span>
                    <span class="block text-indigo-600">Start your Booking API today.</span>
                </h2>
            </div>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                <div class="inline-flex rounded-md shadow">
                    <a href="https://documenter.getpostman.com/view/18796122/VUqoSKKH" target="_blank"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">Get
                        started Doc</a>
                </div>
            </div>
            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50">
                        Login</a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-indigo-600 hover:bg-indigo-50">Register</a>
                </div>
            </div>
        </div>
    </center> --}}
</body>

</html>
