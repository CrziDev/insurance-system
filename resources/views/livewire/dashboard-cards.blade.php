<div>
    <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 basis-11/12">
        <!-- total income -->
        <a href="{{ auth()->user()->role == 1 ? '/admin/reports' : '/staff/reports' }}">
            <div class="bg-lime-200 hover:bg-amber-500 hover:text-white rounded-md flex flex-col justify-between p-2 shadow-md">
                <div class="flex justify-around items-center w-full mt-5 px-2">
                    <div>
                        <p class="font-normal text-[15px] tracking-wide">Income</p>
                        <p class="font-medium text-[28px] tracking-wider">₱{{number_format($income[0],2)}}</p>
                    </div>
                    <div class="h-[25px] w-[25px]">
                        <span><i class="fa-solid fa-peso-sign text-[40px]"></i></span>
                    </div>
                </div>
                <div class="flex justify-around items-center w-full">
                    <?php for ($i = 0; $i < 20; $i++) {
                        echo ('<p class="text-gray-500">*</p>');
                    } ?>
                </div>
            </div>
        </a>

        <!-- policy holder -->
        <a href="{{ auth()->user()->role == 1 ? '/admin/customers' : '/staff/customers' }}">
            <div class="bg-lime-200 hover:bg-amber-500 hover:text-white rounded-md flex flex-col justify-between p-2 shadow-md">
                <div class="flex justify-around items-center w-full mt-5 px-2">
                    <div>
                        <p class="font-normal text-[15px] tracking-wide">Policy Holder</p>
                        <p class="font-medium text-[28px] tracking-wider">{{$policyHolder}}</p>
                    </div>
                    <div class="h-[30px] w-[30px]">
                        <span><i class="fa-solid fa-user-tie text-[40px]"></i></span>
                    </div>
                </div>
                <div class="flex justify-around items-center w-full">
                    <?php for ($i = 0; $i < 20; $i++) {
                        echo ('<p class="text-gray-500">*</p>');
                    } ?>
                </div>
            </div>
        </a>

        <!-- remaining policies -->
        <a href="{{ auth()->user()->role == 1 ? '/admin/policies' : '/staff/policies' }}">
            <div class="bg-lime-200 hover:bg-amber-500 hover:text-white rounded-md flex flex-col justify-between p-2 shadow-md">
                <div class="flex justify-around items-center w-full mt-5 px-2">
                    <div>
                        <p class="font-normal text-[15px] tracking-wide">Remaining Policies</p>
                        <p class="font-medium text-[28px] tracking-wider">{{$remainingPolicies}}</p>
                    </div>
                    <div class="h-[30px] w-[30px]">
                        <span><i class="fa-solid fa-file-invoice text-[40px]"></i></span>
                    </div>
                </div>
                <div class="flex justify-around items-center w-full">
                    <?php for ($i = 0; $i < 20; $i++) {
                        echo ('<p class="text-gray-500">*</p>');
                    } ?>
                </div>
            </div>
        </a>

        <!-- expiring -->
        <a href="{{ auth()->user()->role == 1 ? '/admin/expiring' : '/staff/expiring' }}">
            <div class="bg-lime-200 hover:bg-amber-500 hover:text-white rounded-md flex flex-col justify-between p-2 shadow-md">
                <div class="flex justify-around items-center w-full mt-5 px-2">
                    <div>
                        <p class="font-normal text-[15px] tracking-wide">Expiring Policies</p>
                        <p class="font-medium text-[28px] tracking-wider">{{$expiringPolicies}}</p>
                    </div>
                    <div class="h-[30px] w-[30px]">
                        <span><i class="fa-solid fa-business-time text-[40px]"></i></span>
                    </div>
                </div>
                <div class="flex justify-around items-center w-full">
                    <?php for ($i = 0; $i < 20; $i++) { ?>
                        <p class="text-gray-500">*</p>
                    <?php } ?>
                </div>
            </div>
        </a>
    </div>
</div>
