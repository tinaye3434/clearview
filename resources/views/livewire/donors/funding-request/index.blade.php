<div>
    <!-- Search Bar -->
    <div class="w-full flex justify-center mt-6 mb-8">
        <input type="text" placeholder="Search" class="w-3/4 max-w-xl px-5 py-3 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

    <div class="w-full flex justify-end mt-6 mb-8">
        {{ $fundingRequests->links() }}
    </div>
    <!-- Card Grid -->
    <div class="px-4 lg:px-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


        @foreach($fundingRequests as $request)
        <!-- Card Item -->
        <div class="bg-white rounded-xl shadow overflow-hidden border">
            <img src="{{ asset('images/img1.jpg') }}" alt="Fundraiser Image" class="w-full h-48 object-contain">
            <div class="p-4">
                <a href="{{ route('funding.detailed-view', $request->id) }}" class="font-semibold mb-2">{{ $request->title }}</a>
                <div class="w-full h-2 bg-gray-200 rounded-full mb-2">
                    <div class="h-full bg-green-600 rounded-full w-[60%]"></div>
                </div>
                <p class="text-sm font-medium">£20,818 raised</p>
            </div>
        </div>
        @endforeach

    </div>
</div>
