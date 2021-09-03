<div>
<?php $i=0?>

    @foreach($letters as $letter=>$status)

    <div class="inline-block  rounded  {!! $status=='unknown'? 'radio':'' !!}"
        {!! $status=='wrong'?  'style=\'background-color:red\' ':''   !!}
        {!! $status=='right'?  'style=\'background-color:green\' ':''   !!}
    >
            <input
                name="answer"
                type="checkbox"
                id="azbutton{{++$i}}"
                hidden="hidden"
                value=""

                autocomplete="off"
            />
            <label
                for="azbutton{{$i}}"
                wire:click="SendLetter('{{$letter}}')"
                class="px-2 py-1 rounded-lg flex justify-center items-center text-3xl lg:text-5xl font-bold w-10 h-10 lg:w-14 lg:h-14"
            >
                {{$letter}}
            </label>
    </div>
    @endforeach
</div>
