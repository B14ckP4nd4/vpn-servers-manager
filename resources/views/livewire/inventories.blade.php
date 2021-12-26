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
                <th>Name</th>
                <th>is active ?</th>
                <th>Last Refresh</th>
                <th>Servers</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($inventories as $inventory)
                <tr>
                    <td>
                        <span class="text-muted">{{$inventory->id}}</span>
                    </td>
                    <td>
                        <a href="" class="text-reset" tabindex="-1">{{$inventory->name}}</a>
                    </td>
                    <td>
                        @if($inventory->is_active)
                            <span class="badge bg-success me-1"></span> Active
                        @else
                            <span class="badge bg-danger me-1"></span> DeActive
                        @endif
                    </td>
                    <td>
                        {!!  $inventory->last_refresh ?? '<span class="mall text-muted">No Refreshed</span>' !!}
                    </td>
                    <td>
                        <button class="btn btn-outline-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-server" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="3" y="4" width="18" height="8" rx="3"></rect>
                                <rect x="3" y="12" width="18" height="8" rx="3"></rect>
                                <line x1="7" y1="8" x2="7" y2="8.01"></line>
                                <line x1="7" y1="16" x2="7" y2="16.01"></line>
                            </svg>
                            <span class="small">{{$inventory->items()->count()}} Servers</span>
                        </button>

                    </td>
                    <td>
                        {{$inventory->created_at}}
                    </td>
                    <td class="text-start">
                        <a
                            wire:click="$emitTo('remove-inventory-modal','selectForRemove',{{$inventory->id}})"
                            class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#model_remove">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-trash" width="24" height="24"
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
                            Remove
                        </a>
                        <a
                            wire:click="$emitTo('edit-inventory-modal','selectInvForEdit',{{$inventory->id}})"
                            data-bs-toggle="modal"
                            data-bs-target="#edit-inventory"
                            class="btn btn-outline-info">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-settings" width="24"
                                 height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
