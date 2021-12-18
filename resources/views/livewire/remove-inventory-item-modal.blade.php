<div>
    <div class="modal-body text-center py-4" >
        @if($itemID)
            <div id="deleteModalContent">
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
                        class="strong">{{$itemID}}</span> Inventory? What you've
                    done cannot be undone.
                </div>
            </div>
        @else
            <div id="delete_modal_loading">
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
        @endif
    </divx-data>
    <div class="modal-footer">
        <div class="w-100">
            <div class="row">
                <div wire:click="$set('itemID',null)" class="col"><a href="#" class="btn w-100"
                                    data-bs-dismiss="modal">
                        Cancel
                    </a></div>

                <div class="col">
                    <a wire:click="remove({{$itemID}})" class="btn btn-danger w-100">
                        Delete Inventory
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
