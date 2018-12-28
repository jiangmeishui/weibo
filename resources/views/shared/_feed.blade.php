@if ($list->count() > 0)
    <ul class="list-unstyled">
        @foreach ($list as $status)
            @include('statuses._status',  ['user' => $status->user])
        @endforeach
    </ul>
    <div class="mt-5">
        {!! $list->render() !!}
    </div>
@else
    <p>没有数据！</p>
@endif