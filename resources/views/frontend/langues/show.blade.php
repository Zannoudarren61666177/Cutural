<x-app-layout>

    <!-- HEADER -->
    <div class="py-24 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
            {{ $langue->nom }}
        </h1>
        <p class="mt-3 text-white/90 text-lg">
            Informations culturelles et linguistiques
        </p>
    </div>

    <!-- DESCRIPTION -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-white shadow-lg rounded-2xl p-8 md:p-10">

                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Description</h2>

                <p class="text-gray-700 leading-relaxed text-lg">
                    {!! nl2br(e($langue->description)) !!}
                </p>

            </div>
        </div>
    </section>

</x-app-layout>
