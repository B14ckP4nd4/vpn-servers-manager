<x-app-layout>
    <div class="wrapper">
        <x-navigation></x-navigation>
        <div class="page-wrapper">
            <div class="page-wrapper">
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
                            <div x-data @click="window.Livewire.emitTo('create-new-inventory-modal','pleaseRefresh')"
                                 class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="#"
                                       class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                       data-bs-target="#create_inventory">
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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Inventories</h3>
                                    </div>
                                    <livewire:inventories></livewire:inventories>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--Remove Inventory Modal Start -->
                <div x-data
                     class="modal modal-blur fade " id="model_remove" tabindex="-1"
                     aria-hidden="true">
                    <div @click.away="window.Livewire.emitTo('remove-inventory-modal','resetModal');" class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <livewire:remove-inventory-modal></livewire:remove-inventory-modal>
                    </div>
                </div>
                <!--Remove Inventory Modal end-->


                <!--Create Inventory Form -->
                <div class="modal modal-blur fade" id="create_inventory" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <livewire:create-new-inventory-modal></livewire:create-new-inventory-modal>
                        </div>
                    </div>
                </div>
                <!--Create Inventory Form end-->

                <!--edit Inventory Form -->
                <div class="modal modal-blur fade" id="edit-inventory" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <livewire:edit-inventory-modal></livewire:edit-inventory-modal>
                        </div>
                    </div>
                </div>
                <!--edit Inventory Form end-->
                <x-footer></x-footer>
            </div>
        </div>


        <!-- Tabler Core -->
        <script src="{{asset('js/dashboard/dashboard.js?'. time())}}"></script>
        <script src="{{asset('js/app.js?'. time())}}"></script>

</x-app-layout>
