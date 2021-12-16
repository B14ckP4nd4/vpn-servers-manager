<div>
    <div class="modal-header">
        <h5 class="modal-title">New Inventory</h5>
        <button wire:click="resetModals()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        @if($resultMessage)
            <div class="card">
                <div class="card-status-bottom bg-success"></div>
                <div class="card-body">
                    <h3 class="card-title">Result</h3>
                    {!! $resultMessage !!}
                </div>
            </div>

        @endif
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" name="example-text-input"
                   placeholder="Your report name">
            @error('name') <div class="invalid-feedback">{{ $errors->first('name') }}</div> @enderror
        </div>
        <label class="form-label">Status</label>
        @error('is_active') <div class="text-red p-1">{{ $errors->first('is_active') }}</div> @enderror
        <div class="form-selectgroup-boxes row mb-3">
            <div class="col-lg-6">
                <label class="form-selectgroup-item">
                    <input wire:model='is_active' type="radio" name="is_active" value="1" class="form-selectgroup-input" checked>
                    <span class="form-selectgroup-label d-flex align-items-center p-3 @error('is_active') bg-red-lt @enderror">
                                <span class="me-3">
                                  <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                  <span class="form-selectgroup-title strong mb-1">Active</span>
                                  <span class="d-block text-muted">This inventory will be active</span>
                                </span>
                              </span>
                </label>
            </div>
            <div class="col-lg-6">
                <label class="form-selectgroup-item">
                    <input wire:model='is_active' type="radio" name="is_active" value="0" class="form-selectgroup-input">
                    <span class="form-selectgroup-label d-flex align-items-center p-3 @error('is_active') bg-red-lt @enderror">
                                <span class="me-3">
                                  <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                  <span class="form-selectgroup-title strong mb-1">deActive</span>
                                  <span class="d-block text-muted">This inventory will be Deactivated</span>
                                </span>
                              </span>
                </label>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <a wire:click="resetModals()" href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            Cancel
        </a>
        <a wire:click="store()" class="btn btn-primary ms-auto">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                 stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Create Inventory
        </a>
    </div>
</div>
