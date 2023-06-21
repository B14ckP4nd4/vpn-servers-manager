<div wire:poll.10s>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
            <tr>
                <th class="w-1">No.
                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="icon icon-sm text-dark icon-thick" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="6 15 12 9 18 15"/>
                    </svg>
                </th>
                <th>Inventory</th>
                <th>Plays</th>
                <th>Status</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            @forelse($series as $serie)
                <tr>
                    <td>
                        <span class="text-muted">{{$serie->id}}</span>
                    </td>
                    <td>
                        {{$serie->inventory()->first()->name}}<br/>
                        {{--                        <span class="text-muted">{{ $play->playbook()->first()->name }}</span>--}}
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach(json_decode($serie->series) as $play)
                                <li class="list-group-item">{{$play->title}} {{ $play->play_id ?? '-' }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{$serie->status}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td> -</td>
                    <td> -</td>
                    <td> -</td>
                    <td> -</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
