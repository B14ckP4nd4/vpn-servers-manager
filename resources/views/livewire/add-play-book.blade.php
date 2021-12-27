<div>
    <div class="modal-header">
        <h5 class="modal-title">Add PlayBook</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm()"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">name</label>
            <input type="text" wire:model="name" class="form-control" name="example-text-input"
                   placeholder="Enter PlayBook Name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">URL</label>
            <input type="text" wire:model="url" class="form-control" name="example-text-input"
                   placeholder="Enter PlayBook URL">
            @error('val') <span class="error">{{ $message }}</span> @enderror
        </div>

    </div>
    <div class="modal-footer">
        <a href="#" data-bs-dismiss="modal" wire:click="resetForm()" class="btn btn-link link-secondary">
            Cancel
        </a>
        @if(!$created)
            <a href="#" wire:click="create()" class="btn btn-primary ms-auto">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add
            </a>
        @endif

        @if($created)
        <a href="#" wire:click="resetForm()" class="btn btn-success ms-auto" data-bs-dismiss="modal">
            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M5 12l5 5l10 -10"/>
            </svg>
            Done
        </a>
        @endif
    </div>
</div>
