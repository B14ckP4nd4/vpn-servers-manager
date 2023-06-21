<x-app-layout>
    <div class="wrapper">
        <x-navigation></x-navigation>
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header text-white d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Inventories Items list
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a x-data @click="window.Livewire.emitTo('inventory-items-form-modal','createItem')" href="#"
                                   class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                   data-bs-target="#inventory-items-form">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Create New Inventory Item
                                </a>
                                <a x-data @click="window.Livewire.emitTo('group-add-item','createItem')" href="#"
                                   class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                   data-bs-target="#group-add-item-modal">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Add inventory as group
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Inventory Items</h3>
                                </div>
                                <livewire:inventory-items-list></livewire:inventory-items-list>

                                <!-- inventory item remove modal -->
                                <div class="modal modal-blur fade" id="model_remove" tabindex="-1"
                                     aria-hidden="true" x-data="{ x : 2}">
                                    <div @click-away="window.livewire.emit('refreshModal');"
                                         class="modal-dialog modal-sm modal-dialog-centered" role="document">

                                        <div class="modal-content">
                                            <button wire:click="resetModals()" type="button" class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            <div class="modal-status bg-danger"></div>
                                            <livewire:remove-inventory-item-modal></livewire:remove-inventory-item-modal>
                                        </div>
                                    </div>
                                </div>
                                <!-- inventory edit modal -->
                                <!-- inventory edit modal -->
                                <div x-date @click.away="window.Livewire.emitTo('inventory-items-form-modal','cancel')" class="modal modal-blur fade" id="inventory-items-form" tabindex="-1" role="dialog"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <livewire:inventory-items-form-modal></livewire:inventory-items-form-modal>
                                    </div>
                                </div>

                                <div x-date @click.away="window.Livewire.emitTo('group-add-item','cancel')" class="modal modal-blur fade" id="group-add-item-modal" tabindex="-1" role="dialog"
                                     aria-hidden="true">

                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        @livewire('group-add-item')
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>


    <!-- Tabler Core -->
    <script src="{{asset('js/dashboard/dashboard.js?'. time())}}"></script>
    <script>
        function resetModals() {
            window.Livewire.emit('refreshModal');
            document.getElementById('deleteModalContent').style.display = "none";
            document.getElementById('delete_modal_loading').style.display = "block";
        }

        $('.removeItemBtn').on('click', function (e) {
            return resetModals();
        })
    </script>
</x-app-layout>
