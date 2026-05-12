<template>
    <app-layout></app-layout>
    <h1
        class="text-jost font-semibold text-xl tracking-wide bg-amber-200 text-gray-700"
    >
        Home
    </h1>

    <Link
        v-if="$page.props.auth.user.role == 'admin'"
        :href="route('campingItems')"
    >
        <div
            class="w-28 h-28 border-1 border-purple-300 p-2 m-2 rounded shadow-xl hover:bg-amber-200 hover:border-amber-400"
        >
            <img
                class="w-10 mx-auto"
                src="https://cdns.iconmonstr.com/wp-content/releases/preview/2016/240/iconmonstr-weather-8.png"
            />
            <p class="my-2">Create items</p>
        </div>
    </Link>

    <div>
        <input placeholder="name"  v-model="state.name" type="text">
        <input placeholder="time"  v-model="state.time" type="text">
        <input placeholder="date"  v-model="state.date" type="text">
        <input placeholder="year"  v-model="state.year" type="text">
        <input @keyup="randomize" placeholder="text" class="w-full"  v-model="state.text" type="text">
    </div>

    <!-- component -->
    <div class="bg-gray-800">
        <div class="flex">
            <div class="w-2/5 text-white h-12 pl-32 py-4 "></div>

            <div class="w-2/5 border border-gray-600 h-auto border-t-0">
                <div class="flex flex-shrink-0 p-4 pb-0 m-2 pl-2">
                    <a href="#" class="flex-shrink-0 group block">
                        <div class="flex items-center">
                            <div>
                                <img
                                    class="inline-block h-12 w-12 rounded-full"
                                    :src="'/images/twiter2.jpg'"
                                />
                            </div>
                            <div class="ml-3">
                                <p
                                    class="text-base leading-6 font-medium text-white"
                                >{{ state.name }}</p>
                                <p
                                    class=""
                                >
                                    <span
                                        class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150"
                                    >
                                        @vanessita_p
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="px-4">
                    <p
                        class="text-base width-auto font-medium text-white flex-shrink text-justify pl-10"
                    >
                      {{ state.text }}
                    </p>

                    <br>
                    <hr class="bg-gray-700">
                    <br>
                    <p class="text-sm width-auto font-medium text-gray-400 flex-shrink text-justify">
                        <span>{{ state.time }}</span> - 
                        <span>{{ state.date }}</span>
                        <span>{{ state.year }}</span>
                    </p>



                    <div class="flex">
                        <div class="w-full">
                            <div class="flex items-center">
                                <div class="flex-1 text-center">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-6 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-gray-600" />

                <!--second tweet-->

                <div class="flex flex-shrink-0 p-4 pb-0">
                    <a href="#" class="flex-shrink-0 group block">
                        <div class="flex items-center">
                            <div>
                                <img
                                    class="inline-block h-10 w-10 rounded-full"
                                    src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png"
                                    alt=""
                                />
                            </div>
                            <div class="ml-3">
                                <p
                                    class="text-base leading-6 font-medium text-white"
                                >
                                    Sonali Hirave
                                    <span
                                        class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150"
                                    >
                                        @ShonaDesign . 16 April
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="pl-16">
                    <p
                        class="text-base width-auto font-medium text-white flex-shrink"
                    >
                        Day 07 of the challenge
                        <span class="text-blue-400">#100DaysOfCode</span> I was
                        wondering what I can do with
                        <span class="text-blue-400">#tailwindcss</span>, so just
                        started building Twitter UI using Tailwind and so far it
                        looks so promising. I will post my code after
                        completion. [07/100]
                        <span class="text-blue-400">
                            #WomenWhoCode #CodeNewbie</span
                        >
                    </p>

                    <div class="md:flex-shrink pr-6 pt-3">
                        <img
                            class="rounded-lg w-full h-64"
                            src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80"
                            alt="Woman paying for a purchase"
                        />
                    </div>
                    <div class="flex">
                        <div class="w-full">
                            <div class="flex items-center">
                                <div class="flex-1 text-center">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-6 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-gray-600" />

                <!--third tweet-->

                <div class="flex flex-shrink-0 p-4 pb-0">
                    <a href="#" class="flex-shrink-0 group block">
                        <div class="flex items-center">
                            <div>
                                <img
                                    class="inline-block h-10 w-10 rounded-full"
                                    src="https://pbs.twimg.com/profile_images/1121328878142853120/e-rpjoJi_bigger.png"
                                    alt=""
                                />
                            </div>
                            <div class="ml-3">
                                <p
                                    class="text-base leading-6 font-medium text-white"
                                >
                                    Sonali Hirave
                                    <span
                                        class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150"
                                    >
                                        @ShonaDesign . 16 April
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="pl-16">
                    <p
                        class="text-base width-auto font-medium text-white flex-shrink"
                    >
                        Day 07 of the challenge
                        <span class="text-blue-400">#100DaysOfCode</span> I was
                        wondering what I can do with
                        <span class="text-blue-400">#tailwindcss</span>, so just
                        started building Twitter UI using Tailwind and so far it
                        looks so promising. I will post my code after
                        completion. [07/100]
                        <span class="text-blue-400">
                            #WomenWhoCode #CodeNewbie</span
                        >
                    </p>

                    <div class="flex">
                        <div class="w-full">
                            <div class="flex items-center">
                                <div class="flex-1 text-center">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-6 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-1 text-center py-2 m-2">
                                    <a
                                        href="#"
                                        class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-blue-800 hover:text-blue-300"
                                    >
                                        <svg
                                            class="text-center h-7 w-6"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                            ></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-gray-600" />
            </div>

            <div class="w-2/5 h-12">
                <!--right menu-->

                <div class="relative text-gray-300 w-80 p-5 pb-0 mr-16"></div>

                <!--second-trending tweet section-->
                <div
                    class="max-w-sm rounded-lg bg-blue-800 overflow-hidden shadow-lg m-4 mr-20"
                ></div>

                <!--third-people suggetion to follow section-->

                <div
                    class="max-w-sm rounded-lg bg-blue-800 overflow-hidden shadow-lg m-4 mr-20"
                ></div>

                <div class="flow-root m-6 inline"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

export default {
    name: "LoginIndex",

    components: { AppLayout },

    props: {
        hasIncomingExchanges: {
            type: Boolean,
        },
    },

    setup(props, { emit }) {
        const page = usePage();
        const state = reactive({
            userData: page.props.auth.user,
            name: "Vanessa Lopez",
            nickname: "vanessita_lo",
            text: "",
            time: 0,
            date: 0,
            year: ""
        });

        onMounted(() => {});

        function randomize(){

            let months = ["ene", "feb", "mar", "abr"];

            state.date = Math.floor(Math.random() * 30) + " " + months[Math.floor(Math.random() * 3)];
            state.time = Math.floor(Math.random() * 12) + ":" + Math.floor((Math.random()) * 59) + " pm";
            state.year = " 202" + Math.floor(Math.random() * 4);
        }

        return {
            state,
            randomize,
        };
    },
};
</script>
