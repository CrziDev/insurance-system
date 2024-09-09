<div class="px-6 flex bg-orange/90 text-white rounded-lg justify-between relative shadow-md">
    <div class="pt-10 pb-5 flex flex-col text-xs ">
        <h1 class="mb-3 text-2xl font-semibold">Welcome to Zilka Life Insurance Services</h1>
        <p class="mb-6">At Zilka Life Insurance Services, we offer tailored insurance solutions to meet your needs. <br>
            Explore our options to find the perfect fit for you and your family.</p>
        <div class="">
            <p class="mb-2">Choose from our comprehensive insurance plans:</p>
            <x-button x-data @click="$dispatch('open-modal',{name:'life-insure'})">Life Insurance</x-button>
            <x-button x-data @click="$dispatch('open-modal',{name:'non-life-insure'})">Non-Life Insurance</x-button>
        </div>
    </div>
    <img class="h-[250px] w-[500px]" src="{{Vite::asset('resources/images/insurance-vector.png')}}" alt="">
</div>


