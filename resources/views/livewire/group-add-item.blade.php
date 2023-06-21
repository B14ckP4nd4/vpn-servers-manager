<div>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Create Group of items</h5>

            <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
        </div>
        @if($toggle)
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Servers</label>
                    <textarea class="form-control" wire:model="servers" rows="6" placeholder="server separated by new line.." spellcheck="false"></textarea>
                    @error('server') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Inventory</label>
                    <select wire:model="inventory_id" class="form-select">
                        <option> -</option>
                        @foreach($Inventories as $inventory)
                            <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                        @endforeach
                    </select>
                    @error('inventory_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" wire:click="$emitSelf('cancel')" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                @if($created)
                    <a href="#" wire:click="$emitSelf('cancel')" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                        Done
                    </a>
                @else
                    <a wire:click="addItem()" href="#" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Add Items
                    </a>

                @endif
            </div>
        @else
            <div class="modal-body">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-clockwise-2"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 4.55a8 8 0 0 1 6 14.9m0 -4.45v5h5"></path>
                        <line x1="5.63" y1="7.16" x2="5.63" y2="7.17"></line>
                        <line x1="4.06" y1="11" x2="4.06" y2="11.01"></line>
                        <line x1="4.63" y1="15.1" x2="4.63" y2="15.11"></line>
                        <line x1="7.16" y1="18.37" x2="7.16" y2="18.38"></line>
                        <line x1="11" y1="19.94" x2="11" y2="19.95"></line>
                    </svg>
                    <h3>Loading...</h3>

                    <div class="text-muted">Please wait</div>
                </div>
            </div>
        @endif
    </div>
</div>
