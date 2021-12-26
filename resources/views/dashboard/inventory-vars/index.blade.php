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
                                List
                            </div>
                            <h2 class="page-title">
                                Inventory Variable
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
                                    Create New Variable
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
                                    <h3 class="card-title">Inventory Vars</h3>
                                </div>
                                <livewire:inventory-variables></livewire:inventory-variables>
                            </div>
                        </div>

                        <!-- Modals -->
                        <!--edit Inventory var -->
                        <div class="modal modal-blur fade" id="edit-inventory-var" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <livewire:edit-inventory-var></livewire:edit-inventory-var>
                                </div>
                            </div>
                        </div>
                        <!-- end Inventory var -->


                        <!-- var remove modal -->
                        <div class="modal modal-blur fade" id="remove-modal" tabindex="-1"
                             aria-hidden="true" x-data="{ x : 2}">
                            <div @click-away="window.livewire.emitTo('remove-inventory-var','refreshModal');"
                                 class="modal-dialog modal-sm modal-dialog-centered" role="document">

                                <div class="modal-content">
                                    <button wire:click="resetModals()" type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    <div class="modal-status bg-danger"></div>
                                    <livewire:remove-inventory-var></livewire:remove-inventory-var>
                                </div>
                            </div>
                        </div>
                        <!-- var remove modal -->


                        <!-- end modals -->
                    </div>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </div>


    <!-- Tabler Core -->
    <script src="{{asset('js/dashboard/dashboard.js?'. time())}}"></script>
</x-app-layout>
