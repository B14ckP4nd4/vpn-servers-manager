<div>
    <div class="modal-header">
        <h5 class="modal-title">Add Series</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm()"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label class="form-label">inventory</label>
            <select wire:model="inventory_id" class="form-select">
                <option> -</option>
                @foreach($inventories as $inventory)
                    <option value="{{$inventory->id}}">{{$inventory->name}}</option>
                @endforeach
            </select>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="form-label">Select PlayBooks</div>
                <div class="col-md-5">
                    <select class="form-select" wire:model="selected_playbook">
                        <option value="">-</option>
                        @foreach($playBooks as $playbook)
                            <option value="{{$playbook->id}}">{{$playbook->name}}</option>
                        @endforeach
                    </select>
                    <span class="pt-3">Selected : {{$selected_playbook}}</span>
                </div>
                <div class="col-md-2">
                    <div wire:click="addPlayBook()" class="btn btn-green w-60 mb-2">-></div>
                    <div wire:click="resetPlayBooks()" class="btn btn-danger w-60">Reset</div>
                </div>
                <div class="col-md-5">
                    <div class="card p-3">
                        <ul>
                            @foreach($series as $k => $playbook)
                                <li>{{$playbook['title']}}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="modal-footer">
        <a href="#" data-bs-dismiss="modal" wire:click="resetForm()" class="btn btn-link link-secondary">
            Cancel
        </a>
        @if(!$created)
            <a href="#" wire:click="save()" class="btn btn-primary ms-auto">
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
