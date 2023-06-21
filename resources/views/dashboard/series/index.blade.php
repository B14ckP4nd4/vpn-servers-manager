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
                                Series Monitoring
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <a x-data @click="window.Livewire.emitTo('add-new-series','pleaseRefresh')" href="#"
                                   class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                   data-bs-target="#add-series">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Add New Series
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
                                    <h3 class="card-title">Series</h3>
                                </div>
                                <livewire:series></livewire:series>
                            </div>
                        </div>

                        <!-- Modals -->

                        <!-- add playbook Modal -->
                        <div x-data class="modal modal-blur fade" id="add-series" tabindex="-1" role="dialog" aria-hidden="true">
                            <div @click.away="window.Livewire.emitTo('add-new-play','pleaseRefresh')" class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <livewire:add-new-series></livewire:add-new-series>
                                </div>
                            </div>
                        </div>
                        <!-- add edit playbook Modal -->

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
