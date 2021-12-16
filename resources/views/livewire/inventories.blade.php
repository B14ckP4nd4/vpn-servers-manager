<div>
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header text-white d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Inventories list
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" wire:click="create()"
                           class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal_inventory_form">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Create New Inventory
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                           data-bs-target="#modal-report" aria-label="Create new report">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                @if ($resultMessage)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-status-bottom bg-success"></div>
                            <div class="card-body">
                                <h3 class="card-title">Result</h3>
                                <p>{!! $resultMessage !!}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Inventories</h3>
                        </div>
                        {{--                    <div class="card-body border-bottom py-3">--}}
                        {{--                        <div class="d-flex">--}}
                        {{--                            <div class="text-muted">--}}
                        {{--                                Show--}}
                        {{--                                <div class="mx-2 d-inline-block">--}}
                        {{--                                    <input type="text" class="form-control form-control-sm" value="8" size="3"--}}
                        {{--                                           aria-label="Invoices count">--}}
                        {{--                                </div>--}}
                        {{--                                entries--}}
                        {{--                            </div>--}}
                        {{--                            <div class="ms-auto text-muted">--}}
                        {{--                                Search:--}}
                        {{--                                <div class="ms-2 d-inline-block">--}}
                        {{--                                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice">--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
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
                                                wire:click="selectInventoryToDelete({{$inventory->id}})"
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
                                                wire:click="edit({{$inventory->id}})"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_inventory_form"
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
                                        <td> -</td>
                                        <td> -</td>
                                        <td> -</td>
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
                </div>

            </div>
        </div>
    </div>

    {{--Remove Inventory Modal Start --}}
        <div @click.away="window.livewire('deleteModal',false)" class="modal modal-blur fade {{ ($deleteModal) ? 'show' : '' }}" id="model_remove" tabindex="-1"
         style="display: {{ ($deleteModal) ? 'block' : 'none' }};" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            @if($selectedInventory)
                <div class="modal-content">
                    <button wire:click="resetModals()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon mb-2 text-danger icon-lg" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9v2m0 4v.01"></path>
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-muted">Do you really want to remove <span
                                class="strong">{{$selectedInventory}}</span> Inventory? What you've
                            done cannot be undone.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div wire:click="resetModals()" class="col"><a href="#" class="btn w-100"
                                                                               data-bs-dismiss="modal">
                                        Cancel
                                    </a></div>

                                <div class="col">
                                    <a wire:click="destroy()" class="btn btn-danger w-100">
                                        Delete Inventory
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include("dashboard/ModalLoading")
            @endif
        </div>
    </div>
    {{--Remove Inventory Modal end --}}


    {{--Create or Update Form Modal Begin--}}

    <div class="modal modal-blur fade {{ ($createModal || $editModal) ? 'show' : '' }}" style="display: {{ ($createModal || $editModal) ? 'block' : 'none' }};" id="modal_inventory_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            @if($editModal || $createModal)
                <div class="modal-content">
                    @if($updateMode)
                        @include("dashboard/inventories/update")
                    @else
                        @include("dashboard/inventories/create")
                    @endif
                </div>
            @else
                @include("dashboard/ModalLoading")
            @endif
        </div>
    </div>


    {{--Create or Update Form Modal end--}}

</div>
