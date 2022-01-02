<div>
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
                <th>PlayBook</th>
                <th>Stats</th>
                <th>Status</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            @forelse($plays as $play)
                <tr>
                    <td>
                        <span class="text-muted">{{$play->id}}</span>
                    </td>
                    <td>
                        {{$play->inventory()->first()->name}}
                    </td>
                    <td>
                        {{ $play->playbook()->first()->name }}
                    </td>
                    <td>
                        <span class="text-success">OK : {{$play->ok}}</span> ,
                        <span class="text-indigo">Changed : {{$play->changed}}</span> ,
                        <span class="text-danger">Unreachable : {{$play->unreachable}}</span> ,
                        <span class="text-warning">Skipped : {{$play->skipped}}</span> ,
                        <span class="text-green-600">Rescued : {{$play->rescued}}</span> ,
                        <text class="text-muted">Ignored : {{$play->ignored}}</text>
                    </td>
                    <td>
                        @if($play->is_running)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-run" width="44"
                                 height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="13" cy="4" r="1"/>
                                <path d="M4 17l5 1l.75 -1.5"/>
                                <path d="M15 21l0 -4l-4 -3l1 -6"/>
                                <path d="M7 12l0 -3l5 -1l3 3l3 1"/>
                            </svg>
                            Running...
                            <div class="font-semibold">{{$play->run_at}}</div>
                        @elseif(!$play->is_running && !$play->completed_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time"
                                 width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4"/>
                                <circle cx="18" cy="18" r="4"/>
                                <path d="M15 3v4"/>
                                <path d="M7 3v4"/>
                                <path d="M3 11h16"/>
                                <path d="M18 16.496v1.504l1 1"/>
                            </svg>
                            Waiting for Run
                        @elseif($play->completed_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox"
                                 width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <polyline points="9 11 12 14 20 6"/>
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/>
                            </svg>
                            <span class="font-semibold"> Completed </span>
                            <div class="text-start text-muted small">{{$play->completed_at}}</div>
                        @endif
                    </td>
                    <td x-data class="text-start">
                        <a
                            @click="window.Livewire.emitTo('remove-play','selectForRemove',{{$play->id}})"
                            class="m-0 p-2 btn btn-outline-danger removeItemBtn " data-bs-toggle="modal"
                            data-bs-target="#remove-play-modal">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="m-0 icon icon-tabler icon-tabler-trash" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="4" y1="7" x2="20" y2="7"></line>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </a>
                        <a
                            x-data @click="window.Livewire.emitTo('edit-play-books','selectForEdit',{{$play->id}})"
                            data-bs-toggle="modal"
                            data-bs-target="#edit-playbook"
                            class="m-0 p-2 btn btn-outline-info">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="m-0 icon icon-tabler icon-tabler-settings" width="24"
                                 height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </a>
                        <a
                            x-data
                            @click="window.Livewire.emitTo('play-logs','getLogs',{{$play->id}})"
                            data-bs-toggle="modal"
                            data-bs-target="#view-logs-modal"
                            class="m-0 p-2 btn btn-outline-success">


                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-settings" width="24"
                                 height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="12" r="2"/>
                                <path
                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                            </svg>
                            Logs
                        </a>
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
