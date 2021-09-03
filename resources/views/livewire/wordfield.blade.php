<div>
    <?php $i=0;?>
@foreach($userArray as $key=>$letter)

        <div class="inline-block radio">
            <input
                name="answer"
                type="checkbox"
                id="checkbox{{++$i}}"
                hidden="hidden"
                autocomplete="off"

                value=""
            />
            <label
                for="checkbox{{$i}}"
                class="px-2 py-1 rounded-lg flex justify-center items-center text-3xl lg:text-5xl font-bold w-10 h-10 lg:w-14 lg:h-14"
            >{!! $letter!=''? $letter:'&nbsp;' !!}</label>
        </div>&nbsp;

    @endforeach
</div>
