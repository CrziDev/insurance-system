<div>
   <div class="flex justify-between items-center mb-4">
        <x-table-title class="text-sm">{{$tableTitle}}</x-table-title>
        <div class="flex items-center space-x-2">
          <x-table-link link="{{$tableLink}}">See more</x-table-link>            
        </div>
   </div>

   <div class="h-[200px] overflow-x-auto">
    <x-table-recent-event :data="$data"/>
   </div>
</div>
