<div>
    <div class="modal-header">
        <h5 class="modal-title">New report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm()" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" wire:model="name" class="form-control" name="example-text-input"
                   placeholder="Enter Inventory Name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <label class="form-label">Status</label>
        <div class="form-selectgroup-boxes row mb-3">
            <div class="col-lg-6">
                <label class="form-selectgroup-item">
                    <input type="radio" wire:model="is_active" name="report-type" value="1" class="form-selectgroup-input">
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Active</span>
                      <span class="d-block text-muted">Create an Active Inventory</span>
                    </span>
                  </span>
                </label>
            </div>
            <div class="col-lg-6">
                <label class="form-selectgroup-item">
                    <input type="radio" wire:model="is_active" name="report-type" value="0" class="form-selectgroup-input">
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Deactive</span>
                      <span class="d-block text-muted">create a deactivated inventory</span>
                    </span>
                  </span>
                </label>
            </div>

            @error('is_active') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" data-bs-dismiss="modal" wire:click="resetForm()" class="btn btn-link link-secondary" >
            Cancel
        </a>
        @if(!$is_updated && $selected_id)
            <a href="#" wire:click="update()" class="btn btn-primary ms-auto">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Update
            </a>
        @elseif($is_updated)
            <a href="#" wire:click="resetForm()" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                Done
            </a>
        @else

        @endif
    </div>
</div>
