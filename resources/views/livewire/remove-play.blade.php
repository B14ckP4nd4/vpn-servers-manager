<div>
    <div class="modal-content">
        <button wire:click="resetModal()" type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
        @if($selected)
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
                        class="strong">{{ $selected }}</span> Play? What you've
                    done cannot be undone.
                </div>
        @else
            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                <!-- Download SVG icon from http://tabler-icons.io/i/refresh -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"/>
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"/>
                </svg>
                <h3>Please Wait</h3>
                <div class="text-muted">its take some time</div>
            @endif
        </div>
        <div class="modal-footer">
            <div class="w-100">
                <div class="row">
                    <div wire:click="resetModal()" class="col"><a href="#" class="btn w-100"
                                                                  data-bs-dismiss="modal">
                            Cancel
                        </a></div>
                    @if($selected && !$removed)
                        <div class="col">
                            <a wire:click="remove()" class="btn btn-danger w-100">
                                Delete Play
                            </a>
                        </div>
                    @elseif($removed)
                        <div class="col">
                            <a href="#" wire:click="resetModal()" class="btn btn-success ms-auto"
                               data-bs-dismiss="modal">
                                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 12l5 5l10 -10"/>
                                </svg>
                                Done
                            </a>
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
