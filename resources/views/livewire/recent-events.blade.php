<div>
   <div class="flex justify-between items-center mb-4">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
        <div class="flex items-center space-x-2">
        </div>
   </div>

   <div class="h-[400px] overflow-x-auto">
    <x-table-recent-event :data="$data"/>
   </div>
</div>
