<div wire.pull="getLogs" wire:poll.5s>
    <div class="modal-body">
            <div>
                <textarea name="" id="" style="white-space: pre-wrap;" cols="130" rows="30" class="modal-full-width p-1 disabled" disabled>
                    {!! $logs !!}
                </textarea>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click="$emitSelf('pleaseRefresh')" class="btn me-auto" data-bs-dismiss="modal">Close</button>
    </div>
</div>
