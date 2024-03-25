<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{ $item->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Grnat {{ $item->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="{{ route('roles.grant-permission', ['role_id' => $item->id]) }}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Permission</label>
                <select multiple name="permissions[]" class="form-control select2" style="width: 100%;">
                    @foreach ($permissions as $permission)

                        <option value="{{ $permission->id }}" class="font-weight-bold" @if (in_array($permission->name, $item->permissions->pluck('name')->toArray()))
                            selected
                        @endif >{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Understood</button>
        </form>
        </div>
    </div>
    </div>
</div>
