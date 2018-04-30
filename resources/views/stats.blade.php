@extends('layouts.app')

@section('content')
<div class="container">
    @unless($videos->count())
        {{ __('No entries yet') }}
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>User ID</th>
                    <th>Status</th>
                    <th>Max quality</th>
                </tr>
            </thead>
            <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->user_id }}</td>
                        <td>
                            @switch($video->status)
                                @case(0)
                                    <span class="badge badge-primary">Pending</span>
                                    @break

                                @case(1)
                                    <span class="badge badge-warning">Processing</span>
                                    @break

                                @case(2)
                                    <span class="badge badge-warning">Partially&nbsp;ready</span>
                                    @break

                                @case(3)
                                    <span class="badge badge-success">Done</span>
                                    @break

                                @case(4)
                                    <span class="badge badge-danger">Error</span>
                                    @break

                                @default
                                    <span class="badge badge-secondary">{{ $item->status }}</span>
                            @endswitch
                        </td>
                        <td>{{ $video->max_quality }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endunless
    {{ $videos->links() }}
</div>
@endsection
